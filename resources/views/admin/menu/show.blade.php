{{-- @extends('layouts.admin.main')

@section('content')

  <h1>Questo piatto</h1>
  <ul>
    @foreach ($restaurant->dishes as $dish)
        <li>{{$dish->name}}</li>
    @endforeach
  </ul>

  @if (!empty($dish->dish_img_path))
      <img class="img-fluid" src="{{ asset('storage/' . $dish->img_path) }}" alt="{{ $dish->name }}">
  @else
      <img class="img-fluid" src="{{ asset('images/restaurantDefault.png') }}" alt="{{ $dish->name }}">
  @endif

@endsection --}}