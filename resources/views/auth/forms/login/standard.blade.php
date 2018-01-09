<div class="form-group">
<<<<<<< HEAD
    <label for="email">{{ trans('auth.email') }}</label>
    @include('form/text', ['name' => 'email', 'tabindex' => 1])
</div>

<div class="form-group">
    <label for="password">{{ trans('auth.password') }}</label>
    @include('form/password', ['name' => 'password', 'tabindex' => 2])
=======
    <label for="email" required>{{ trans('auth.email') }}</label>
    @include('form.text', ['name' => 'email', 'tabindex' => 1])
</div>

<div class="form-group">
    <label for="password" required>{{ trans('auth.password') }}</label>
    @include('form.password', ['name' => 'password', 'tabindex' => 2])
>>>>>>> 0301ba6234aea7f405b61d35174b679172400e2d
    <span class="block small"><a href="{{ baseUrl('/password/email') }}">{{ trans('auth.forgot_password') }}</a></span>
</div>