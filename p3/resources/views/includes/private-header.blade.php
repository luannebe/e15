<div class="container">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="/"><img src='/img/logo-restore-mass-ave-horizontal.png' id='logo'
                    alt='RMA Logo'></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="/tracker">Reports</a>
                    </li>
                    <!-- Log in/log out -->
                    <li>
                        @if(!Auth::user())
                        <a class="nav-link" href='/login'>Login</a>
                        @else
                        <form method='POST' id='logout' action='/logout'>
                            {{ csrf_field() }}
                            <a class="nav-link" href='#' onClick='document.getElementById("logout").submit();'>Logout</a>
                        </form>
                        @endif
                    </li>
                </ul>
            </div>
        </div>
</nav>
</div>