<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>DeliveBoo</title>
</head>
<body>
    {{-- <div style="width: 100%; height: 100vh; padding: 20px; color: white; background: linear-gradient(153deg, #f8585e 20%, #f8b64a 80%)">
        <h1>DELIVEBOO</h1>
        <h2>Ordine effettuato correttamente</h2>
        <h3>Segui i dettagli nel sito</h3>
    </div> --}}
    
    <header style="width: 100%; background-color: white">
        <img style="width: 200px" class="img-fluid" src="{{ asset('images/logo/logo-black.png') }}" alt="logo">
    </header>

    <main style="width: 100%; height: calc(100vh - 50px); padding: 20px; color: white; background-image: url({{ asset('images/logo/home-img.png') }}); background-size: cover; background-position: top">
        <h1>Ordine effettuato correttamente</h1>
        <h2>Segui i dettagli nel sito</h2>
    </main>

</body>
</html>