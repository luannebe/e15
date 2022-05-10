<!doctype html>
<html lang='en'>
<head>
    <title>@yield('title', 'P3')</title>
    <meta charset='utf-8'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href='{{asset('css/app.css')}}'>
    <link href='/css/p3.css' type='text/css' rel='stylesheet'>
    @yield('head')
</head>
<body class="{{ !empty($body_class) ? $body_class : '' }}">
    @if(session('flash-alert'))
    <div class='flash-alert'>
        {{ session('flash-alert')}}
    </div>
    @endif
    <header>@yield('header')</header>

    @yield('content')

    <footer class="container">
        <hr>
        <p>L. Ebert May, 2022</p>
    </footer>
    <script src="{{asset('js/app.js')}}"></script>
</body>
</html>