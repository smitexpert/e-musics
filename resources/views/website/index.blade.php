@extends('website.layouts.master')
@section('contents')
	<!-- Hero section -->
	<section class="hero-section">
		<div class="hero-slider owl-carousel">
			@foreach (\App\Slider::get() as $item)
			<div class="hs-item">
				<div class="container">
					<div class="row">
						<div class="col-lg-6">
							<div class="hs-text">
								<h2>{{ $item->title }}</h2>
								<p>{{ $item->content }}</p>
								<a href="{{ route('user.register') }}" class="site-btn">{{ $item->button_text }}</a>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="hr-img">
								<img src="{{ url('') }}/uploads/sliders/{{ $item->image }}" alt="">
							</div>
						</div>
					</div>
				</div>
			</div>
			@endforeach
			
			{{-- <div class="hs-item">
				<div class="container">
					<div class="row">
						<div class="col-lg-6">
							<div class="hs-text">
								<h2><span>Listen </span> to new music.</h2>
								<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. </p>
								<a href="#" class="site-btn">Download Now</a>
								<a href="#" class="site-btn sb-c2">Start free trial</a>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="hr-img">
								<img src="{{ asset('website') }}/img/hero-bg.png" alt="">
							</div>
						</div>
					</div>
				</div>
			</div> --}}
		</div>
	</section>
	<!-- Hero section end -->

	<!-- Intro section -->
	<section class="intro-section spad">
		<div class="container">
			<div class="row">
				<div class="col-lg-6">
					<div class="section-title">
						@if(\App\ContentOne::first())
							<h2>{{ \App\ContentOne::first()->title }}</h2>
						@else
							<h2>Content One Title here</h2>
						@endif
					</div>
				</div>
				<div class="col-lg-6">
					@if(\App\ContentOne::first())
						<p>{{ \App\ContentOne::first()->content }}</p>
						<a href="{{ route('user.register') }}" class="site-btn">{{ \App\ContentOne::first()->button_text }}</a>
					@else
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum sus-pendisse ultrices gravida. Risus commodo viverra maecenas accumsan lacus vel facilisis. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida.</p>
						<a href="{{ route('user.register') }}" class="site-btn">Try it now</a>
					@endif
				</div>
			</div>
		</div>
	</section>
	<!-- Intro section end -->

	<!-- Subscription section -->
	<section class="subscription-section spad">
		<div class="container">
			<div class="row">
				@if(\App\ContentTwo::first())
					<div class="col-lg-6">
						<div class="sub-text">
							<h2>{{ \App\ContentTwo::first()->title }}</h2>
							<h3>{{ \App\ContentTwo::first()->sub_title }}</h3>
							<p>{{ \App\ContentTwo::first()->content }}</p>
							<a href="{{ route('user.register') }}" class="site-btn">{{ \App\ContentTwo::first()->button_text }}</a>
						</div>
					</div>
				@else
					<div class="col-lg-6">
						<div class="sub-text">
							<h2>Subscription from $15/month</h2>
							<h3>Start a free trial now</h3>
							<p>Consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Risus commodo viverra maecenas accumsan lacus vel facilisis. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
							<a href="{{ route('user.register') }}" class="site-btn">Try it now</a>
						</div>
					</div>
				@endif
			</div>
		</div>
	</section>
	<!-- Subscription section end -->
@endsection