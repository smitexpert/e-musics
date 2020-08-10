<!DOCTYPE html>
<html lang="en">
<head>
	<title>Recover Password</title>
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
				<form method="POST" action="{{ route('user.password', ['token' => $token]) }}" class="login100-form validate-form flex-sb flex-w">
					@csrf
					<span class="login100-form-title p-b-32">
						Change Password
					</span>
					
					<div class="width" style="width: 100%">
                        @foreach ($errors->all() as $message)
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                        @endforeach
                    </div>

					<span class="txt1 p-b-11">
						New Password
					</span>
					<div class="wrap-input100 validate-input m-b-12" data-validate = "Password is required">
						<span class="btn-show-pass">
							<i class="fa fa-eye"></i>
						</span>
						<input class="input100" type="password" name="password" >
						<span class="focus-input100"></span>
					</div>
					
					<span class="txt1 p-b-11">
						Repeat Password
					</span>
					<div class="wrap-input100 validate-input m-b-12" data-validate = "Repeat Password is required">
						<span class="btn-show-pass">
							<i class="fa fa-eye"></i>
						</span>
						<input class="input100" type="password" name="password_confirmation" >
						<span class="focus-input100"></span>
					</div>
					
					<div class="container-login100-form-btn" style="justify-content: space-between">
						<button class="login100-form-btn">
							Change Password
						</button>
					</div>

				</form>
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