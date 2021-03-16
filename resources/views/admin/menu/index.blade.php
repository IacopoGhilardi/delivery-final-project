@extends('layouts.admin.main')

@section('links')
   <link rel="stylesheet" href="{{asset('css/dishLayout.scss')}}"> 
@endsection

@section('content')

  <h1>Il mio menu</h1>
  {{-- gestisco il messaggio status update e destroy --}}
  @if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
  @endif
  <a href="{{ route('admin.menu.create', $restaurant->slug) }}">Crea nuovo piatto</a>

  <div class="d-flex justify-content-around mt-3 flex-wrap">
    @foreach ($restaurant->dishes as $dish)
        <div class="card mt-5 ">
          <div class="card-body">
            <h4>{{$dish->name}}</h4>
            <p>{{$dish->price}}&euro;</p>
            <p>{{$dish->ingredients}}</p>
            <p>Visible? {{ $dish->visibility == 1 ? 'Si' : 'No' }}</p>
            <a href="{{route('admin.menu.edit', $dish)}}" class="btn btn-info">Modifica Piatto</a>
            <form action="{{route('admin.menu.destroy', $dish->id)}}" method="post" onSubmit="return confirm('Sei sicuro di voler eliminare questo piatto?')">
              @csrf
              @method('DELETE')
              <input type="submit" class="btn btn-danger" value="Elimina Piatto">
            </form>
          </div>
        </div>
    @endforeach
  </div>

@endsection