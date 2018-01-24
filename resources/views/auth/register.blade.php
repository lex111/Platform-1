@extends('public')

@section('header-buttons')
    <a href="{{ baseUrl("/login") }}"><i class="zmdi zmdi-sign-in"></i>{{ trans('auth.log_in') }}</a>
@stop

@section('content')

    <div class="text-center">

        <a href="/"> <img class="auth-logo" class="logo-image" src="https://unpkg.com/docspen@18.0.6/imgs/docspen-white.svg" alt="Logo"></a>
        <h5 class="auth">Sign up to DocsPen</h5>

        <div class="card auth-border center-box">
            <div class="body">
                <form action="{{ baseUrl("/register") }}" method="POST">
                    {!! csrf_field() !!}

                    <div class="form-group">
                        <label for="email" required>{{ trans('auth.name') }}</label>
                        @include('form.text', ['name' => 'name'])
                    </div>

                    <div class="form-group">
                        <label for="email" required>{{ trans('auth.email') }}</label>
                        @include('form.text', ['name' => 'email'])
                    </div>

                    <div class="form-group">
                        <label for="password" required>{{ trans('auth.password') }}</label>
                        @include('form.password', ['name' => 'password', 'placeholder' => trans('auth.password_hint')])
                    </div>

                    <div class="from-group">
                        <button class="button block pos"><i class="zmdi zmdi-plus"></i>{{ trans('auth.create_account') }}</button>
                    </div>
                </form>

                @if(count($socialDrivers) > 0)
                    <hr class="margin-top">
                    @foreach($socialDrivers as $driver => $name)
                        <a id="social-register-{{$driver}}" class="button block muted-light svg text-left" href="{{ baseUrl("/register/service/" . $driver) }}">
                            @icon($driver)
                            {{ trans('auth.sign_up_with', ['socialDriver' => $name]) }}
                        </a>
                    @endforeach
                @endif
            </div>
        </div>

        <div class="text-center">
            <div class="card auth-border center-box">
                <div class="from-group">
                    <div class="auth-box">
                        <p style="text-align:center">Already in DocsPen? <a href="/login">Login</a>.</p>
                    </div>
                </div>
            </div>
        </div>

    </div>

@stop
