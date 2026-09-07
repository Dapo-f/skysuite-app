<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SkySuite Account Verification</title>
</head>
<body>
    <h1>Account Verification</h1>
    <h3>Dear {{ $user->firstname }} {{ $user->lastname }}</h3>
    <p>Thank your for registering with us. Please click the link below to verify your account:</p>
    <a href="{{ $url }}">Verify Account</a>
    <p>This link will expire in 10 minutes</p>
    <p>You can use this code: <span>{{ $token }}</span></p>
    <p>or copy paste the following link into your browser</p>
    <p>{{ $url }}</p>
    <p>If you did not create an account, no further action is required</p>
    <h6>Best regard, <br> SkySuite Hotels</h6>
</body>
</html>