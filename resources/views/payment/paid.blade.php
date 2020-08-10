<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Pay Subscription Fees</title>
	<link rel="stylesheet" href="{{ asset('') }}website/css/bootstrap.min.css">

	<style>
		.logo {
			width: 180px;
			height: auto;
		}

		.logo img {
			width: 100%;
			height: auto;
		}

		.gap {
			margin: 20px 0
		}
	</style>
</head>
<body>
	
	<div class="container">
		<div class="row gap">
			<div class="col-6">
				<div class="logo">
					@if (\App\SiteSetting::where('name', 'logo')->first())
						<img src="{{ asset('uploads/logo') }}/{{ \App\SiteSetting::where('name', 'logo')->first()->value }}" alt="">
					@else
						<img src="{{ asset('website') }}/img/logo.png" alt="">
					@endif
				</div>
			</div>
			<div class="col-6">
				<div class="text-right">
					<a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout').submit()" class="register">Logout</a>
					<form action="{{ route('logout') }}" method="POST" id="logout">
						@csrf
					</form>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-6 offset-sm-3">
				<div class="text-center">
					<h3>Your membership is actived</h3>
					<br>
					<div class="card text-white bg-success mb-3" style="max-width: 18rem; margin: 0 auto;">
						<div class="card-body">
						  <h5 class="card-title">${{ $amount }}</h5>
                          <p class="card-text">Life Time Membership</p>
                          <p><a class="btn btn-dark" href="{{ url('/') }}">Start Listening</a></p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>