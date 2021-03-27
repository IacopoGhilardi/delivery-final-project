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

    <title>DeliveBoo</title>
</head>
<body>
    
    <div id="cart">
        <header>
            @yield('header')
        </header>
    
        <main>
            @yield('content')
        </main>

        <footer style="display: block" class="">
            <div class="layout_footer">
                <div class="footer_layout_wrapper">
            
                    <div class="footer_box">
                        <ul>
                            <li>Qualcosa</li>
                            <li>Un'altra cosa</li>
                            <li>Ancora un'altra cosa</li>
                            <li>Una cosa in meno</li>
                            <li>Che bella cosa!</li>
                        </ul>
                    </div>
                
                    <div class="footer_box">
                        <ul>
                            <li>Qualcosa</li>
                            <li>Un'altra cosa</li>
                            <li>Ancora un'altra cosa</li>
                            <li>Una cosa in meno</li>
                            <li>Che bella cosa!</li>
                        </ul>
                    </div>
                
                    <div class="footer_box">
                        <ul>
                            <li>Qualcosa</li>
                            <li>Un'altra cosa</li>
                            <li>Ancora un'altra cosa</li>
                            <li>Una cosa in meno</li>
                            <li>Che bella cosa!</li>
                        </ul>
                    </div>
                </div>
                <p class="copyright">© 2021 - deliveboo Srl - All Rights Reserved - Via Ciovassino 3/A 20121 Milan - PIVA 03833390966</p>
            </div>
        </footer>
    </div>

    @yield('scripts')
</body>
</html>