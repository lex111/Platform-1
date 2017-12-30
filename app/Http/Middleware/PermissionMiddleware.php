<?php

/**
 * Copyright (c) 2017 - present, DocsPen, Inc.
 * All rights reserved.
 *
 * This source code is licensed under the license found in the
 * LICENSE file in the root directory of this source tree.
 */

namespace DocsPen\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;

class PermissionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     * @param                          $permission
     *
     * @return mixed
     */
    public function handle($request, Closure $next, $permission)
    {
        if (!$request->user() || !$request->user()->can($permission)) {
            Session::flash('error', trans('errors.permission'));

            return redirect()->back();
        }

        return $next($request);
    }
}
