<!DOCTYPE html>
@include('ascii')
<html lang="en" class="@yield('body-class')">
<head>
    <title>{{ isset($pageTitle) ? $pageTitle . ' | ' : '' }}{{ setting('app-name') }}</title>

    @include('header')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
    <script src="{{ baseUrl('/translations') }}"></script>

    @yield('head')

    @include('partials.custom-styles')

</head>
<body class="@yield('body-class')">

    @include('partials.notifications')

    <header id="header">
        <div class="container fluid">
            <div class="row">
                <div class="col-sm-4" ng-non-bindable>
                    <a href="{{ baseUrl('/') }}" class="logo">
                        @if(setting('app-logo', '') !== 'none')
                            <img class="logo-image" src="https://unpkg.com/docspen@18.0.5/imgs/docspen.svg" alt="Logo">
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
                                <input id="header-search-box-input" type="text" name="term" tabindex="2" maxlength="32" placeholder="{{ trans('common.search') }}" value="{{ isset($searchTerm) ? $searchTerm : ''  }}" name="message" minlength="3" required>
                            </form>
                        </div>
                        <div class="links text-center">
                            <a href="{{ baseUrl('/discover') }}" style="background:#e2e4e6;color:#4d4d4d"><i class="zmdi zmdi-group-work"></i>{{ trans('entities.discover') }}</a>
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
<script src="{{ hashed_asset('js/common.js') }}"></script>
@yield('scripts')
</body>
</html>
