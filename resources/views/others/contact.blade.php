@extends('simple-layout')

@section('content')
   <div class="text-center">
        <div class="card auth-border center-box">
            <div class="container small">
                
                <form accept-charset="UTF-8" action="https://usebasin.com/f/1d7f387e41bb" enctype="multipart/form-data" method="POST">
    
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