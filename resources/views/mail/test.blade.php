<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>DeliveBoo</title>
    <style type="text/css">

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        header {
            width: 100%;
            height: 50px;
        }

        img {
            width: 200px;
        }

        main {
            width: 100%;
            height: calc(100vh - 50px);
            color: white;
            background-image: url({{ asset('images/logo/home-img.png') }});
            background-size: cover;
            backround-position: center;
            position: relative;
        }

        div {
            width: 100%;
            height: calc(100vh - 50px);
            background-color: rgba(0,0,0,0.2);
            position: absolute;
            top: 0;
            left: 0;
            text-align: center;
        }

        h1, h2, h3 {
          margin-top: 20px;
        }

    </style>
</head>
<body>

    <header>
        <img class="img-fluid" src="{{ asset('images/logo/logo-black.png') }}" alt="logo">
    </header>

    <main>
        <div>
            <h1>Ordine effettuato correttamente</h1>
            <!-- <h2>Segui i dettagli nel sito</h2> -->

            <h2>{{ $order->firstName }}</h2>
            <h2>{{ $order->lastName }}</h2>
            <h2>{{ $order->email }}</h2>

            <h3>{{ $order->status }}</h3>
            <h3>{{ $order->total_amount }} €</h3>
            <h3>{{ $order->created_at }}</h3>

        </div>
    </main>

</body>
</html>
