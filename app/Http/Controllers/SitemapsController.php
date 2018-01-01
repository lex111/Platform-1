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
        return response()->view('sitemaps.users')
                    ->header('Content-Type', 'text/xml');
    }
}
