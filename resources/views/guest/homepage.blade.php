@extends('layouts.guest.main')

@section('links')
    <link rel="stylesheet" href="{{ asset('css/homepageGuest.css') }}">
@endsection

@section('content')
    <div class="main_container">
        <div class="wrapper">
            <div class="left_main_box">
                <div class="logo_login">
                    <div class="logo">
                        <a href="{{ url('/') }}"><img src="{{ asset('images/logo/Deliverboo.png') }}" alt="" id="logo"></a>
                    </div>
                    <div class="login_box">
                        <nav class="main_nav">
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
                                            <a class="dropdown-item" href="{{ route('admin.deliverboo.index') }}">I miei Ristoranti</a>
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
                            @yield('cart')
                        </nav>
                    </div>
                </div>
                <div class="main_content">
                    <h3>Affamato?</h3>
                    <p>N°<span>1</span> Delivery in <span>Milan</span></p>
                    <h3>Di cosa hai voglia oggi?</h3>
                    <div class="input_field">
                        <input type="search" placeholder="Cerca per Categoria">
                        <button>Cerca</button>
                    </div>
                </div>
            </div>
            
        </div>
        <div class="right_main_box"></div>
        <div class="banner">
            <div class="wrapper">
    
            </div>
        </div>

        <div class="categories_container">
           <div class="wrapper_categories" id="app">
                <p>@{{ saluto }}</p>
                @foreach ($types as $type)
                    <div class="category">
                        <img src="{{asset($type->img_path)}}" alt="{{$type->name}}">
                    </div>
                @endforeach
           </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('js/app.js') }}"></script>
@endsection