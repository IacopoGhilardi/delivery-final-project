<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="shortcut icon" href="{{ asset('images/logo/deliveboo-resp-black.png') }}">
        <title>DeliveBoo</title>
        <link rel="stylesheet" href="{{asset('css/app.css')}}">
        <link rel="stylesheet" href="{{asset('css/adminLayout.css')}}">
        {{-- <link rel="stylesheet" href="{{asset('css/dishLayout.css')}}"> --}}
        @yield('links')

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        {{-- select2 --}}
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        {{-- select2 script  --}}
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js" defer></script>
    </head>
    <body>
        
        <main>
            <aside class="side_menu">
                <div class="logo_box" style="text-align: center">
                    <a class="logo" href="{{route('guest.homepage')}}">
                        <img src="{{ asset('images/logo/deliveboorichi.png') }}" alt="logo" style="width: 150px">
                    </a>
                    <a class="logo_resp" href="{{route('guest.homepage')}}">
                        <img src="{{ asset('images/logo/deliveboo-resp.png') }}" alt="logo" style="width: 50px">
                    </a>
                </div>

                <div class="nav_bar">
                    <ul class="nav_list">
                        <li class="{{Route::currentRouteName() == 'admin.restaurant.index' ? 'active' : ''}}">
                            <a href="{{ route('admin.restaurant.index') }}">
                                {{-- <i class="fas fa-utensils"></i> --}}
                                <i class="fas fa-store"></i>
                                <span>RISTORANTI</span>
                            </a>
                        </li>
                        <li class="{{Route::currentRouteName() == 'admin.restaurant.create' ? 'active' : ''}}">
                            <a href="{{ route('admin.restaurant.create') }}">
                                {{-- <i class="fas fa-store"></i> --}}
                                <i class="fas fa-plus"></i>
                                <span>AGGIUNGI</span>
                            </a>
                        </li>
                        {{-- <li class="{{Route::currentRouteName() == 'admin.restaurant.statistic' ? 'active' : ''}}"><a href="{{ route('admin.restaurant.statistic') }}"><i class="fas fa-chart-pie"></i><span>Visualizza Statistiche</span></a></li> --}}
                    </ul>
                </div>
            </aside>

            <section class="body_pannel">
               <div class="pannel_header">
                    {{-- <p>@if (Route::currentRouteName() == 'admin.restaurant.index')
                        I Miei Ristoranti @elseif(Route::currentRouteName() == 'admin.restaurant.create')
                        Aggiungi Ristorante @elseif(Route::currentRouteName() == 'admin.restaurant.show')
                        I Miei Ristoranti > Info @elseif(Route::currentRouteName() == 'admin.restaurant.edit')
                        I Miei Ristoranti > Modifica @elseif(Route::currentRouteName() == 'admin.menu.index')
                        I Miei Ristoranti > Menu @elseif(Route::currentRouteName() == 'admin.menu.edit')
                        I Miei Ristoranti > Menu > Modifica Piatto
                    @endif</p> --}}
                    <div class="user_info">
                        {{-- <p>{{Auth::user()->firstName}}</p> --}}
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            @method('POST')
                            <button type="submit" class="btn btn-danger my_btn mr-1">
                                <span>Log Out</span>
                                {{-- <i class="fas fa-arrow-right"></i> --}}
                                <i class="fas fa-door-open"></i>
                            </button>
                        </form>
                    </div>
               </div>

               <div class="pannel_content_container">
                   @yield('content')
               </div>
            </section>
        </main>

    </body>
</html>