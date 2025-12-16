<!DOCTYPE html>
<html>
<head>
    <title>Password Reset OTP</title>
</head>
<body>
    <p>Hello {{ $name }},</p>
    <p>Your OTP for password reset is: <strong>{{ $otp }}</strong></p>
    <p>This OTP is valid for 5 minutes.</p>
    <p>If you did not request a password reset, please ignore this email.</p>
</body>
</html>
