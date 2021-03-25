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
    {{-- SWIPERJS LIBRARY --}}
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.css" />
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    @yield('links')
    <title>Deliverboo</title>
</head>
<body>

    {{-- <div id="cart"> --}}
        <header>
            @yield('header')
        </header>
    
        <main>
            @yield('content')
        </main>

        <script src="https://unpkg.com/swiper/swiper-bundle.js"></script>
        <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
        <script>
            var swiper = new Swiper('.swiper-container', {
                slidesPerView: 5,
                spaceBetween: 30,
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                scrollbar: {
                    el: '.swiper-scrollbar',
                },
                // mousewheel: true,
                // keyboard: true,
            });
        </script>

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
    {{-- </div> --}}
  
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