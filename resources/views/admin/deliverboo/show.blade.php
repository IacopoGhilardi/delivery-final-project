@extends('layouts.admin.main')


@section('content')
    <div class="container">
        @if (!empty($restaurant->img_path))
        <img class="img-fluid" src="{{ asset('storage/' . $restaurant->img_path) }}" alt="{{ $restaurant->business_name }}">
        @else
            <img class="img-fluid" src="{{ asset('images/restaurantDefault.png') }}" alt="{{ $restaurant->business_name }}">
        @endif
        <h1>{{ $restaurant->business_name }}</h1>
        <p>{{ $restaurant->address }}</p>
        <p>{{ $restaurant->PIVA }}</p>
        <ul>
            @foreach ($restaurant->types as $type)
                <li>{{ $type->name }}</li>
            @endforeach
        </ul>


        <div class="menu">
            <h2>Menu</h2>
            @foreach ($restaurant->dishes as $dish)
                <p>{{ $dish->name }}</p>
            @endforeach
            <h5>Aggiungi un piatto</h5>
            <form action="">
                <input type="text">
            </form>
        </div>
    </div>
@endsection