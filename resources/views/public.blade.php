<!DOCTYPE html>
<html class="shaded">
<head>
    <title>{{ setting('app-name') }}</title>

    <link rel="dns-prefetch" href="https://docspen.ga">
    <link rel="dns-prefetch" href="https://unpkg.com">
    <link rel="dns-prefetch" href="https://cdnjs.cloudflare.com">
    <link rel="dns-prefetch" href="https://i1.wp.com">

    <meta name="viewport" content="width=device-width">
    <meta name="token" content="{{ csrf_token() }}">
    <meta name="base-url" content="{{ baseUrl('/') }}">
    <meta name="theme-color" content="#026AA7">
    <meta name="mobile-web-app-capable" content="yes">
    <meta charset="utf-8">
    <meta name="description" content="DocsPen - Online Documentation Platform. Read more, know more.">
    <meta name="keywords" content="DocsPen, Docs, Documentation, Project Documentation, Wiki">
    
    <link rel="icon" type="image/png" href="https://unpkg.com/docspen@7.0.0/imgs/favicon.png" />
    <link rel="stylesheet" href="{{ hashed_asset('css/styles.css') }}">
    <link rel="stylesheet" media="print" href="{{ hashed_asset('css/print-styles.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css">
    <link rel="manifest" href="/manifest.json">
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script>
    	if ('serviceWorker' in navigator && navigator.userAgent.indexOf("Mobile") === -1) {
    		navigator.serviceWorker.register('/service-worker.js').then(function(registration) {
    			console.log('ServiceWorker registration successful with scope: ', registration.scope);
    			console.log('DocsPen ♥\'s web');
    		})
    		.catch(function(err) {
    			console.error('ServiceWorker registration failed: ', err);
    		});
    	} else if('serviceWorker' in navigator && navigator.userAgent.indexOf("Mobile") > -1){
            navigator.serviceWorker.getRegistration().then(function(registration) {
                var serviceWorkerUnregistered=false;
                if(registration) {
                    registration.unregister();
                    serviceWorkerUnregistered=true;
                }
                serviceWorkerUnregistered && window.location.reload();
            });
        }
    </script>
    
    @include('partials/custom-styles')

    <!-- Custom user content -->
    @if(setting('app-custom-head'))
        {!! setting('app-custom-head') !!}
    @endif
</head>
<body class="@yield('body-class')">

@include('partials.notifications')

<header id="header">
    <div class="container fluid">
        <div class="row">
            <div class="col-sm-6">

                <a href="{{ baseUrl('/') }}" class="logo">
                    @if(setting('app-logo', '') !== 'none')
                        <img class="logo-image" src="https://unpkg.com/docspen@1.0.0/imgs/logo-small.png" alt="Logo">
                    @endif
                    @if (setting('app-name-header'))
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
