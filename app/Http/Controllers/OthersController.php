<?php

namespace DocsPen\Http\Controllers;

class OthersController extends Controller
{
    // Pages
    public function about()
    {
        return view('others.about');
    }

    public function credits()
    {
        return view('others.credits');
    }

    public function terms()
    {
        return view('others.terms');
    }

    public function privacy()
    {
        return view('others.privacy');
    }
}
