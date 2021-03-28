<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="{{ asset('images/logo/deliveboo-resp-black.png') }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    {{-- select2 --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    {{-- select2 script  --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js" defer></script>
    <link rel="stylesheet" href="{{ asset('css/guestMainLayout.css') }}">
    {{-- SWIPERJS LIBRARY --}}
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.css" />
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    @yield('links')
    <title>DeliveBoo</title>
</head>
<body>

    {{-- <div id="cart"> --}}
        <header>
            @yield('header')
        </header>
    
        <main>
            @yield('content')
        </main>

        <footer style="" class="">
          @include('layouts.guest.footer')
        </footer>
  
    <script>
        $(document).ready(function(){
            $(this).scrollTop(0);
        });

        
        // $(document).ready(function(){
        //     $('html, body').scrollTop(0);

        //     $(window).on('load', function() {
        //     setTimeout(function(){
        //         $('html, body').scrollTop(0);
        //     }, 0);
        // });
        // });
    </script>
    @yield('scripts')
</body>
</html>