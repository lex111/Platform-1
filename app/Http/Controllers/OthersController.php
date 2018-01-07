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

    // ToDos on Trello Kanban
    public function trello()
    {
        return redirect('https://trello.com/b/nUennIKj/docspen');
    }

    // Source code on GitHub
    public function git()
    {
        return redirect('https://github.com/DocsPen/Platform');
    }

    // Blog on Tumblr
    public function blog()
    {
        return redirect('https://docspen.tumblr.com');
    }

    // Status Page
    public function status()
    {
        return redirect('https://stats.uptimerobot.com/jZDKmIREm');
    }

    // For Status used for checking Hearbeat of Server
    public function ping()
    {
        return 'pong';
    }
}
