@extends('simple-layout')

@section('toolbar')
    @include('settings.navbar', ['selected' => 'settings'])
@stop

@section('body')
<div class="container small">

    <div class="text-right text-muted container">
        <br>
        DocsPen @if(strpos($version, 'v') !== 0) version @endif {{ $version }}
    </div>

    <div class="card">
        <h3><i class="zmdi zmdi-settings-square"></i> {{ trans('settings.app_settings') }}</h3>
        <div class="body">
            <form action="{{ baseUrl("/settings") }}" method="POST">
            {!! csrf_field() !!}
                <div class="row">

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="setting-app-name">{{ trans('settings.app_name') }}</label>
                            <p class="small">{{ trans('settings.app_name_desc') }}</p>
                            <input type="text" value="{{ setting('app-name', 'DocsPen') }}" name="setting-app-name" id="setting-app-name">
                        </div>
                        <div class="form-group">
                            <label>{{ trans('settings.app_name_header') }}</label>
                            @include('components.toggle-switch', ['name' => 'setting-app-name-header', 'value' => setting('app-name-header')])
                        </div>
                        <div class="form-group">
                            <label for="setting-app-public">{{ trans('settings.app_public_viewing') }}</label>
                            @include('components.toggle-switch', ['name' => 'setting-app-public', 'value' => setting('app-public')])
                        </div>
                        <div class="form-group">
                            <label>{{ trans('settings.app_secure_images') }}</label>
                            <p class="small">{{ trans('settings.app_secure_images_desc') }}</p>
                            @include('components.toggle-switch', ['name' => 'setting-app-secure-images', 'value' => setting('app-secure-images')])
                        </div>
                        <div class="form-group">
                            <label>{{ trans('settings.app_disable_comments') }}</label>
                            <p class="small">{{ trans('settings.app_disable_comments_desc') }}</p>
                            @include('components.toggle-switch', ['name' => 'setting-app-disable-comments', 'value' => setting('app-disable-comments')])
                        </div>
                        <div class="form-group">
                            <label for="setting-app-editor">{{ trans('settings.app_editor') }}</label>
                            <p class="small">{{ trans('settings.app_editor_desc') }}</p>
                            <select name="setting-app-editor" id="setting-app-editor">
                                <option @if(setting('app-editor') === 'wysiwyg') selected @endif value="wysiwyg">WYSIWYG</option>
                                <option @if(setting('app-editor') === 'markdown') selected @endif value="markdown">Markdown</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group" id="logo-control">
                            <label for="setting-app-logo">{{ trans('settings.app_logo') }}</label>
                            <p class="small">{!! trans('settings.app_logo_desc') !!}</p>

                            @include('components.image-picker', [
                                'resizeHeight' => '43',
                                'resizeWidth' => '200',
                                'showRemove' => true,
                                'defaultImage' => 'https://unpkg.com/docspen@1.0.0/imgs/logo-small.png',
                                'currentImage' => setting('app-logo'),
                                'name' => 'setting-app-logo',
                                'imageClass' => 'logo-image',
                                'currentId' => false
                            ])

                        </div>
                        <div class="form-group" id="color-control">
                            <label for="setting-app-color">{{ trans('settings.app_primary_color') }}</label>
                            <p class="small">{!! trans('settings.app_primary_color_desc') !!}</p>
                            <input type="text" value="{{ setting('app-color') }}" name="setting-app-color" id="setting-app-color" placeholder="#0288D1">
                            <input type="hidden" value="{{ setting('app-color-light') }}" name="setting-app-color-light" id="setting-app-color-light">
                        </div>
                        <div class="form-group" id="homepage-control">
                            <label for="setting-app-homepage">{{ trans('settings.app_homepage') }}</label>
                            <p class="small">{{ trans('settings.app_homepage_desc') }}</p>
                            @include('components.page-picker', ['name' => 'setting-app-homepage', 'placeholder' => trans('settings.app_homepage_default'), 'value' => setting('app-homepage')])
                        </div>
                    </div>

                </div>

                <div class="form-group">
                    <label for="setting-app-custom-head">{{ trans('settings.app_custom_html') }}</label>
                    <p class="small">{{ trans('settings.app_custom_html_desc') }}</p>
                    <textarea name="setting-app-custom-head" id="setting-app-custom-head">{{ setting('app-custom-head', '') }}</textarea>
                </div>

                <div class="form-group text-right">
                    <button type="submit" class="button pos">{{ trans('settings.settings_save') }}</button>
                </div>
            </form>
        </div>
    </div>

    <p>&nbsp;</p>

    <div class="card">
        <h3><i class="zmdi zmdi-accounts-add"></i> {{ trans('settings.reg_settings') }}</h3>
        <div class="body">
            <form action="{{ baseUrl("/settings") }}" method="POST">
                {!! csrf_field() !!}

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="setting-registration-enabled">{{ trans('settings.reg_allow') }}</label>
                            @include('components.toggle-switch', ['name' => 'setting-registration-enabled', 'value' => setting('registration-enabled')])
                        </div>
                        <div class="form-group">
                            <label for="setting-registration-role">{{ trans('settings.reg_default_role') }}</label>
                            <select id="setting-registration-role" name="setting-registration-role" @if($errors->has('setting-registration-role')) class="neg" @endif>
                                @foreach(\DocsPen\Role::all() as $role)
                                    <option value="{{$role->id}}" data-role-name="{{ $role->name }}"
                                            @if(setting('registration-role', \DocsPen\Role::first()->id) == $role->id) selected @endif
                                    >
                                        {{ $role->display_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="setting-registration-confirmation">{{ trans('settings.reg_confirm_email') }}</label>
                            <p class="small">{{ trans('settings.reg_confirm_email_desc') }}</p>
                            @include('components.toggle-switch', ['name' => 'setting-registration-confirmation', 'value' => setting('registration-confirmation')])
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="setting-registration-restrict">{{ trans('settings.reg_confirm_restrict_domain') }}</label>
                            <p class="small">{!! trans('settings.reg_confirm_restrict_domain_desc') !!}</p>
                            <input type="text" id="setting-registration-restrict" name="setting-registration-restrict" placeholder="{{ trans('settings.reg_confirm_restrict_domain_placeholder') }}" value="{{ setting('registration-restrict', '') }}">
                        </div>
                    </div>
                </div>

                <div class="form-group text-right">
                    <button type="submit" class="button pos">{{ trans('settings.settings_save') }}</button>
                </div>
            </form>
        </div>
    </div>

</div>

@include('components.image-manager', ['imageType' => 'system'])
@include('components.entity-selector-popup', ['entityTypes' => 'page'])

@stop