@extends('simple-layout')

@section('content')
<div ng-non-bindable class="container small">
    <p>&nbsp;</p>
    <center>
        <a href="/"> <img class="auth-logo" class="logo-image" src="https://unpkg.com/docspen@1.0.0/imgs/logo-small.png" alt="Logo"></a>
        <h3>Contact Us</h3>
    </center>
    <div class="card auth-border center-box">
        <div class="body">
            <form accept-charset="UTF-8" action="https://usebasin.com/f/24e26908c642" enctype="multipart/form-data" method="POST">
                <div class="form-group">
                    <label for="email">Name</label>
                    <input class="input" type="text" name="name">
                </div>

                <div class="form-group">
                    <label for="email">E-Mail</label>
                    <input class="input" type="email" name="email" id="email" required>
                </div>

                <div class="form-group">
                    <label for="password">Message</label>
                    <textarea class="textarea" placeholder="I'm a human. Please be nice." name="message" minlength="5" required autofocus></textarea>
                </div>

                <div class="from-group">
                    <button class="button block pos" type="submit"><i class="zmdi zmdi-plus"></i>Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
@stop
