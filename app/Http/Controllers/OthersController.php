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
    
    // Return Success if Contact Message Sent
    public function success()
    {
        return view('others.success');
    }

    // ToDos on Trello Kanban
    public function trello()
    {
        return redirect('https://trello.com/b/nUennIKj');
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

    // Contact Page
    public function contact()
    {
        return view('others.contact');
    }

    // For Status used for checking Hearbeat of Server
    public function ping()
    {
        return 'pong';
    }
}
