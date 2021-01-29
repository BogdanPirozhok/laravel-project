<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=yes" />

    <title>Delsy | Admin</title>

    <link href="{{ asset('library/icons/favicon.ico') }}" rel="icon"/>
    <link href="{{ asset('library/icons/16x16.png') }}" rel="icon" type="image/png" sizes="16x16">
    <link href="{{ asset('library/icons/32x32.png') }}" rel="icon" type="image/png" sizes="32x32">
    <link href="{{ asset('library/icons/48x48.png') }}" rel="icon" type="image/png" sizes="48x48">
    <link rel="manifest" href="{{ asset('manifest.json') }}">

    <link rel="stylesheet" href="{{ asset('library/css/signin.css') }}" />
    <link rel="stylesheet" href="{{ asset('library/css/notify.css') }}" />

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans" />
</head>

<body>
<div class="cont" id="login">
    <div class="demo">
        <div class="login">
            <div class="login__check"></div>
            <div class="login__form">
                <login-form token="{{ csrf_token() }}" path="{{ route('login') }}"></login-form>
            </div>
        </div>
    </div>
    <div class="error-container"></div>
</div>

<script src="//ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="{{ asset('library/js/notify.js') }}"></script>
<script src="{{ asset('assets/js/login.js') }}"></script>
</body>
</html>
