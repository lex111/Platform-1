<?php

/**
 * Copyright (c) 2017 - present, DocsPen, Inc.
 * All rights reserved.
 *
 * This source code is licensed under the license found in the
 * LICENSE file in the root directory of this source tree.
 */

namespace DocsPen\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Setting;

class SitemapsController extends Controller
{
    public function index()
    {
        return response()->view('sitemaps.index')
                    ->header('Content-Type', 'text/xml');
    }

    public function books()
    {
        return response()->view('sitemaps.books')
                    ->header('Content-Type', 'text/xml');
    }

    public function pages()
    {
        return response()->view('sitemaps.pages')
                    ->header('Content-Type', 'text/xml');
    }

    public function chapters()
    {
        return response()->view('sitemaps.chapters')
                    ->header('Content-Type', 'text/xml');
    }

    public function users()
    {
        $listDetails = [
            'order'  => $request->get('order', 'asc'),
            'search' => $request->get('search', ''),
            'sort'   => $request->get('sort', 'name'),
        ];
        $users = $this->userRepo->getAllUsersPaginatedAndSorted(20, $listDetails);
        $users->appends($listDetails);
        
        return response()->view('sitemaps.users', compact('users'))
                    ->header('Content-Type', 'text/xml');
    }
}
