<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="WebApp.al" name="description"/>
    <meta content="WebApp.al" name="author"/>

    <title>WebApp.al</title>

    <link href="{{ URL::asset('css/libs.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ URL::asset('css/app.css') }}" rel="stylesheet" type="text/css"/>

</head>

<body class="gray-bg">

<div class="middle-box text-center loginscreen animated fadeInDown">

    {{--THE CONTENT OF BODY--}}
    @yield('content')

</div>

<!-- BEGIN CORE PLUGINS -->
<script src="{{ URL::asset('js/libs.js') }}" type="text/javascript"></script>
<!-- END CORE PLUGINS -->

</body>

</html>
