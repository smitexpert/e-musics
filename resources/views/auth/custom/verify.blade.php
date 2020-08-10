<!DOCTYPE html>
<html lang="en">
<head>
	<title>User Account Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	{{-- <link rel="icon" type="image/png" href="images/icons/favicon.ico"/> --}}
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('auth_files') }}/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('auth_files') }}/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('auth_files') }}/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('auth_files') }}/vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="{{ asset('auth_files') }}/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('auth_files') }}/vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('auth_files') }}/vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="{{ asset('auth_files') }}/vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('auth_files') }}/css/util.css">
	<link rel="stylesheet" type="text/css" href="{{ asset('auth_files') }}/css/main.css">
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100 p-l-85 p-r-85 p-t-55 p-b-55">
				<span class="login100-form-title p-b-32">
                    @if (Session::has('error'))
                        {{ Session::get('error') }}
                    @elseif(Session::has('success'))
                        {{ Session::get('success') }}
                        <br>
                        <a href="{{ route('user.login') }}">Login Now</a>
                    @else
                        A verification token was sent to your email.
                        <br>
                        <a href="#" onclick="event.preventDefault(); document.getElementById('resend').submit();">Resend Token</a>
                        <form action="{{ route('user.verify.resend', ['id' => $id->id]) }}" id="resend" method="POST">
                            @csrf
                        </form>
                    @endif

                    
                </span>
			</div>
		</div>
	</div>
	

	<div id="dropDownSelect1"></div>
	
<!--===============================================================================================-->
	<script src="{{ asset('auth_files') }}/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="{{ asset('auth_files') }}/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="{{ asset('auth_files') }}/vendor/bootstrap/js/popper.js"></script>
	<script src="{{ asset('auth_files') }}/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="{{ asset('auth_files') }}/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="{{ asset('auth_files') }}/vendor/daterangepicker/moment.min.js"></script>
	<script src="{{ asset('auth_files') }}/vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="{{ asset('auth_files') }}/vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="{{ asset('auth_files') }}/js/main.js"></script>

</body>
</html>