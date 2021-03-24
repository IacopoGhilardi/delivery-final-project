@extends('layouts.admin.main')

@section('links')
  <link rel="stylesheet" href="{{asset('css/restaurantShow.css')}}"> 
@endsection

@section('content')
    {{-- <h1>Il mio ristorante</h1> --}}
    {{-- <div class="restaurant_box">
        <div class="left_box">
            <div>
                @if (!empty($restaurant->img_path))
                    <img style="border-radius: 5px" class="img-fluid" src="{{ asset('storage/' . $restaurant->img_path) }}" alt="{{ $restaurant->business_name }}">
                @else
                    <img style="border-radius: 5px" class="img-fluid" src="{{ asset('images/restaurantDefault.png') }}" alt="{{ $restaurant->business_name }}">
                @endif
                <h2 class="mt-4">Info</h2>
                <div class="card mt-2">
                    <h2 class="card-header">{{ $restaurant->business_name }}</h2>
                    <div class="card-body">
                        <p><strong>Indirizzo: </strong>{{ $restaurant->address }}</p>
                        <p><strong>P.IVA: </strong>{{ $restaurant->PIVA }}</p>
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
                            <td><img class="img-fluid" src="{{ asset('storage/' .$dish->dish_img_path) }}" alt="{{ $dish->name }}"></td>
                            <td>{{ $dish->name }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="d-flex">
                <td style="vertical-align: middle; text-align:center"> <a href="{{ route('admin.restaurant.edit', $restaurant->id) }}" class="btn btn-success mr-3"><i class="fas fa-pencil-alt"></i></a>
                </td>
                <td style="vertical-align: middle; text-align:center">
                    <form action="{{ route('admin.restaurant.destroy', $restaurant->id) }}" method="post" onSubmit="return confirm('Sei sicuro di voler eliminare questo ristorante?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
                    </form>
                </td>
                <div class="ml-3">
                    <a class="btn btn-info" style="color: white" " href="{{ route('admin.restaurant.index') }}">Indietro</a>
                </div>
            </div>
            

        </div>
    </div> --}}

    <div class="d-flex">

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
                <a href="{{ route('admin.restaurant.edit', $restaurant->id) }}" class="btn btn-success mr-1">Modifica</a>

                <form action="{{ route('admin.restaurant.destroy', $restaurant->id) }}" method="post" onSubmit="return confirm('Sei sicuro di voler eliminare questo ristorante?')">
                @csrf
                @method('DELETE')
                    <button type="submit" class="btn btn-danger">Elimina</i></button>
                </form>

                <a href="{{ route('admin.restaurant.index') }}" class="btn btn-primary ml-1">Indietro</a>
            </div>
            
        </div>
    </div>

    <table style="width: 70%; box-shadow: 0 5px 25px rgb(0 0 0 / 35%)" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th scope="col">Immagine Piatto</th>
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

    

@endsection