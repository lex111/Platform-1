<?php

namespace DocsPen\Http\Controllers;

class OthersController extends Controller
{
    // Pages
    public function about()
    {
        return view('others.about');
    }

    public function terms()
    {
        return view('others.terms');
    }

    public function trello()
    {
        return redirect('https://trello.com/b/nUennIKj/docspen');
    }

    public function git()
    {
        return redirect('https://github.com/DocsPen/Platform');
    }

    public function blog()
    {
        return redirect('https://docspen.tumblr.com');
    }

    public function status()
    {
        return redirect('https://stats.uptimerobot.com/jZDKmIREm');
    }

    public function ping()
    {
        return 'pong';
    }
}
