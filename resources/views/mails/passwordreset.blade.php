<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Password Reset Code</title>
</head>
<body>
    <h1>Hello {{ $data['name'] }}</h1>
    <p>Here is your password recovery code.</p>
    <p><a href="{{ route('user.forgot.token', ['token' => $data['token']]) }}">Click Here</a> To Reset Your Password</p>
</body>
</html>