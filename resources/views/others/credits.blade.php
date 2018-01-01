@extends('simple-layout')

@section('content')

<div class="container">
    <p>&nbsp;</p>
    <div class="card" style="background-color:transparent;box-shadow:none">
        <div class="body">
            <center><img src="https://cdn.jsdelivr.net/npm/docspen@8.0.0/imgs/404.svg" style="width:100%;height:13em;pointer-events:none"></center>
            <center><p><a href="{{ baseUrl('/') }}" class="button outline" style="margin-top:34px">{{ trans('errors.return_home') }}</a></p></center>
        </div>
    </div>
</div>

@stop
