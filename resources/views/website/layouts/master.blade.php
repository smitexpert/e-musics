
<!DOCTYPE html>
<html lang="zxx">
<head>
	@if (\App\SiteSetting::where('name', 'title')->first())		
		<title>{{ \App\SiteSetting::where('name', 'title')->first()->value }}</title>
	@else
		<title>SolMusic | HTML Template</title>
	@endif
	<meta charset="UTF-8">
	<meta name="description" content="SolMusic HTML Template">
	<meta name="keywords" content="music, html">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<!-- Favicon -->
	<link href="{{ asset('website') }}/img/favicon.ico" rel="shortcut icon"/>

	<!-- Google font -->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i&display=swap" rel="stylesheet">
 
	<!-- Stylesheets -->
	<link rel="stylesheet" href="{{ asset('website') }}/css/bootstrap.min.css"/>
	<link rel="stylesheet" href="{{ asset('website') }}/css/font-awesome.min.css"/>
	<link rel="stylesheet" href="{{ asset('website') }}/css/owl.carousel.min.css"/>
	<link rel="stylesheet" href="{{ asset('website') }}/css/slicknav.min.css"/>

	<!-- Main Stylesheets -->
	<link rel="stylesheet" href="{{ asset('website') }}/css/style.css"/>


	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

</head>
<body>
	<!-- Page Preloder -->
	<div id="preloder">
		<div class="loader"></div>
	</div>
		<!-- Header section -->
		<header class="header-section clearfix">
			<a href="/" class="site-logo">
				@if (\App\SiteSetting::where('name', 'logo')->first())
					<img src="{{ asset('uploads/logo') }}/{{ \App\SiteSetting::where('name', 'logo')->first()->value }}" alt="">
				@else
					<img src="{{ asset('website') }}/img/logo.png" alt="">
				@endif
			</a>
			<div class="header-right">
				<div class="user-panel">
					@if (Auth::user())
						@if (Auth::user()->type == 'admin')
							<a href="{{ route('dashboard') }}" class="register">Dashboard</a>
						@else
							<a href="{{ route('account') }}" class="login">Accounts</a>
							<a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout').submit()" class="register">Logout</a>
							<form action="{{ route('logout') }}" method="POST" id="logout">
								@csrf
							</form>
						@endif
					@else
						<a href="{{ route('user.login') }}" class="login">Login</a>
						<a href="{{ route('user.register') }}" class="register">Create an account</a>
					@endif
				</div> 
			</div>
			<ul class="main-menu">
				<li><a href="{{ route('browse') }}">Browse Music</a></li>
				<li><a href="{{ route('album') }}">Albums</a></li>
				<li><a href="{{ route('genre') }}">Genres</a></li>
				<li><a href="{{ route('artist') }}">Artists</a></li>
			</ul>
		</header>
		<!-- Header section end -->

	@yield('contents')

	<!-- Footer section -->
	<footer class="footer-section">
		<div class="container">
			<div class="row">
				<div class="col-xl-6 col-lg-7 order-lg-2">
					<div class="row">
						<div class="col-sm-4">
							{{-- <div class="footer-widget">
								<h2>About us</h2>
								<ul>
									<li><a href="">Our Story</a></li>
									<li><a href="">Sol Music Blog</a></li>
									<li><a href="">History</a></li>
								</ul>
							</div> --}}
						</div>
						<div class="col-sm-4">
							{{-- <div class="footer-widget">
								<h2>Products</h2>
								<ul>
									<li><a href="">Music</a></li>
									<li><a href="">Subscription</a></li>
									<li><a href="">Custom Music</a></li>
									<li><a href="">Footage</a></li>
								</ul>
							</div> --}}
						</div>
						<div class="col-sm-4">
							<div class="footer-widget">
								<h2>Links</h2>
								<ul>
									<li><a href="{{ route('browse') }}">Browse Musics</a></li>
									<li><a href="{{ route('album') }}">Albums</a></li>
									<li><a href="{{ route('genre') }}">Genres</a></li>
									<li><a href="{{ route('contact') }}">Contact</a></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-6 col-lg-5 order-lg-1">
					@if (\App\SiteSetting::where('name', 'logo')->first())
						<img src="{{ asset('uploads/logo') }}/{{ \App\SiteSetting::where('name', 'logo')->first()->value }}" alt="">
					@else
						<img src="{{ asset('website') }}/img/logo.png" alt="">
					@endif
					<div class="copyright">
						@if (\App\SiteSetting::where('name', 'copyright')->first())
							{!! \App\SiteSetting::where('name', 'copyright')->first()->value !!}
						@else
							Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved
						@endif
					</div>
					
				</div>
			</div>
		</div>
	</footer>

<!-- Footer section end -->
	
	<!--====== Javascripts & Jquery ======-->
	<script src="{{ asset('website') }}/js/jquery-3.2.1.min.js"></script>
	<script src="{{ asset('website') }}/js/bootstrap.min.js"></script>
	<script src="{{ asset('website') }}/js/jquery.slicknav.min.js"></script>
	<script src="{{ asset('website') }}/js/owl.carousel.min.js"></script>
	<script src="{{ asset('website') }}/js/mixitup.min.js"></script>
	<script src="{{ asset('website') }}/js/main.js"></script>

	<!-- Audio Players js -->
	<script src="{{ asset('website') }}/js/jquery.jplayer.min.js"></script>
	<script src="{{ asset('website') }}/js/wavesurfer.min.js"></script>

	<!-- Audio Players Initialization -->
	<script src="{{ asset('website') }}/js/WaveSurferInit.js"></script>
	<script src="{{ asset('website') }}/js/jplayerInit.js"></script>

	</body>
</html>
