@extends('simple-layout')

@section('content')

<div class="container">

    <p>&nbsp;</p>

    <div class="card" style="background-color:transparent;box-shadow:none">
        <div class="body">
            <center>
                <img src="https://unpkg.com/docspen@8.0.0/imgs/404.svg" style="width:100%;height:13em;pointer-events:none">
                <p><a href="{{ baseUrl('/') }}" class="button outline" style="margin-top:34px">{{ trans('errors.return_home') }}</a></p>
            </center>
        </div>
    </div>

    @if (setting('app-public') || !user()->isDefault())

        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <h3 class="text-muted"><i class="zmdi zmdi-file-text"></i> {{ trans('entities.pages_popular') }}</h3>
                    @include('partials.entity-list', ['entities' => Views::getPopular(10, 0, [\DocsPen\Page::class]), 'style' => 'compact'])
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <h3 class="text-muted"><i class="zmdi zmdi-book"></i> {{ trans('entities.books_popular') }}</h3>
                    @include('partials.entity-list', ['entities' => Views::getPopular(10, 0, [\DocsPen\Book::class]), 'style' => 'compact'])
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <h3 class="text-muted"><i class="zmdi zmdi-collection-bookmark"></i> {{ trans('entities.chapters_popular') }}</h3>
                    @include('partials.entity-list', ['entities' => Views::getPopular(10, 0, [\DocsPen\Chapter::class]), 'style' => 'compact'])
                </div>
            </div>
        </div>
    @endif
</div>

@stop
