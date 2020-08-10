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
	<script src="https://www.paypal.com/sdk/js?client-id={{ $client_id }}"> // Replace YOUR_SB_CLIENT_ID with your sandbox client ID
	</script>

	<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
	
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
					<h3>Your membership will begin as soon as you pay the fees</h3>
					<br>
					<div class="card text-white bg-primary mb-3" style="max-width: 18rem; margin: 0 auto;">
						<div class="card-body">
						  <h5 class="card-title">${{ $amount }}</h5>
						  <p class="card-text">Life Time Membership</p>
						</div>
					</div>
				</div>
			</div>
			<div class="col-sm-6 offset-sm-3">
				
				<div id="paypal-button-container"></div>
			</div>
		</div>
	</div>

	
	<!-- Add the checkout buttons, set up the order and approve the order -->
    <script>
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		paypal.Buttons({
		  style: {
			shape: 'pill',
			color: 'gold',
			label: 'pay',
			
		},
		  createOrder: function(data, actions) {
			return actions.order.create({
			  purchase_units: [{
				amount: {
				  value: '{{ $amount }}'
				}
			  }],
            application_context: {
              shipping_preference: 'NO_SHIPPING'
            }
			});
		  },
		  onApprove: function(data, actions) {
			return actions.order.capture().then(function(details) {
				console.log(details)
				
				$.ajax({
					url: "{{ route('user.payment.exe') }}",
					method: 'POST',
					data: {
						transection_id: details.id,
						status: details.status,
						amount: {{ $amount }}
					},
					success: function(data)
					{
						if(data == 'success')
						{
							location.reload();
						}else{
							alert('Payment Not Successed!');
						}
					}
				})
			  // alert('Transaction completed by ' + details.payer.name.given_name);
			});
		  }
		}).render('#paypal-button-container'); // Display payment options on your web page
	  </script>
</body>
</html>