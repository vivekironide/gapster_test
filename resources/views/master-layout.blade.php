<!DOCTYPE html>
<html lang="en">
<head>
    <title>@yield('title', ' PickMe Corporate Solution')</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=0">
    <meta name="format-detection" content="telephone=no">
	<meta name="csrf-token" content="{{csrf_token()}}">

    <link rel="icon" href="{{ asset('images/favicon.png') }}" type="image/x-icon">

    <link rel="stylesheet" href="{{asset('css/app.css')}}">


</head>

<body>
	<div id="app">
        @yield('content')
    </div>

    <script src="{{asset('js/app.js')}}"></script>
</body>
</html>


