<!DOCTYPE html>

@include('ascii')

<html class="shaded" style="background-color:#534292">
<head>
    <title>{{ setting('app-name') }}</title>

    @include('header')

    @include('partials.custom-styles')

</head>
<body class="@yield('body-class')">

@include('partials.notifications')

<header id="header">
    <div class="container fluid">
        <div class="row">
            <div class="col-sm-6">

                <a href="{{ baseUrl('/') }}" class="logo">
                    @if(setting('app-logo', '') !== 'none')
                        <img class="logo-image" src="https://unpkg.com/docspen@18.0.5/imgs/docspen.svg" alt="Logo">
                    @endif
                    @if(setting('app-name-header'))
                        <span class="logo-text">{{ setting('app-name') }}</span>
                    @endif
                </a>
            </div>
            <div class="col-sm-6">
                <div class="float right">
                    <div class="links text-center">
                        @yield('header-buttons')
                    </div>
                    @if(isset($signedIn) && $signedIn)
                        @include('partials._header-dropdown', ['currentUser' => $currentUser])
                    @endif
                </div>
            </div>
        </div>
    </div>
</header>

<section class="container">
    @yield('content')
</section>

<script src="{{ hashed_asset('js/common.js') }}"></script>
</body>
</html>
