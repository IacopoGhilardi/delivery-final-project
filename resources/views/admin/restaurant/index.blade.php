@extends('layouts.admin.main')

@section('content')

  <div class="d-flex justify-content-around mt-3 flex-wrap">
    {{-- gestisco il messaggio status update e destroy --}}
    @if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
    @endif


    @foreach ($restaurants as $restaurant)
      <div class="card mt-5">
        <div class="card-body">
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
              <a href="{{ route('admin.restaurant.show', $restaurant->id) }}" class="btn btn-info"><i class="far fa-eye"></i></a>
              <a href="{{ route('admin.menu.index', $restaurant->slug) }}" class="btn btn-success"><i class="fas fa-utensils"></i></a>
            </div>
          </div>
        </div>
      </div>
      <tr>
        

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

