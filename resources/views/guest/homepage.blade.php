@extends('layouts.guest.main')

@section('links')
    <link rel="stylesheet" href="{{ asset('css/homepageGuest.css') }}">
@endsection

@section('content')
    <div class="main_container" id="app">
        <div class="wrapper">
            <div class="left_main_box">
                <div class="logo_login">
                    <div class="logo">
                        <a href="{{ url('/') }}"><img src="{{ asset('images/logo/APPETIDO (1).png') }}" alt="" id="logo"></a>
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
                            @yield('cart')
                        </nav>
                    </div>
                </div>
                <div class="main_content">
                    <h1 class="mb-1">Frigorifero vuoto?</h1>
                    <p class="mb-4">Ci pensiamo noi!</p>
                    <h3 class="mb-4">Di cosa hai voglia oggi?</h3>
                    <div class="input_field">
                        <input type="search" v-model="type" @keyup.enter="restaurants()" placeholder="Cerca per Categoria">
                        <button  @click="restaurants()">Cerca</button>
                    </div>
                </div>
            </div>
            <div class="right_main_box"></div>
            
        </div>
        <div class="banner">
            <div class="banner_box">
                
            </div>
        </div>

        {{-- <div class="categories_container"> --}}
        
            {{-- <div class="wrapper_categories">
                <h2>Tutte le nostre categorie</h2>
                <div class="categories">
                    @foreach ($types as $type)
                        <div class="category" @click="filterOnType(`{{($type->name)}}`)">
                            <img src="{{asset($type->img_path)}}" alt="{{$type->name}}">
                            <div @click="filterOnType(`{{($type->name)}}`)" class="category_name">
                                <p>{{$type->name}}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div> --}}
        {{-- </div> --}}

        <div class="all_restaurants" v-if="filteredRestaurants.length > 0">
            <div class="restaurants_wrapper">
                <h2 v-if="filteredRestaurants.length > 1">@{{filteredRestaurants.length}} Ristoranti</h2>
                <h2 v-if="filteredRestaurants.length == 1">@{{filteredRestaurants.length}} Ristorante</h2>
                <div class="restaurants_container">
                    <div v-for="restaurant in filteredRestaurants" class="restaurant">
                        <form action="{{ route('guest.restaurant.show') }}" method="post">
                            @csrf
                            @method('POST')
                            <input name="business_name" type="hidden" :value="restaurant.business_name">
                            <div class="restaurant_image_box">
                                <img :src="`../storage/${restaurant.img_path}`" alt="">
                            </div>
                            <div class="restaurant_info">
                                <p class="businnes_name">@{{restaurant.business_name}}</p>
                                <ul>
                                   <li class="badge badge-secondary mx-1" v-for="type in restaurant.types">@{{type.name}}</li>
                                </ul>
                                <span><i class="fas fa-map-marker-alt"></i> @{{restaurant.address}}</span>
                            </div>
                            <button type="submit"></button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
        {{-- TUTTI I RISTORANTI --}}
        <div class="all_restaurants" v-if="firstSearch && filteredRestaurants.length == 0">
            <div class="restaurants_wrapper">
                <h2>Tutti i ristoranti</h2>
                <div class="restaurants_container">
                    <div v-for="restaurant in allRestaurants" class="restaurant">
                        <form action="{{ route('guest.restaurant.show') }}" method="post">
                            @csrf
                            @method('POST')
                            <input name="business_name" type="hidden" :value="restaurant.business_name">
                            <div class="restaurant_image_box">
                                <img :src="`../storage/${restaurant.img_path}`" alt="">
                            </div>
                            <div class="restaurant_info">
                                 <p class="businnes_name">@{{restaurant.business_name}}</p>
                                 <ul>
                                    <li class="badge badge-secondary mx-1" v-for="type in restaurant.types">@{{type.name}}</li>
                                </ul>
                                <span><i class="fas fa-map-marker-alt"></i> @{{restaurant.address}}</span>
                            </div>
                            <button type="submit"></button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
        {{-- TUTTI I RISTORANTI --}}
        <div class="all-restaurants" v-if="!firstSearch && filteredRestaurants.length == 0">
               Non sono stati trovati Ristoranti per questa categoria
        </div>
    </div>
     <!-- Slider main container -->
    <div class="swiper-container">
        <!-- Additional required wrapper -->
        <div class="swiper-wrapper">
            <!-- Slides -->
            @foreach ($types as $type)
            <div class="swiper-slide">
                <div class="layover">
                    <img src="{{asset($type->img_path)}}" alt="">
                </div>
                <p>{{$type->name}}</p>
            </div>
            @endforeach
        </div>
        <!-- If we need pagination -->
        <div class="swiper-pagination"></div>
    
        

        <!-- Swiper JS -->
        <script src="../package/swiper-bundle.min.js"></script> 

        <!-- If we need navigation buttons -->
        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>
    
    </div>

 @endsection

