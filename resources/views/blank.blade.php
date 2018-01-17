<!DOCTYPE html>
<html class="auth-style">
<head>
    <title>{{ setting('app-name') }} - Auth</title>
    
    @include('header')
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
