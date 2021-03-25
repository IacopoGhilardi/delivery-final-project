@extends('layouts.admin.main')

@section('content')

    {{-- gestisco il messaggio status update e destroy --}}
    @if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
    @endif

  <div class="d-flex justify-content-around mt-5 flex-wrap"> 
    @foreach ($restaurants as $restaurant)
      {{-- <div class="my_card mt-5">
        <div class="my_card_body">
          <div class="restaurant_img">
            @if (!empty($restaurant->img_path))
            <img class="img-fluid" src="{{ asset('storage/' . $restaurant->img_path) }}" alt="{{ $restaurant->business_name }}">
            @else
            <img class="img-fluid" src="{{ asset('images/restaurantDefault.png') }}" alt="{{ $restaurant->business_name }}">
            @endif
          </div>
          <div class="position_absolute">
            <div class="card_top">
              <h3>{{$restaurant->business_name}}</h3>
              <p>{{$restaurant->address}}</p>
              <p>{{$restaurant->PIVA}}</p>
            </div>
            <div class="card_bottom">
              <a href="{{ route('admin.restaurant.show', $restaurant->id) }}" class="btn btn-info"><i class="far fa-eye" style="color: white"></i></a>
              <a href="{{ route('admin.menu.index', $restaurant->slug) }}" class="btn btn-success"><i class="fas fa-hamburger"></i></a>
            </div>
          </div>
        </div>
      </div>
      <tr> --}}

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
              <a href="{{ route('admin.restaurant.show', $restaurant->id) }}" class="btn btn-primary mr-1">Dettaglio</a>
              <a href="{{ route('admin.menu.index', $restaurant->slug) }}" class="btn btn-success mr-1">Menu</a>
              <a href="{{ route('admin.restaurant.statistic', $restaurant->slug) }}" class="btn btn-danger">Statistiche</a>
            </div>
            
          </div>
        </div>
        

        {{-- <td style="vertical-align: middle; text-align:center"> </td>
        <td style="vertical-align: middle; text-align:center"> <a href="{{ route('admin.restaurant.edit', $restaurant->id) }}" class="btn btn-success"><i class="fas fa-pencil-alt"></i></a> </td>
        <td style="vertical-align: middle; text-align:center">
          <form action="{{ route('admin.restaurant.destroy', $restaurant->id) }}" method="post" onSubmit="return confirm('Sei sicuro di voler eliminare questo ristorante?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
          </form>
        </td>
        <td style="vertical-align: middle; text-align:center">  </td>

      </tr>           --}}
    @endforeach      
  </div>
    
@endsection

