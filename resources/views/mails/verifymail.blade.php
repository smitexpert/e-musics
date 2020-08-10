<!DOCTYPE html>
<html lang="en">
<head>
    <title>Welcome</title>
</head>
<body>
    <h1>Hello {{ $user['name'] }}</h1>
    <p>Your have register your account successfully</p>
    <p>Please active your account</p>
    <a href="{{ route('user.verify.token', ['token' => $user['token']]) }}">Active Now</a>
</body>
</html>