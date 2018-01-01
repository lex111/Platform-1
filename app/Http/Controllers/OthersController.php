<?php

namespace DocsPen\Http\Controllers;

use Activity;
use DocsPen\Repos\EntityRepo;
use Illuminate\Http\Response;
use Views;

class OthersController extends Controller
{
    public function credits()
    {
        return view('others.credits');
    }
}