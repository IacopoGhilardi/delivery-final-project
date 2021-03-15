<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Menu</title>
</head>
<body>
  <h1> questa pagina  </h1>
  <ul>
    @foreach ($restaurant->dishes as $dish)
        <li>{{$dish->name}}</li>
    @endforeach
  </ul>
</body>
</html>