<!doctype html>
<html lang='en'>
<head>
    <title>@yield('title', 'Bookmark')</title>
    <meta charset='utf-8'>
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link href='/css/bookmark.css' type='text/css' rel='stylesheet'>
    @yield('head')
</head>
<body>
    @if(session('flash-alert'))
    <div class='flash-alert'>
        {{ session('flash-alert')}}
    </div>
    @endif
    <header>
        <a href='/'><img src='/images/bookmark-logo@2x.png' id='logo' alt='Bookmark Logo'></a>
        <nav>
            <ul>
                <li><a href='/'>Home</a></li>

                @if(Auth::user())
                <li><a href='/books'>All Books</a></li>
                <li><a href='/books/create'>Add a Book</a></li>
                <li><a href='/list'>Your list</a></li>
                <li><a href='/authors/create'>Add an Author</a></li>
                @endif

                <li><a href='/contact'>Contact</a></li>
                
                <li>
                    @if(!Auth::user())
                    <a href='/login'>Login</a>
                    @else
                    <form method='POST' id='logout' action='/logout'>
                        {{ csrf_field() }}
                        <a href='#' onClick='document.getElementById("logout").submit();'>Logout</a>
                    </form>
                    @endif
                </li>
            </ul>
        </nav>
    </header>

    <section  id='main'>
            @yield('content')
    </section>

    <footer>
        &copy; Bookmark, Inc.
    </footer>

</body>
</html>