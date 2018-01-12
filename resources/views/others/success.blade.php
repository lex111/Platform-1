@extends('simple-layout')

@section('content')

<div class="container">

    <p>&nbsp;</p>

    <div class="card" style="background-color:transparent;box-shadow:none">
        <div class="body">
            <center>
                <img src="hhttps://cdnjs.cloudflare.com/ajax/libs/twemoji/2.1.5/2/svg/2714.svg" style="width:100%;height:13em;pointer-events:none">
                <h2>Message Received</h2>
                <p><a href="{{ baseUrl('/') }}" class="button outline" style="margin-top:34px">{{ trans('errors.return_home') }}</a></p>
            </center>
        </div>
    </div>

</div>

@stop
