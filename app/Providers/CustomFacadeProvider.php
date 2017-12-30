<?php

/**
 * Copyright (c) 2017 - present, DocsPen, Inc.
 * All rights reserved.
 *
 * This source code is licensed under the license found in the
 * LICENSE file in the root directory of this source tree.
 */

namespace DocsPen\Providers;

use DocsPen\Activity;
use DocsPen\Services\ActivityService;
use DocsPen\Services\ImageService;
use DocsPen\Services\PermissionService;
use DocsPen\Services\SettingService;
use DocsPen\Services\ViewService;
use DocsPen\Setting;
use DocsPen\View;
use Illuminate\Contracts\Cache\Repository;
use Illuminate\Contracts\Filesystem\Factory;
use Illuminate\Support\ServiceProvider;
use Intervention\Image\ImageManager;

class CustomFacadeProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('activity', function () {
            return new ActivityService(
                $this->app->make(Activity::class),
                $this->app->make(PermissionService::class)
            );
        });

        $this->app->bind('views', function () {
            return new ViewService(
                $this->app->make(View::class),
                $this->app->make(PermissionService::class)
            );
        });

        $this->app->bind('setting', function () {
            return new SettingService(
                $this->app->make(Setting::class),
                $this->app->make(Repository::class)
            );
        });

        $this->app->bind('images', function () {
            return new ImageService(
                $this->app->make(ImageManager::class),
                $this->app->make(Factory::class),
                $this->app->make(Repository::class)
            );
        });
    }
}
