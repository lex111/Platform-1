<!DOCTYPE html>
<html lang="en" class="@yield('body-class')">
<head>
    <title>{{ isset($pageTitle) ? $pageTitle . ' | ' : '' }}{{ setting('app-name') }}</title>

    <meta name="viewport" content="width=device-width">
    <meta name="token" content="{{ csrf_token() }}">
    <meta name="base-url" content="{{ baseUrl('/') }}">
    <meta name="theme-color" content="#026AA7">
    <meta charset="utf-8">

    <link rel="manifest" href="/manifest.json">
    <link rel="icon" type="image/png" href="https://cdn.jsdelivr.net/npm/docspen@1.0.0/imgs/logo-small.png" />
    <link rel="stylesheet" href="{{ versioned_asset('css/styles.css') }}">
    <link rel="stylesheet" media="print" href="{{ versioned_asset('css/print-styles.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/material-design-iconic-font@2.2.0/dist/css/material-design-iconic-font.min.css">

    <script src="https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-ui-stable-build@1.11.4/jquery-ui.min.js"></script>
    <script src="{{ baseUrl('/translations') }}"></script>

    @yield('head')

    @include('partials/custom-styles')

    @if(setting('app-custom-head') && \Route::currentRouteName() !== 'settings')
        <!-- Custom user content -->
        {!! setting('app-custom-head') !!}
        <!-- End custom user content -->
    @endif
</head>
<body class="@yield('body-class')">

    @include('partials/notifications')

    <header id="header">
        <div class="container fluid">
            <div class="row">
                <div class="col-sm-4" ng-non-bindable>
                    <a href="{{ baseUrl('/') }}" class="logo">
                        @if(setting('app-logo', '') !== 'none')
                            <img class="logo-image" src="https://cdn.jsdelivr.net/npm/docspen@1.0.0/imgs/logo-small.png" alt="Logo">
                        @endif
                        @if (setting('app-name-header'))
                            <span class="logo-text">{{ setting('app-name') }}</span>
                        @endif
                    </a>
                </div>
                <div class="col-sm-8">
                    <div class="float right">
                        <div class="header-search">
                            <form action="{{ baseUrl('/search') }}" method="GET" class="search-box">
                                <button id="header-search-box-button" type="submit"><i class="zmdi zmdi-search"></i> </button>
                                <input id="header-search-box-input" type="text" name="term" tabindex="2" placeholder="{{ trans('common.search') }}" value="{{ isset($searchTerm) ? $searchTerm : '' }}">
                            </form>
                        </div>
                        <div class="links text-center">
                            <a href="{{ baseUrl('/books') }}" style="background:#e2e4e6;color:#4d4d4d"><i class="zmdi zmdi-book"></i>{{ trans('entities.books') }}</a>
                            @if(signedInUser())
                                <a href="{{ baseUrl('books/create') }}"><i class="zmdi zmdi-edit"></i>{{ trans('common.create') }}</a>
                            @endif
                            @if(!signedInUser())
                                <a href="{{ baseUrl('/login') }}"><i class="zmdi zmdi-sign-in"></i>{{ trans('auth.log_in') }}</a>
                            @endif
                        </div>
                        @if(signedInUser())
                            @include('partials._header-dropdown', ['currentUser' => user()])
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </header>

    <section id="content" class="block">
        @yield('content')
    </section>

    <div back-to-top>
        <div class="inner">
            <i class="zmdi zmdi-chevron-up"></i> <span>{{ trans('common.back_to_top') }}</span>
        </div>
    </div>
@yield('bottom')
<script src="{{ versioned_asset('js/common.js') }}"></script>
@yield('scripts')
</body>
</html>
