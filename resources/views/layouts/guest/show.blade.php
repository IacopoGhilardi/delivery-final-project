<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
     <!-- Scripts -->
     <script src="{{ asset('js/app.js') }}" defer></script>
     <script src="{{ asset('js/cart.js') }}" defer></script>
     <script src="{{ asset('js/script.js') }}" defer></script>

     <link rel="stylesheet" href="{{ asset('css/guestMainLayout.css') }}">
     @yield('links')

    <title>Document</title>
</head>
<body>
    
    <div id="cart">
        <header>
            @yield('header')
        </header>
    
        <main>
            @yield('content')
        </main>
    </div>
</body>
</html>