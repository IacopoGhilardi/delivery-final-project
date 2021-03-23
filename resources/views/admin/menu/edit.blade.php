@extends('layouts.admin.main')

@section('content')
  @if ($errors->any())
    <div class="alert alert-danger">
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{$error}}</li>
        @endForeach
      </ul>
    </div>
  @endif

  <div class="container mt-4">
      <form action="{{ route('admin.menu.update', $dish->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group row">
          <label class="col-sm-2 col-form-label col-form-label-lg" for="name">Nome</label>
          <div class="col-sm-10">
              <input type="text" class="form-control" name="name" id="name"  value="{{$dish->name}}">
          </div>
        </div>
    
        <div class="form-group row">
          <label class="col-sm-2 col-form-label col-form-label-lg" for="price">Prezzo</label>
          <div class="col-sm-10">
              <input type="text" class="form-control" name="price" id="price"  value="{{$dish->price}}">
          </div>
        </div>
        
        <div class="form-group row">
          <label class="col-sm-2 col-form-label col-form-label-lg" for="ingredients">Lista ingredienti</label>
          <div class="col-sm-10">
            <textarea class="form-control" name="ingredients" id="ingredients" rows="10">{{$dish->ingredients}}</textarea>
          </div>
        </div>

        <div class="my-4">
          @if (!empty($dish->dish_img_path))
            <img style="width: 150px; margin-left: 190px" class="img-fluid" src="{{ asset('storage/' . $dish->dish_img_path) }}" alt="{{ $dish->name }}">
          @else
            <img style="width: 150px; margin-left: 190px" class="img-fluid" src="{{ asset('images/restaurantDefault.png') }}" alt="{{ $dish->name }}">
          @endif
        </div>

        <div class="form-group row">
          <label class="col-sm-2 col-form-label col-form-label-lg " for="dish_img_path">Scegli nuova immagine</label>
          <div class="col-sm-10">
            <input type="file" class="" name="dish_img_path" id="dish_img_path"  accept="image/*">
          </div>
        </div>
    
        <div class="form-check">
          <label class="form-check-label">
            <input type="radio" {{$dish->visible == 0 ? 'checked' : ''}} name="visibility" class="form-check-input" value="0"> NO
          </label>
        </div>
        <div class="form-check">
          <label class="form-check-label">
            <input type="radio" {{$dish->visible == 1 ? 'checked' : ''}} name="visibility" class="form-check-input" value="1"> Si
          </label>
        </div>
        
        <input class="btn btn-primary my-5" type="submit" value="Modifica">
      </form>
  </div>

@endsection