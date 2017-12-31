<?php

/**
 * Copyright (c) 2017 - present, DocsPen, Inc.
 * All rights reserved.
 *
 * This source code is licensed under the license found in the
 * LICENSE file in the root directory of this source tree.
 */

namespace DocsPen\Http\Controllers;

use Activity;
use DocsPen\Repos\EntityRepo;
use Illuminate\Http\Response;
use Views;

class HomeController extends Controller
{
    protected $entityRepo;

    /**
     * HomeController constructor.
     *
     * @param EntityRepo $entityRepo
     */
    public function __construct(EntityRepo $entityRepo)
    {
        $this->entityRepo = $entityRepo;
        parent::__construct();
    }

    /**
     * Display the homepage.
     *
     * @return Response
     */
    public function index()
    {
        $activity = Activity::latest(11);
        $draftPages = $this->signedIn ? $this->entityRepo->getUserDraftPages(6) : [];
        $recentFactor = count($draftPages) > 0 ? 0.5 : 1;
        $recents = $this->signedIn ? Views::getUserRecentlyViewed(13 * $recentFactor, 0) : $this->entityRepo->getRecentlyCreated('book', 13 * $recentFactor);
        $recentlyUpdatedPages = $this->entityRepo->getRecentlyUpdated('page', 13);

        // Custom homepage
        $customHomepage = false;
        $homepageSetting = setting('app-homepage');
        if ($homepageSetting) {
            $id = intval(explode(':', $homepageSetting)[0]);
            $customHomepage = $this->entityRepo->getById('page', $id, false, true);
            $this->entityRepo->renderPage($customHomepage, true);
        }

        $view = $customHomepage ? 'home-custom' : 'home';

        return view($view, [
            'activity'             => $activity,
            'recents'              => $recents,
            'recentlyUpdatedPages' => $recentlyUpdatedPages,
            'draftPages'           => $draftPages,
            'customHomepage'       => $customHomepage,
        ]);
    }

    /**
     * Get a js representation of the current translations.
     *
     * @throws \Exception
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function getTranslations()
    {
        $locale = app()->getLocale();
        $cacheKey = 'GLOBAL_TRANSLATIONS_'.$locale;
        if (cache()->has($cacheKey) && config('app.env') !== 'development') {
            $resp = cache($cacheKey);
        } else {
            $translations = [
                // Get only translations which might be used in JS
                'common'     => trans('common'),
                'components' => trans('components'),
                'entities'   => trans('entities'),
                'errors'     => trans('errors'),
            ];
            if ($locale !== 'en') {
                $enTrans = [
                    'common'     => trans('common', [], 'en'),
                    'components' => trans('components', [], 'en'),
                    'entities'   => trans('entities', [], 'en'),
                    'errors'     => trans('errors', [], 'en'),
                ];
                $translations = array_replace_recursive($enTrans, $translations);
            }
            $resp = 'window.translations = '.json_encode($translations);
            cache()->put($cacheKey, $resp, 120);
        }

        return response($resp, 200, [
            'Content-Type' => 'application/javascript',
        ]);
    }

    /**
     * Get custom head HTML, Used in ajax calls to show in editor.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function customHeadContent()
    {
        return view('partials/custom-head-content');
    }
}
