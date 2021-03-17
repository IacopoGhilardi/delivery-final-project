@extends('layouts.admin.main')

@section('links')
  <link rel="stylesheet" href="{{asset('css/restaurantShow.css')}}"> 
@endsection

@section('content')
    <h1>Il mio ristorante</h1>
    <div class="restaurant_box">
        <div class="left_box">
            <div>
                @if (!empty($restaurant->img_path))
                <img class="img-fluid" src="{{ asset('storage/' . $restaurant->img_path) }}" alt="{{ $restaurant->business_name }}">
                @else
                    <img class="img-fluid" src="{{ asset('images/restaurantDefault.png') }}" alt="{{ $restaurant->business_name }}">
                @endif
                <h2 class="mt-4">INFO</h2>
                <div class="card mt-2">
                    <div class="card-body">
                        <h2>{{ $restaurant->business_name }}</h2>
                        <p>Indirizzo: {{ $restaurant->address }}</p>
                        <p>P.IVA: {{ $restaurant->PIVA }}</p>
                        <ul>
                            @foreach ($restaurant->types as $type)
                                <li>{{ $type->name }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="right_box">
            <div class="menu">
                <h2>Menu</h2>
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Immagine Piatto</th>
                            <th>Nome Piatto</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($restaurant->dishes as $dish)
                        <tr>
                            <td><img class="img-fluid" src="{{ asset('images/food_icon.png') }}" alt="{{ $dish->name }}"></td>
                            <td>{{ $dish->name }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection