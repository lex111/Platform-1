@extends('simple-layout')

@section('content')
   <div class="text-center">
        <div class="card auth-border center-box">
            <div class="body">
                <form action="{{ baseUrl("/register") }}" method="POST">

                    <div class="form-group">
                        <label for="email">E-Mail</label>
                        <input class="input" type="email" name="email" id="email" required>
                    </div>

                    <div class="form-group">
                        <label for="email">{{ trans('auth.email') }}</label>
                    </div>

                    <div class="form-group">
                        <label for="password">{{ trans('auth.password') }}</label>
                    </div>

                    <div class="from-group">
                        <button class="button block pos"><i class="zmdi zmdi-plus"></i>{{ trans('auth.create_account') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop