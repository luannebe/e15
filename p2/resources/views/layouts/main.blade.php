<!doctype html>
<html lang='en'>
<head>
    <title>@yield('title', 'Flip-A-Coin - Making Decisions Easy')</title>
    <meta charset='utf-8'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href=data:, rel=icon>
    <link href='{{'css/app.css'}}' type='text/css' rel='stylesheet'>
    @yield('head')
</head>
<body class="prose prose-gray bg-blue-200 max-w-none">
    <!-- content wrapper -->
    <div class="p-8 container grid grid-cols-1 xl:grid-cols-2 gap-4">
        <section>
            @yield('header')
            @yield('form')
        </section>
        <section class="self-center">
            @yield('results')
        </section>

    </div>
</body>
</html>