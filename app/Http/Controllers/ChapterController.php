<?php

namespace DocsPen\Http\Controllers;

use Activity;
use DocsPen\Repos\EntityRepo;
use DocsPen\Repos\UserRepo;
use DocsPen\Services\ExportService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Views;

class ChapterController extends Controller
{
    protected $userRepo;
    protected $entityRepo;
    protected $exportService;

    /**
     * ChapterController constructor.
     *
     * @param EntityRepo    $entityRepo
     * @param UserRepo      $userRepo
     * @param ExportService $exportService
     */
    public function __construct(EntityRepo $entityRepo, UserRepo $userRepo, ExportService $exportService)
    {
        $this->entityRepo = $entityRepo;
        $this->userRepo = $userRepo;
        $this->exportService = $exportService;
        parent::__construct();
    }

    /**
     * Show the form for creating a new chapter.
     *
     * @param $docSlug
     *
     * @return Response
     */
    public function create($docSlug)
    {
        $book = $this->entityRepo->getBySlug('book', $docSlug);
        $this->checkOwnablePermission('chapter-create', $book);
        $this->setPageTitle(trans('entities.chapters_create'));

        return view('chapters/create', ['book' => $book, 'current' => $book]);
    }

    /**
     * Store a newly created chapter in storage.
     *
     * @param         $docSlug
     * @param Request $request
     *
     * @return Response
     */
    public function store($docSlug, Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:30|min:3',
        ]);

        $book = $this->entityRepo->getBySlug('book', $docSlug);
        $this->checkOwnablePermission('chapter-create', $book);

        $input = $request->all();
        $input['priority'] = $this->entityRepo->getNewBookPriority($book);
        $chapter = $this->entityRepo->createFromInput('chapter', $input, $book);
        Activity::add($chapter, 'chapter_create', $book->id);

        return redirect($chapter->getUrl());
    }

    /**
     * Display the specified chapter.
     *
     * @param $docSlug
     * @param $chapterSlug
     *
     * @return Response
     */
    public function show($docSlug, $chapterSlug)
    {
        $chapter = $this->entityRepo->getBySlug('chapter', $chapterSlug, $docSlug);
        $this->checkOwnablePermission('chapter-view', $chapter);
        $sidebarTree = $this->entityRepo->getBookChildren($chapter->book);
        Views::add($chapter);
        $this->setPageTitle($chapter->getShortName());
        $pages = $this->entityRepo->getChapterChildren($chapter);

        return view('chapters/show', [
            'book'        => $chapter->book,
            'chapter'     => $chapter,
            'current'     => $chapter,
            'sidebarTree' => $sidebarTree,
            'pages'       => $pages,
        ]);
    }

    /**
     * Show the form for editing the specified chapter.
     *
     * @param $docSlug
     * @param $chapterSlug
     *
     * @return Response
     */
    public function edit($docSlug, $chapterSlug)
    {
        $chapter = $this->entityRepo->getBySlug('chapter', $chapterSlug, $docSlug);
        $this->checkOwnablePermission('chapter-update', $chapter);
        $this->setPageTitle(trans('entities.chapters_edit_named', ['chapterName' => $chapter->getShortName()]));

        return view('chapters/edit', ['book' => $chapter->book, 'chapter' => $chapter, 'current' => $chapter]);
    }

    /**
     * Update the specified chapter in storage.
     *
     * @param Request $request
     * @param         $docSlug
     * @param         $chapterSlug
     *
     * @return Response
     */
    public function update(Request $request, $docSlug, $chapterSlug)
    {
        $chapter = $this->entityRepo->getBySlug('chapter', $chapterSlug, $docSlug);
        $this->checkOwnablePermission('chapter-update', $chapter);
        if ($chapter->name !== $request->get('name')) {
            $chapter->slug = $this->entityRepo->findSuitableSlug('chapter', $request->get('name'), $chapter->id, $chapter->book->id);
        }
        $chapter->fill($request->all());
        $chapter->updated_by = user()->id;
        $chapter->save();
        Activity::add($chapter, 'chapter_update', $chapter->book->id);

        return redirect($chapter->getUrl());
    }

    /**
     * Shows the page to confirm deletion of this chapter.
     *
     * @param $docSlug
     * @param $chapterSlug
     *
     * @return \Illuminate\View\View
     */
    public function showDelete($docSlug, $chapterSlug)
    {
        $chapter = $this->entityRepo->getBySlug('chapter', $chapterSlug, $docSlug);
        $this->checkOwnablePermission('chapter-delete', $chapter);
        $this->setPageTitle(trans('entities.chapters_delete_named', ['chapterName' => $chapter->getShortName()]));

        return view('chapters/delete', ['book' => $chapter->book, 'chapter' => $chapter, 'current' => $chapter]);
    }

    /**
     * Remove the specified chapter from storage.
     *
     * @param $docSlug
     * @param $chapterSlug
     *
     * @return Response
     */
    public function destroy($docSlug, $chapterSlug)
    {
        $chapter = $this->entityRepo->getBySlug('chapter', $chapterSlug, $docSlug);
        $book = $chapter->book;
        $this->checkOwnablePermission('chapter-delete', $chapter);
        Activity::addMessage('chapter_delete', $book->id, $chapter->name);
        $this->entityRepo->destroyChapter($chapter);

        return redirect($book->getUrl());
    }

    /**
     * Show the page for moving a chapter.
     *
     * @param $docSlug
     * @param $chapterSlug
     *
     * @throws \DocsPen\Exceptions\NotFoundException
     *
     * @return mixed
     */
    public function showMove($docSlug, $chapterSlug)
    {
        $chapter = $this->entityRepo->getBySlug('chapter', $chapterSlug, $docSlug);
        $this->setPageTitle(trans('entities.chapters_move_named', ['chapterName' => $chapter->getShortName()]));
        $this->checkOwnablePermission('chapter-update', $chapter);

        return view('chapters/move', [
            'chapter' => $chapter,
            'book'    => $chapter->book,
        ]);
    }

    /**
     * Perform the move action for a chapter.
     *
     * @param $docSlug
     * @param $chapterSlug
     * @param Request $request
     *
     * @throws \DocsPen\Exceptions\NotFoundException
     *
     * @return mixed
     */
    public function move($docSlug, $chapterSlug, Request $request)
    {
        $chapter = $this->entityRepo->getBySlug('chapter', $chapterSlug, $docSlug);
        $this->checkOwnablePermission('chapter-update', $chapter);

        $entitySelection = $request->get('entity_selection', null);
        if ($entitySelection === null || $entitySelection === '') {
            return redirect($chapter->getUrl());
        }

        $stringExploded = explode(':', $entitySelection);
        $entityType = $stringExploded[0];
        $entityId = intval($stringExploded[1]);

        $parent = false;

        if ($entityType == 'book') {
            $parent = $this->entityRepo->getById('book', $entityId);
        }

        if ($parent === false || $parent === null) {
            session()->flash('error', trans('errors.selected_book_not_found'));

            return redirect()->back();
        }

        $this->entityRepo->changeBook('chapter', $parent->id, $chapter, true);
        Activity::add($chapter, 'chapter_move', $chapter->book->id);
        session()->flash('success', trans('entities.chapter_move_success', ['bookName' => $parent->name]));

        return redirect($chapter->getUrl());
    }

    /**
     * Show the Restrictions view.
     *
     * @param $docSlug
     * @param $chapterSlug
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showRestrict($docSlug, $chapterSlug)
    {
        $chapter = $this->entityRepo->getBySlug('chapter', $chapterSlug, $docSlug);
        $this->checkOwnablePermission('restrictions-manage', $chapter);
        $roles = $this->userRepo->getRestrictableRoles();

        return view('chapters/restrictions', [
            'chapter' => $chapter,
            'roles'   => $roles,
        ]);
    }

    /**
     * Set the restrictions for this chapter.
     *
     * @param $docSlug
     * @param $chapterSlug
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function restrict($docSlug, $chapterSlug, Request $request)
    {
        $chapter = $this->entityRepo->getBySlug('chapter', $chapterSlug, $docSlug);
        $this->checkOwnablePermission('restrictions-manage', $chapter);
        $this->entityRepo->updateEntityPermissionsFromRequest($request, $chapter);
        session()->flash('success', trans('entities.chapters_permissions_success'));

        return redirect($chapter->getUrl());
    }

    /**
     * Exports a chapter to pdf .
     *
     * @param string $docSlug
     * @param string $chapterSlug
     *
     * @return \Illuminate\Http\Response
     */
    public function exportPdf($docSlug, $chapterSlug)
    {
        $chapter = $this->entityRepo->getBySlug('chapter', $chapterSlug, $docSlug);
        $pdfContent = $this->exportService->chapterToPdf($chapter);

        return response()->make($pdfContent, 200, [
            'Content-Type'        => 'application/octet-stream',
            'Content-Disposition' => 'attachment; filename="'.$chapterSlug.'.pdf',
        ]);
    }

    /**
     * Export a chapter to a self-contained HTML file.
     *
     * @param string $docSlug
     * @param string $chapterSlug
     *
     * @return \Illuminate\Http\Response
     */
    public function exportHtml($docSlug, $chapterSlug)
    {
        $chapter = $this->entityRepo->getBySlug('chapter', $chapterSlug, $docSlug);
        $containedHtml = $this->exportService->chapterToContainedHtml($chapter);

        return response()->make($containedHtml, 200, [
            'Content-Type'        => 'application/octet-stream',
            'Content-Disposition' => 'attachment; filename="'.$chapterSlug.'.html',
        ]);
    }

    /**
     * Export a chapter to a simple plaintext .txt file.
     *
     * @param string $docSlug
     * @param string $chapterSlug
     *
     * @return \Illuminate\Http\Response
     */
    public function exportPlainText($docSlug, $chapterSlug)
    {
        $chapter = $this->entityRepo->getBySlug('chapter', $chapterSlug, $docSlug);
        $containedHtml = $this->exportService->chapterToPlainText($chapter);

        return response()->make($containedHtml, 200, [
            'Content-Type'        => 'application/octet-stream',
            'Content-Disposition' => 'attachment; filename="'.$chapterSlug.'.txt',
        ]);
    }

    /**
     * Export a chapter to a simple plaintext .txt file.
     *
     * @param string $docSlug
     * @param string $chapterSlug
     *
     * @return \Illuminate\Http\Response
     */
    public function rawPlainText($docSlug, $chapterSlug)
    {
        $chapter = $this->entityRepo->getBySlug('chapter', $chapterSlug, $docSlug);
        $containedHtml = $this->exportService->chapterToPlainText($chapter);

        return response()->make($containedHtml, 200, [
            'Content-Type'        => 'text/plain',
        ]);
    }
}
