@extends('layouts.admin.main')

@section('links')
    <link rel="stylesheet" href="{{asset('css/adminRestaurantIndex.css')}}">
@endsection

@section('content')

    {{-- gestisco il messaggio status update e destroy --}}
    @if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
    @endif

  <div class="d-flex justify-content-around mt-4 flex-wrap"> 
    @foreach ($restaurants as $restaurant)
        

        <div class="card my_shadow" style="width: 18rem;">
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
              <a href="{{ route('admin.restaurant.show', $restaurant->id) }}" class="btn btn-primary mr-1">
                {{-- Dettaglio --}}
                <i class="far fa-eye"></i></a>
              </a>
              <a href="{{ route('admin.menu.index', $restaurant->slug) }}" class="btn btn-success mr-1">
                {{-- Menu --}}
                {{-- <i class="fas fa-hamburger"></i> --}}
                <i class="fas fa-utensils"></i>
              </a>
              <a href="{{ route('admin.restaurant.statistic', $restaurant->slug) }}" class="btn btn-danger">
                {{-- Statistiche --}}
                <i class="fas fa-chart-pie"></i>
              </a>
            </div>
            
          </div>
        </div>
        

       
    @endforeach      
  </div>
    
@endsection

