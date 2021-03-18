<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    {{-- select2 --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    {{-- select2 script  --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js" defer></script>
    <link rel="stylesheet" href="{{ asset('css/guestMainLayout.css') }}">
    @yield('links')
    <title>Deliverboo</title>
</head>
<body>
    <header>
        @yield('header')
    </header>

    <main style="width: 100%">
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
        </div>
    </footer>

</body>
</html>