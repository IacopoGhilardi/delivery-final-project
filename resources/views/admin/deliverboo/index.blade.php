@extends('layouts.admin.main')

@section('content')
  
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
                <img class="img-fluid" src="{{ asset('images/restaurantDefault.png') }}" alt="{{ $restaurant->business_name }}">
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
    
@endsection