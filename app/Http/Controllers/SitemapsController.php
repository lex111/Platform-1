<?php

namespace DocsPen\Http\Controllers;

use Illuminate\Http\Response;

class SitemapsController extends Controller
{
    public function index()
    {
        return response()->view('xml.index')
                    ->header('Content-Type', 'text/xml');
    }

    public function opensearch()
    {
        return response()->view('xml.opensearch')
                    ->header('Content-Type', 'text/xml');
    }
}
