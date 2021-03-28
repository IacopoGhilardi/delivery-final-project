<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="{{ asset('images/logo/deliveboo-resp-black.png') }}">
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/paymentLayout.css') }}">
    @yield('links')
    <title>DeliveBoo</title>
</head>
<body>
    
    <header>
        <div class="container wrapper">
            <div class="navbar">
                <div class="logo">
                    <a class="first_logo" href="{{ url('/') }}"><img src="{{ asset('images/logo/logo-black.png') }}" alt=""></a>
                    <a class="resp_logo" href="{{ url('/') }}"><img src="{{ asset('images/logo/deliveboo-resp-black.png') }}" alt=""></a>
                </div>
                <div id="burger_icon">
                    <div id="rotate-1"></div>
                    <div id="rotate-2"></div>
                    <div id="rotate-3"></div>
                </div>
                <div class="nav_menu_small">
                    @guest
                    <div class="links">
                        <a href="{{ route('login') }}">{{ __('Login') }}</a>
                        <a href="{{ route('register') }}">{{ __('Sign up') }}</a>
                    </div>
                    @else
                    <div class="links">
                        <h2>{{ Auth::user()->firstName }}</h2>
                        <a href="{{ route('admin.restaurant.index') }}">I miei Ristoranti</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST">
                            @csrf
                            <input type="submit" value="Logout">
                        </form>
                    </div>
                    @endguest
                </div>
                    <div class="nav_links">
                        <ul class="inline_list d-flex">
                            @guest
                            <li class="nav-item">
                                <a class="nav-link login" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link btn_gold" href="{{ route('register') }}">{{ __('Sign up') }}</a>
                                </li>
                            @endif
                            @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->firstName }}
                                </a>
            
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('admin.restaurant.index') }}">I miei Ristoranti</a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
            
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                            @endguest
                        </ul>
                    </div>
            </div>
        </div>
    </header>

    <main>
        <div class="banner_head"></div>
        @yield('content')
    </main>

    <footer>
        @include('layouts.guest.footer')
    </footer>

    @yield('scripts')
    <script src="{{ asset('js/burger.js') }}"></script>
</body>
</html>