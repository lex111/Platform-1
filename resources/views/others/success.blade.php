@extends('simple-layout')

@section('content')

<div class="container">

    <p>&nbsp;</p>

    <div class="card" style="background-color:transparent;box-shadow:none">
        <div class="body">
            <center><img src="https://unpkg.com/docspen@15.0.0/imgs/success.svg" style="width:100%;height:13em;pointer-events:none"></center>
            <center><p><a href="{{ baseUrl('/') }}" class="button outline" style="margin-top:34px">{{ trans('errors.return_home') }}</a></p></center>
            <h2>Message Received</h2>
        </div>
    </div>

</div>

@stop
