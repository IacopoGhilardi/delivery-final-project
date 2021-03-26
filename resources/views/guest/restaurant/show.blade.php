@extends('layouts.guest.show')

@section('links')
    <link rel="stylesheet" href="{{ asset('css/guestRestaurant.css') }}">
@endsection

@section('header')
   <div class="show_header">
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
       <div class="wrapper">
           <div class="header_container">
                <div class="logo">
                    <a class="first-logo" href="{{ url('/') }}"><img src="{{ asset('images/logo/logo-black.png') }}" alt="" id="logo"></a>
                    <a class="resp-logo" href="{{ url('/') }}"><img src="{{ asset('images/logo/deliveboo-resp-black.png') }}" alt="" id="logo"></a>
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
                            <li class="cart" v-for="price in findMyOrders(`{{$restaurant->id}}`).finalPrice">
                                <div class="cart_icon">
                                    @{{price}}&euro; <i class="fas fa-shopping-cart cartIcon"></i>
                                </div>
                                <div class="cart_header">
                                    <form action="{{ route('guest.order.payment') }}" class="cart_content" method="get">
                                        @csrf
                                        @method('GET')
                                        <div class="total">
                                            <h5>Totale ordine:</h5>
                                            <p v-for="price in findMyOrders(`{{$restaurant->id}}`).finalPrice"> @{{price}}&euro;</p>
                                        </div>
                                       
                                        <button v-if="findMyOrders(`{{$restaurant->id}}`).finalPrice[0] == 0" disabled type="submit" class="order_btn order_btn_disabled">Seleziona un piatto</button>
                                        <button v-if="findMyOrders(`{{$restaurant->id}}`).finalPrice[0] != 0" type="submit" class="order_btn">Effettua l'ordine</button>
                                        <div class="cart_info" v-for="order in findMyOrders(`{{$restaurant->id}}`).filteredOrders">
                                            <div class="buttons">
                                                <button type="button" class="cartButtons" @click="(removeOrder(order.name))"><i class="fas fa-minus"></i></button>
                                                <button type="button" class="cartButtons" @click="(addOrder(order.name, order.basePrice, `{{$restaurant->id}}`, order.dishId))"><i class="fas fa-plus"></i></button>
                                            </div>
                                            <div class="recap_products">
                                                <p><span>@{{order.count}} x</span> @{{order.name}}</p>
                                                <p>@{{Math.round(order.basePrice * order.count * 100) / 100}}&euro;</p>
                                            </div>
                                            <input type="hidden" name="dishes[]" :value="order.dishId">
                                            <input type="hidden" name="orders[]" :value="order.name">
                                            <input type="hidden" name="numberOfDishes[]" :value="order.count">
                                            <input type="hidden" name="dishPrices[]" :value="Math.round(order.basePrice * order.count * 100) / 100">
                                            <input type="hidden" name="finalPrice" :value="findMyOrders(`{{$restaurant->id}}`).finalPrice">
                                            <input type="hidden" name="business_name" value="{{$restaurant->business_name}}">
                                        </div>
                                    </form>
                                </div>
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
                        <li class="cart" v-for="price in findMyOrders(`{{$restaurant->id}}`).finalPrice">
                            <div class="cart_icon">
                                @{{price}}&euro; <i class="fas fa-shopping-cart cartIcon"></i>
                            </div>
                            <div class="cart_header">
                                <form action="{{ route('guest.order.payment') }}" class="cart_content" method="get">
                                    @csrf
                                    @method('GET')
                                    <div class="total">
                                        <h5>Totale ordine:</h5>
                                        <p v-for="price in findMyOrders(`{{$restaurant->id}}`).finalPrice"> @{{price}}&euro;</p>
                                    </div>
                                   
                                    <button v-if="findMyOrders(`{{$restaurant->id}}`).finalPrice[0] == 0" disabled type="submit" class="order_btn order_btn_disabled">Seleziona un piatto</button>
                                    <button v-if="findMyOrders(`{{$restaurant->id}}`).finalPrice[0] != 0" type="submit" class="order_btn">Effettua l'ordine</button>
                                    <div class="cart_info" v-for="order in findMyOrders(`{{$restaurant->id}}`).filteredOrders">
                                        <div class="buttons">
                                            <button type="button" class="cartButtons" @click="(removeOrder(order.name))"><i class="fas fa-minus"></i></button>
                                            <button type="button" class="cartButtons" @click="(addOrder(order.name, order.basePrice, `{{$restaurant->id}}`, order.dishId))"><i class="fas fa-plus"></i></button>
                                        </div>
                                        <div class="recap_products">
                                            <p><span>@{{order.count}} x</span> @{{order.name}}</p>
                                            <p>@{{Math.round(order.basePrice * order.count * 100) / 100}}&euro;</p>
                                        </div>
                                        <input type="hidden" name="dishes[]" :value="order.dishId">
                                        <input type="hidden" name="orders[]" :value="order.name">
                                        <input type="hidden" name="numberOfDishes[]" :value="order.count">
                                        <input type="hidden" name="dishPrices[]" :value="Math.round(order.basePrice * order.count * 100) / 100">
                                        <input type="hidden" name="finalPrice" :value="findMyOrders(`{{$restaurant->id}}`).finalPrice">
                                        <input type="hidden" name="business_name" value="{{$restaurant->business_name}}">
                                    </div>
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

   <div class="central_container">
        <div class="restaurant_menu">
            <div class="wrapper">
                <div class="dishes">
                    <h1>Seleziona i piatti che preferisci</h1>
                        @foreach ($restaurant->dishes as $dish)
                        @if($dish->visibility == 1)
                        <div class="dish" @click="addOrder(`{{$dish->name}}`, `{{$dish->price}}`, `{{$restaurant->id}}`, {{$dish->id}})">
                            <div class="dish_info">
                                <p><strong>{{ $dish->name }}</strong></p>
                                <p class="ingredients">{{ Str::substr($dish->ingredients, 0, 60) }} 
                                @if(strlen($dish->ingredients)> 65)
                                ...
                                @endif</p>
                                <span>{{ $dish->price }}&euro;</span>
                            </div>
                            <div class="dish_image_box">
                                <div class="img_box">
                                    <img src="{{ asset('storage/'. $dish->dish_img_path) }}" alt="image dish">
                                </div>
                            </div>
                        </div>
                        @endif
                    @endforeach
                </div>
                <div class="side_cart">
                    <form action="{{ route('guest.order.payment') }}" class="cart_content" method="get">
                        @csrf
                        @method('GET')
                        <div class="total">
                            <h5>Totale ordine:</h5>
                            <p v-for="price in findMyOrders(`{{$restaurant->id}}`).finalPrice"> @{{price}}&euro;</p>
                        </div>
                       
                        <button v-if="findMyOrders(`{{$restaurant->id}}`).finalPrice[0] == 0" disabled type="submit" class="order_btn order_btn_disabled">Seleziona un piatto</button>
                        <button v-if="findMyOrders(`{{$restaurant->id}}`).finalPrice[0] != 0" type="submit" class="order_btn">Effettua l'ordine</button>
                        <div class="cart_info" v-for="order in findMyOrders(`{{$restaurant->id}}`).filteredOrders">
                            <div class="buttons">
                                <button type="button" class="cartButtons" @click="(removeOrder(order.name))"><i class="fas fa-minus"></i></button>
                                <button type="button" class="cartButtons" @click="(addOrder(order.name, order.basePrice, `{{$restaurant->id}}`, order.dishId))"><i class="fas fa-plus"></i></button>
                            </div>
                            <div class="recap_products">
                                <p><span>@{{order.count}} x</span> @{{order.name}}</p>
                                <p>@{{Math.round(order.basePrice * order.count * 100) / 100}}&euro;</p>
                            </div>
                            <input type="hidden" name="dishes[]" :value="order.dishId">
                            <input type="hidden" name="orders[]" :value="order.name">
                            <input type="hidden" name="numberOfDishes[]" :value="order.count">
                            <input type="hidden" name="dishPrices[]" :value="Math.round(order.basePrice * order.count * 100) / 100">
                            <input type="hidden" name="finalPrice" :value="findMyOrders(`{{$restaurant->id}}`).finalPrice">
                            <input type="hidden" name="business_name" value="{{$restaurant->business_name}}">
                        </div>
                    </form>
                </div>
            </div>
        </div>
   </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/burger.js') }}"></script>
@endsection

