<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link rel="stylesheet" href="{{ asset('css/paymentLayout.css') }}">
    @yield('links')
    <title>Document</title>
</head>
<body>
    
    <header>
        <div class="container wrapper">
            <div class="navbar">
                <div class="logo">
                    <img src="{{ asset('images/logo/logo-black.png') }}" alt="logo deliveboo">
                </div>
                    <div class="nav_links">
                        <ul class="inline_list">
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
        @yield('footer')
    </footer>

    @yield('scripts')
</body>
</html>