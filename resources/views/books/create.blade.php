@extends('simple-layout')

@section('toolbar')
    <div class="col-sm-8 faded">
        <div class="breadcrumbs">
            <a href="{{ baseUrl('/books') }}" class="text-button"><i class="zmdi zmdi-book"></i>{{ trans('entities.books') }}</a>
            <img src="https://unpkg.com/docspen@6.0.0/imgs/arrow-right.svg" style="height:10px">
            <a href="{{ baseUrl('/books/create') }}" class="text-button"><i class="zmdi zmdi-plus"></i>{{ trans('entities.books_create') }}</a>
        </div>
    </div>
@stop

@section('body')

<div ng-non-bindable class="container small">
    <p>&nbsp;</p>
    <div class="card">
        <h3><i class="zmdi zmdi-plus"></i> {{ trans('entities.books_create') }}</h3>
        <div class="body">
            <form action="{{ baseUrl("/books") }}" method="POST" enctype="multipart/form-data">
                @include('books/form')
            </form>
        </div>
    </div>
</div>
<p class="margin-top large"><br></p>
    @include('components.image-manager', ['imageType' => 'cover'])
@stop