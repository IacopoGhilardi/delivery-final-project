@extends('layouts.guest.main')

@section('links')
    <link rel="stylesheet" href="{{ asset('css/guestRestaurant.css') }}">
@endsection

@section('header')
   <div class="show_header">
       <div class="wrapper">
           <div class="header_container">
                <div class="logo">
                    <a href="{{ url('/') }}"><img src="{{ asset('images/logo/Deliverboo.png') }}" alt="" id="logo"></a>
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
                            <li class="cart"><i class="fas fa-shopping-cart"></i></li>
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
   </div>
@endsection

@section('content')
   <div class="restaurant_banner">
        <div class="wrapper">
            <div class="restaurant_info">
                <h2>{{ $restaurant->business_name }}</h2>
                <p>{{ $restaurant->address }}</p>
                <div class="tags">
                    @foreach ($restaurant->types as $type)
                        <span class="badge badge-secondary">{{ $type->name }}</span>
                    @endforeach
                </div>
                <div class="order">
                    <span><strong>Consegna gratuita</strong></span>
                    <span><strong>5&euro;</strong> ordine minimo</span>
                </div>
            </div>
        </div>
        <div class="restaurant_image">
            @if ($restaurant->img_path != null)
                <img src="{{ asset('storage/'. $restaurant->img_path) }}" alt="immagine">
            @else
                <img src="{{ asset('images/restaurantDefault.png') }}" alt="">
            @endif
        </div>
   </div>

   <div class="restaurant_menu">
       <div class="wrapper">
            <h1>Seleziona i piatti che preferisci</h1>
            @foreach ($restaurant->dishes as $dish)
                <div class="dish">
                    <p>{{ $dish->name }}</p>
                </div>
            @endforeach

       </div>
   </div>

@endsection
