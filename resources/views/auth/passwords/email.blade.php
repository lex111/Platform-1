@extends('public')

@section('header-buttons')
    <a href="{{ baseUrl("/login") }}"><i class="zmdi zmdi-sign-in"></i>{{ trans('auth.log_in') }}</a>
    @if(setting('registration-enabled'))
        <a href="{{ baseUrl("/register") }}"><i class="zmdi zmdi-account-add"></i>{{ trans('auth.sign_up') }}</a>
    @endif
@stop

@section('content')


    <div class="text-center">
        
        <a href="/"> <img class="auth-logo" class="logo-image" src="https://unpkg.com/docspen@1.0.0/imgs/logo-small.png" alt="Logo"></a>
        <h5 class="auth">{{ trans('auth.reset_password') }}</h5>

        <div class="center-box text-left">
            <p class="muted small">{{ trans('auth.reset_password_send_instructions') }}</p>

            <form action="{{ baseUrl("/password/email") }}" method="POST">
                {!! csrf_field() !!}

                <div class="form-group">
                    <label for="email">{{ trans('auth.email') }}</label>
                    @include('form.text', ['name' => 'email'])
                </div>

                <div class="from-group">
                    <button class="button block pos">{{ trans('auth.reset_password_send_button') }}</button>
                </div>
            </form>
        </div>
    </div>

    <div class="text-center">
        <div class="card auth-border center-box">
            <div class="from-group">
                <div class="auth-box">
                    <p style="text-align:center"><a href="/login">Login</a> or <a href="/register">Sign Up</a></p>
                </div>
            </div>
        </div>
    </div>

@stop