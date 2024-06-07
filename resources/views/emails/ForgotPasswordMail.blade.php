<!DOCTYPE html>
<html>
<head>
    <title>Forgot Password</title>
</head>
<body>
    <h1>Hello, {{ $user->name }}</h1>
    <p>You have requested to reset your password. Click the link below to reset it:</p>
    <a href="{{ $url }}">Reset Password</a>
</body>
</html>
