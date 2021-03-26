@extends('layouts.admin.main')

@section('links')
  <link rel="stylesheet" href="{{asset('css/restaurantShow.css')}}"> 
@endsection

@section('content')
    
    {{-- <div class="d-flex direction"> --}}
    <div class="d-flex justify-content-around my-4 flex-wrap">

        <div class="card mr-5" style="width: 18rem; box-shadow: 0 5px 25px rgb(0 0 0 / 35%)">
            {{-- <img src="..." class="card-img-top" alt="..."> --}}
            @if (!empty($restaurant->img_path))
            <img class="card-img-top" src="{{ asset('storage/' . $restaurant->img_path) }}" alt="{{ $restaurant->business_name }}">
            @else
            <img class="card-img-top" src="{{ asset('images/restaurantDefault.png') }}" alt="{{ $restaurant->business_name }}">
            @endif
            <div class="card-body">
                <h5 class="card-title">{{$restaurant->business_name}}</h5>
                <p class="card-text">
                    <i class="fas fa-map-marker-alt"></i>
                    {{$restaurant->address}}
                </p>
                <p class="card-text">{{$restaurant->PIVA}}</p>
                <ul>
                    @foreach ($restaurant->types as $type)
                        <li class="badge badge-secondary">{{ $type->name }}</li>
                    @endforeach
                </ul>

                <div class="d-flex">
                    <a href="{{ route('admin.restaurant.edit', $restaurant->id) }}" class="btn btn-success mr-1">
                        {{-- Modifica --}}
                        <i class="fas fa-pencil-alt"></i>
                    </a>

                    <form action="{{ route('admin.restaurant.destroy', $restaurant->id) }}" method="post" onSubmit="return confirm('Sei sicuro di voler eliminare questo ristorante?')">
                    @csrf
                    @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            {{-- Elimina --}}
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </form>

                    {{-- <a href="{{ route('admin.restaurant.index') }}" class="btn btn-primary ml-1">
                        Indietro
                        <i class="fas fa-arrow-left"></i>
                    </a> --}}
                </div>
            </div>
        </div>

        <table style="box-shadow: 0 5px 25px rgb(0 0 0 / 35%)" class="table table-striped table-bordered my_table">
            <thead>
                <tr>
                    <th scope="col">Piatto</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Prezzo</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($restaurant->dishes as $dish)
                    <tr>
                        <td><img style="width: 100px" class="img-fluid" src="{{ asset('storage/' .$dish->dish_img_path) }}" alt="{{ $dish->name }}"></td>
                        <td>{{ $dish->name }}</td>
                        <td>{{ $dish->price }} &euro;</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>

    <a href="{{ route('admin.restaurant.index') }}" class="btn btn-primary btn_circle mt-3 ml-1">
        {{-- Indietro --}}
        <i class="fas fa-arrow-left"></i>
    </a>

@endsection