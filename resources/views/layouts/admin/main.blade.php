<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Deliverboo</title>
        <link rel="stylesheet" href="{{asset('css/app.css')}}">
        <link rel="stylesheet" href="{{asset('css/adminLayout.css')}}">

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
                <div class="logo_box">
                    <a class="logo" href="{{route('admin.deliverboo.index')}}"><img src="https://www.maredentrosicilia.com/wp-content/uploads/2016/12/PREFERRED-VERSION-Deliveroo-Logo_Full_CMYK_Teal-2.png" alt="" style="width: 150px"></a>
                </div>

                <div class="nav_bar">
                    <ul class="nav_list">
                        <li class="{{Route::currentRouteName() == 'admin.deliverboo.index' ? 'active' : ''}}"><a href="{{ route('admin.deliverboo.index') }}"><i class="fas fa-utensils"></i><span>I miei Ristoranti</span></a></li>
                        <li class="{{Route::currentRouteName() == 'admin.deliverboo.create' ? 'active' : ''}}"><a href="{{ route('admin.deliverboo.create') }}"><i class="fas fa-store"></i><span>Aggiungi Ristorante</span></a></li>
                        <li><a href=""><i class="fas fa-chart-pie"></i><span>Visualizza Statistiche</span></a></li>
        
                    </ul>
                </div>
            </aside>

            <section class="body_pannel">
               <div class="pannel_header">
                    <p>@if (Route::currentRouteName() == 'admin.deliverboo.index')
                        I Miei Ristoranti @elseif(Route::currentRouteName() == 'admin.deliverboo.create')
                        Aggiungi Ristorante @elseif(Route::currentRouteName() == 'admin.deliverboo.show')
                        I Miei Ristoranti > Info @elseif(Route::currentRouteName() == 'admin.deliverboo.edit')
                        I Miei Ristoranti > Modifica @elseif(Route::currentRouteName() == 'admin.menu.index')
                        I Miei Ristoranti > Menu @elseif(Route::currentRouteName() == 'admin.menu.edit')
                        I Miei Ristoranti > Menu > Modifica Piatto
                    @endif</p>
                    <div class="user_info">
                        <p>{{Auth::user()->firstName}}</p>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            @method('POST')
                            <input type="submit" value="Log Out">
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