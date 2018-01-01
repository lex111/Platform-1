<?php

/**
 * Copyright (c) 2017 - present, DocsPen, Inc.
 * All rights reserved.
 *
 * This source code is licensed under the license found in the
 * LICENSE file in the root directory of this source tree.
 */

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
