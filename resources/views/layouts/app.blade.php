<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-lg navbar-toggleable-md navbar-light bg-faded mb-2">

            <!-- hamburger button -->
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- brand -->
            <a class="navbar-brand align-middle" href="/">
                <img src="{{ asset("/images/acme-labs-logo.png") }}" height="80" class="d-inline-block align-top" alt="Acme Labs Logo">
                {{ config('app.name', 'Laravel') }}
            </a>

            <!-- links -->
            <div class="collapse navbar-collapse justify-content-lg-end" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    @if(Auth::user())
                      <li class="nav-item">
                        <a class="nav-link @if (request()->is('dashboard*')) active @endif" href="{{ route('dashboard') }}">Dashboard <span class="sr-only">(current)</span></a>
                      </li>
                      @if(auth()->user()->isAllowedTo('create_user'))
                      <li class="nav-item">
                        <a class="nav-link @if (request()->is('manage/user*')) active @endif" href="{{ action('UserController@index') }}">Manage Users</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link @if (request()->is('manage/options*')) active @endif" href="{{ action('OptionsController@index') }}">Manage Options</a>
                      </li>
                      @endif
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            @if(Auth::user()) {{ auth()->user()->readableName() }} @else Account @endif
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                               document.getElementById('logout-form').submit();">
                                Log Out</a>
                        </div>
                    </li>
                    @endif

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </ul>
            </div>
        </nav>

        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}"></script>

</body>
</html>
