<?php

namespace DocsPen\Http\Controllers;

use Illuminate\Http\Response;

class SitemapsController extends Controller
{
    public function index()
    {
        return response()->view('sitemaps.index')
                    ->header('Content-Type', 'text/xml');
    }
}
