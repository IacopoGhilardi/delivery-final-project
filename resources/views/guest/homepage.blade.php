@extends('layouts.guest.main')

@section('links')
    <link rel="stylesheet" href="{{ asset('css/homepageGuest.css') }}">
@endsection

@section('content')
<section id="app">
    <div class="main_container">
        <div class="wrapper">
            <div class="jumbotron_content">
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

                <a href="{{ url('/') }}"><img src="{{ asset('images/logo/deliveboorichi.png') }}" alt="" id="logo"></a>
                <h1>FRIGORIFERO VUOTO? CI PENSIAMO NOI!</h1>
                <div class="register_btn_box">
                    <nav class="main_nav">
                        <div class="nav_links">
                            <ul class="inline_list">
                                @guest
                                <li class="nav-item">
                                    <a class="nav-link login" href="{{ route('login') }}">{{ __('Accedi') }}</a>
                                </li>
                                @if (Route::has('register'))
                                    <li class="nav-item">
                                        <a class="nav-link btn_gold register" href="{{ route('register') }}">{{ __('Registrati') }}</a>
                                    </li>
                                @endif
                                @else
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle logged_name" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
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
                    </nav>
                </div>
                <div class="image_container_small">
                    <h2>Di cosa hai voglia oggi?</h2>
                    <div class="input_container">
                        <p>Inserisci una categoria per trovare i piatti che preferisci</p>
                        <div class="input_field">
                            <input class="category_search" type="search" v-model="type" @keyup.enter="restaurants()" placeholder="Cerca per Categoria">
                            <button @click="restaurants()">Cerca</button>
                        </div>
                    </div>
                </div>
        </div>
            <div class="custom-shape-divider-bottom-1616418170">
                <div class="image_container">
                    <h2>Di cosa hai voglia oggi?</h2>
                    <div class="input_container">
                        <p>Inserisci una categoria per trovare i piatti che preferisci</p>
                        <div class="input_field">
                            <input class="category_search" type="search" v-model="type" @keyup.enter="restaurants()" placeholder="Cerca per Categoria">
                            <button @click="restaurants()">Cerca</button>
                        </div>
                    </div>
                </div>
                <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
                    <path d="M985.66,92.83C906.67,72,823.78,31,743.84,14.19c-82.26-17.34-168.06-16.33-250.45.39-57.84,11.73-114,31.07-172,41.86A600.21,600.21,0,0,1,0,27.35V120H1200V95.8C1132.19,118.92,1055.71,111.31,985.66,92.83Z" class="shape-fill"></path>
                </svg>
            </div>
        </div>
    </div>
    <div class="categories">
        <h2>LE CATEGORIE PIU' AMATE</h2>
        <div class="categories_box">
           @foreach ($types as $type)
           <div class="category" @click="filterOnType(`{{($type->name)}}`)">
                <div class="category_name">
                    <p>{{$type->name}}</p>
                </div>
                <img src="{{asset($type->img_path)}}" alt="{{$type->name}}">
            </div>
           @endforeach
        </div>
    </div>

            <div v-cloak class="all_restaurants" v-if="filteredRestaurants.length > 0">
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
        </div>
        {{-- TUTTI I RISTORANTI --}}
        <div v-cloak class="all_restaurants" v-if="firstSearch && filteredRestaurants.length == 0">
            <div class="restaurants_wrapper">
                <h2>Tutti i Ristoranti</h2>
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
            {{-- TUTTI I RISTORANTI --}}
            <div class="all-restaurants" v-if="!firstSearch && filteredRestaurants.length == 0">
                   Non sono stati trovati Ristoranti per questa categoria
            </div>
        </div>
    
 
 @endsection

 @section('scripts')
    <script src="{{ asset('js/burger.js') }}"></script>
 @endsection
