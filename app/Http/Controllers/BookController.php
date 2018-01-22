<?php

namespace DocsPen\Http\Controllers;

use Activity;
use DocsPen\Book;
use DocsPen\Repos\EntityRepo;
use DocsPen\Repos\UserRepo;
use DocsPen\Services\ExportService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Views;

class BookController extends Controller
{
    protected $entityRepo;
    protected $userRepo;
    protected $exportService;

    /**
     * BookController constructor.
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
     * Display a listing of the book.
     *
     * @return Response
     */
    public function index()
    {
        $books = $this->entityRepo->getAllPaginated('book', 12);
        $recents = $this->signedIn ? $this->entityRepo->getRecentlyViewed('book', 4, 0) : false;
        $popular = $this->entityRepo->getPopular('book', 4, 0);
        $new = $this->entityRepo->getRecentlyCreated('book', 4, 0);
        $booksViewType = setting()->getUser($this->currentUser, 'books_view_type', 'list');
        $this->setPageTitle(trans('entities.books'));

        return view('books/index', [
            'books'         => $books,
            'recents'       => $recents,
            'popular'       => $popular,
            'new'           => $new,
            'booksViewType' => $booksViewType,
        ]);
    }

    /**
     * Show the form for creating a new book.
     *
     * @return Response
     */
    public function create()
    {
        $this->checkPermission('book-create-all');
        $this->setPageTitle(trans('entities.books_create'));

        return view('books/create');
    }

    /**
     * Store a newly created book in storage.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $this->checkPermission('book-create-all');
        $this->validate($request, [
            'name'        => 'required|string|max:30|min:3',
            'description' => 'string|max:160',
        ]);
        $book = $this->entityRepo->createFromInput('book', $request->all());
        Activity::add($book, 'book_create', $book->id);

        return redirect($book->getUrl());
    }

    /**
     * Display the specified book.
     *
     * @param $slug
     *
     * @return Response
     */
    public function show($slug)
    {
        $book = $this->entityRepo->getBySlug('book', $slug);
        $this->checkOwnablePermission('book-view', $book);
        $bookChildren = $this->entityRepo->getBookChildren($book);
        Views::add($book);
        $this->setPageTitle($book->getShortName());

        return view('books/show', [
            'book'         => $book,
            'current'      => $book,
            'bookChildren' => $bookChildren,
            'activity'     => Activity::entityActivity($book, 20, 0),
        ]);
    }

    /**
     * Show the form for editing the specified book.
     *
     * @param $slug
     *
     * @return Response
     */
    public function edit($slug)
    {
        $book = $this->entityRepo->getBySlug('book', $slug);
        $this->checkOwnablePermission('book-update', $book);
        $this->setPageTitle(trans('entities.books_edit_named', ['bookName'=>$book->getShortName()]));

        return view('books/edit', ['book' => $book, 'current' => $book]);
    }

    /**
     * Update the specified book in storage.
     *
     * @param Request $request
     * @param         $slug
     *
     * @return Response
     */
    public function update(Request $request, $slug)
    {
        $book = $this->entityRepo->getBySlug('book', $slug);
        $this->checkOwnablePermission('book-update', $book);
        $this->validate($request, [
            'name'        => 'required|string|max:30|min:3',
            'description' => 'string|max:160',
        ]);
        $book = $this->entityRepo->updateFromInput('book', $book, $request->all());
        Activity::add($book, 'book_update', $book->id);

        return redirect($book->getUrl());
    }

    /**
     * Shows the page to confirm deletion.
     *
     * @param $docSlug
     *
     * @return \Illuminate\View\View
     */
    public function showDelete($docSlug)
    {
        $book = $this->entityRepo->getBySlug('book', $docSlug);
        $this->checkOwnablePermission('book-delete', $book);
        $this->setPageTitle(trans('entities.books_delete_named', ['bookName'=>$book->getShortName()]));

        return view('books/delete', ['book' => $book, 'current' => $book]);
    }

    /**
     * Shows the view which allows pages to be re-ordered and sorted.
     *
     * @param string $docSlug
     *
     * @return \Illuminate\View\View
     */
    public function sort($docSlug)
    {
        $book = $this->entityRepo->getBySlug('book', $docSlug);
        $this->checkOwnablePermission('book-update', $book);
        $bookChildren = $this->entityRepo->getBookChildren($book, true);
        $books = $this->entityRepo->getAll('book', false, 'update');
        $this->setPageTitle(trans('entities.books_sort_named', ['bookName'=>$book->getShortName()]));

        return view('docs/sort', ['book' => $book, 'current' => $book, 'books' => $books, 'bookChildren' => $bookChildren]);
    }

    /**
     * Shows the sort box for a single book.
     * Used via AJAX when loading in extra books to a sort.
     *
     * @param $docSlug
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getSortItem($docSlug)
    {
        $book = $this->entityRepo->getBySlug('book', $docSlug);
        $bookChildren = $this->entityRepo->getBookChildren($book);

        return view('docs/sort-box', ['book' => $book, 'bookChildren' => $bookChildren]);
    }

    /**
     * Saves an array of sort mapping to pages and chapters.
     *
     * @param string  $docSlug
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function saveSort($docSlug, Request $request)
    {
        $book = $this->entityRepo->getBySlug('book', $docSlug);
        $this->checkOwnablePermission('book-update', $book);

        // Return if no map sent
        if (!$request->filled('sort-tree')) {
            return redirect($book->getUrl());
        }

        // Sort pages and chapters
        $sortMap = collect(json_decode($request->get('sort-tree')));
        $bookIdsInvolved = collect([$book->id]);

        // Load models into map
        $sortMap->each(function ($mapItem) use ($bookIdsInvolved) {
            $mapItem->type = ($mapItem->type === 'page' ? 'page' : 'chapter');
            $mapItem->model = $this->entityRepo->getById($mapItem->type, $mapItem->id);
            // Store source and target docs
            $bookIdsInvolved->push(intval($mapItem->model->book_id));
            $bookIdsInvolved->push(intval($mapItem->book));
        });

        // Get the docs involved in the sort
        $bookIdsInvolved = $bookIdsInvolved->unique()->toArray();
        $booksInvolved = $this->entityRepo->book->newQuery()->whereIn('id', $bookIdsInvolved)->get();
        // Throw permission error if invalid ids or inaccessible docs given.
        if (count($bookIdsInvolved) !== count($booksInvolved)) {
            $this->showPermissionError();
        }
        // Check permissions of involved docs
        $booksInvolved->each(function (Book $book) {
            $this->checkOwnablePermission('book-update', $book);
        });

        // Perform the sort
        $sortMap->each(function ($mapItem) {
            $model = $mapItem->model;

            $priorityChanged = intval($model->priority) !== intval($mapItem->sort);
            $bookChanged = intval($model->book_id) !== intval($mapItem->book);
            $chapterChanged = ($mapItem->type === 'page') && intval($model->chapter_id) !== $mapItem->parentChapter;

            if ($bookChanged) {
                $this->entityRepo->changeBook($mapItem->type, $mapItem->book, $model);
            }
            if ($chapterChanged) {
                $model->chapter_id = intval($mapItem->parentChapter);
                $model->save();
            }
            if ($priorityChanged) {
                $model->priority = intval($mapItem->sort);
                $model->save();
            }
        });

        // Rebuild permissions and add activity for involved docs.
        $booksInvolved->each(function (Book $book) {
            $this->entityRepo->buildJointPermissionsForBook($book);
            Activity::add($book, 'book_sort', $book->id);
        });

        return redirect($book->getUrl());
    }

    /**
     * Remove the specified book from storage.
     *
     * @param $docSlug
     *
     * @return Response
     */
    public function destroy($docSlug)
    {
        $book = $this->entityRepo->getBySlug('book', $docSlug);
        $this->checkOwnablePermission('book-delete', $book);
        Activity::addMessage('book_delete', 0, $book->name);
        $this->entityRepo->destroyBook($book);

        return redirect('/docs');
    }

    /**
     * Show the Restrictions view.
     *
     * @param $docSlug
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showRestrict($docSlug)
    {
        $book = $this->entityRepo->getBySlug('book', $docSlug);
        $this->checkOwnablePermission('restrictions-manage', $book);
        $roles = $this->userRepo->getRestrictableRoles();

        return view('docs/restrictions', [
            'book'  => $book,
            'roles' => $roles,
        ]);
    }

    /**
     * Set the restrictions for this book.
     *
     * @param $docSlug
     * @param $docSlug
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function restrict($docSlug, Request $request)
    {
        $book = $this->entityRepo->getBySlug('book', $docSlug);
        $this->checkOwnablePermission('restrictions-manage', $book);
        $this->entityRepo->updateEntityPermissionsFromRequest($request, $book);
        session()->flash('success', trans('entities.books_permissions_updated'));

        return redirect($book->getUrl());
    }

    /**
     * Export a book as a PDF file.
     *
     * @param string $docSlug
     *
     * @return mixed
     */
    public function exportPdf($docSlug)
    {
        $book = $this->entityRepo->getBySlug('book', $docSlug);
        $pdfContent = $this->exportService->bookToPdf($book);

        return response()->make($pdfContent, 200, [
            'Content-Type'        => 'application/octet-stream',
            'Content-Disposition' => 'attachment; filename="'.$docSlug.'.pdf',
        ]);
    }

    /**
     * Export a book as a contained HTML file.
     *
     * @param string $docSlug
     *
     * @return mixed
     */
    public function exportHtml($docSlug)
    {
        $book = $this->entityRepo->getBySlug('book', $docSlug);
        $htmlContent = $this->exportService->bookToContainedHtml($book);

        return response()->make($htmlContent, 200, [
            'Content-Type'        => 'application/octet-stream',
            'Content-Disposition' => 'attachment; filename="'.$docSlug.'.html',
        ]);
    }

    /**
     * Export a book as a plain text file.
     *
     * @param $docSlug
     *
     * @return mixed
     */
    public function exportPlainText($docSlug)
    {
        $book = $this->entityRepo->getBySlug('book', $docSlug);
        $htmlContent = $this->exportService->bookToPlainText($book);

        return response()->make($htmlContent, 200, [
            'Content-Type'        => 'application/octet-stream',
            'Content-Disposition' => 'attachment; filename="'.$docSlug.'.txt',
        ]);
    }

    /**
     * Export a book as a plain text file.
     *
     * @param $docSlug
     *
     * @return mixed
     */
    public function rawPlainText($docSlug)
    {
        $book = $this->entityRepo->getBySlug('book', $docSlug);
        $htmlContent = $this->exportService->bookToPlainText($book);

        return response()->make($htmlContent, 200, [
            'Content-Type'        => 'text/plain',
        ]);
    }
}
