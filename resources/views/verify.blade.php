<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <!-- resources/views/emails/verify.blade.php -->

<h1>Email Verification</h1>

<p>Hello, {{ $user->name }}!</p>

<p>Please click the following link to verify your email address:</p>

<a href="{{ route('verify', ['token' => $verificationToken]) }}">Verify Email</a>

<p>If you didn't request this verification, you can ignore this email.</p>

</body>
</html>