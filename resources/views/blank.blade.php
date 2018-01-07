<!DOCTYPE html>
<html class="shaded" style="background-color:#f2f2f2;background-image: url(https://unpkg.com/docspen@14.0.0/imgs/pattern.svg)">
<head>
    <title>{{ setting('app-name') }} - Auth</title>
    
    @include('inc.header')
    @include('partials.custom-styles')

</head>
<body class="@yield('body-class')">

@include('partials.notifications')

<section class="container">
    @yield('content')
</section>

<script src="{{ hashed_asset('js/common.js') }}"></script>
</body>
</html>
