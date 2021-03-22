@extends('layouts.admin.main')

@section('links')
  <link rel="stylesheet" href="{{asset('css/dishLayout.css')}}"> 
@endsection

@section('content')

  <h1>Il mio menu</h1>
  {{-- gestisco il messaggio status update e destroy --}}
  @if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
  @endif

  <div class="d-flex mt-4">
    <div>
      <a class="btn btn-info shadow-none" href="{{ route('admin.menu.create', $restaurant->slug) }}">Crea nuovo piatto</a>
    </div>
  
    <div class="ml-3">
      <a class="btn btn-primary" style="color: white" " href="{{ route('admin.restaurant.index', $restaurant->slug) }}">Indietro</a>
    </div>
  </div>
  

  <div class="d-flex justify-content-around mt-3 flex-wrap">
    @foreach ($restaurant->dishes as $dish)
          <div class="card mt-5 ">

            <div class="card-body">
              <div class="dish_img">
              @if (!empty($dish->dish_img_path))
                <img class="img-fluid" src="{{ asset('storage/' . $dish->dish_img_path) }}" alt="{{ $dish->name }}">
              @else
                <img class="img-fluid" src="{{ asset('images/restaurantDefault.png') }}" alt="{{ $dish->name }}">
              @endif
            </div>

            <div class="position_absolute">
              <div class="card_top">
                <h4>{{$dish->name}}</h4>
                <p>{{$dish->price}}&euro;</p>
                <p>{{$dish->ingredients}}</p>
              </div>

              <div>
                  <p>Visible? {{ $dish->visibility == 1 ? 'Si' : 'No' }}</p>
              </div>

              <div class="card_bottom">
                <div>
                  <a href="{{route('admin.menu.edit', $dish)}}" class="btn btn-success">
                    <i class="fas fa-pencil-alt"></i>
                  </a>
                </div>
                <div>
                  <form action="{{route('admin.menu.destroy', $dish->id)}}" method="post" onSubmit="return confirm('Sei sicuro di voler eliminare questo piatto?')">
                  @csrf
                  @method('DELETE')
                  {{-- <input type="submit" class="btn btn-danger" value="Elimina"> --}}
                  <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
                  </form>
                </div>
              </div>
            </div>
            
          </div>
        </div>
    @endforeach
  </div>

@endsection