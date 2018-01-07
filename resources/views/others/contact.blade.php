@extends('simple-layout')

@section('content')


<section class="hero isrc="main.js">s-default is-bold">
	<div class="hero-body">
		<div class="container">
			<div class="columns is-vcentered">
				<div id="main" class="column is-half is-centered has-nice-link">
					<h1 class="title is-2">Feedback<span></span></h1>
					<h2 class="title is-4">I appreciate your feedback 🌈</h2>
					<form accept-charset="UTF-8" action="https://usebasin.com/f/1d7f387e41bb" enctype="multipart/form-data" method="POST">
						<label class="label">Name</label>
						<p class="control">
							<input class="input" type="text" name="name">
						</p>
						<label class="label">Email*</label>
						<p class="control">
							<input class="input" type="email" name="email" id="email" required>
						</p>
						<label class="label">Message*</label>
						<p class="control">
							<textarea class="textarea" placeholder="I'm a human. Please be nice." name="message" minlength="5" required autofocus></textarea>
						</p>
						<div class="control is-grouped">
							<p class="control">
								<button class="button is-primary is-large" type="submit">Send Feedback</button>
							</p>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>

@stop