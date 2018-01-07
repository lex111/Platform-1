<!DOCTYPE html>
<html class="shaded" style="background:#f9f9f9">
<head>
    <title>{{ setting('app-name') }}</title>
    
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
