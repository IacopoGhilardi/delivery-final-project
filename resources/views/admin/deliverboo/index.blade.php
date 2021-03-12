<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Index</title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
  </head>
  <body>

    <div class="container">

      <table class="table table-striped table-bordered">
        <thead>
          <tr>
            <th scope="col"> Nome Attività </th>
            <th scope="col"> Indirizzo </th>
            <th scope="col"> PIVA </th>
            <th style="width: 150px"> Immagine </th>
            <th colspan="3"></th>
          </tr>
        </thead>
        <tbody>
          @foreach ($restaurants as $restaurant)
            <tr>
              <td> {{$restaurant->business_name}} </td>
              <td> {{$restaurant->address}} </td>
              <td> {{$restaurant->PIVA}} </td>
              <td>
                @if (!empty($restaurant->img_path))
                  <img class="img-fluid" src="{{ asset('storage/' . $restaurant->img_path) }}" alt="{{ $restaurant->business_name }}">
                @else
                  <img class="img-fluid" src="{{ asset('images/user.png') }}" alt="{{ $restaurant->business_name }}">
                @endif
              </td>
              <td> <a href="btn btn-info"></a> </td>
              <td> <a href="btn btn-success"></a> </td>
              <td> <a href="btn btn-danger"></a> </td>
            </tr>          
          @endforeach      
        </tbody>
      </table>

    </div>
    
  </body>
</html>
