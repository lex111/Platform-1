<?php

namespace DocsPen\Http\Controllers;

use Activity;
use DocsPen\Repos\EntityRepo;
use Illuminate\Http\Response;
use Views;

class PagesController extends Controller
{
    public function credits()
    {
        return view('others.credits');
    }
}