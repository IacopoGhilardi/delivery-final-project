@extends('layouts.admin.main')

@section('content')


  <div class="container">
    {{-- gestisco il messaggio status update e destroy --}}
    @if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
    @endif

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
            <td> <a href="{{ route('admin.deliverboo.show', $restaurant->id) }}" class="btn btn-info">Info</a> </td>
            <td> <a href="{{ route('admin.deliverboo.edit', $restaurant->id) }}" class="btn btn-success">Edit</a> </td>
            <td>
              <form action="{{ route('admin.deliverboo.destroy', $restaurant->id) }}" method="post" onSubmit="return confirm('Sei sicuro di voler eliminare questo ristorante?')">
                @csrf
                @method('DELETE')
                <input type="submit" class="btn btn-danger" value="Destroy">
              </form>
            </td>
            <td> <a href="{{ route('admin.menu.show', $restaurant->id) }}" class="btn btn-success">Menu</a> </td>

          </tr>          
        @endforeach      
      </tbody>
    </table>
  </div>
    
@endsection