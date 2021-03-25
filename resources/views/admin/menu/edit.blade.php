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
      <form class="my_form" action="{{ route('admin.menu.update', $dish->id) }}" method="post" enctype="multipart/form-data">
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
          <label class="col-sm-2 col-form-label col-form-label-lg" for="ingredients">Ingredienti</label>
          <div class="col-sm-10">
            <textarea style="resize: none" class="form-control" name="ingredients" id="ingredients" rows="8">{{$dish->ingredients}}</textarea>
          </div>
        </div>

        <div class="my-4">
          
        </div>

        <div class="form-group row">
          <label class="col-sm-2 col-form-label col-form-label-lg " for="dish_img_path">Scegli nuova immagine</label>
          @if (!empty($dish->dish_img_path))
            <img style="width: 150px; margin-left: 15px" class="img-fluid mb-3" src="{{ asset('storage/' . $dish->dish_img_path) }}" alt="{{ $dish->name }}">
          @else
            <img style="width: 150px; margin-left: 15px" class="img-fluid mb-3" src="{{ asset('images/restaurantDefault.png') }}" alt="{{ $dish->name }}">
          @endif
          <div class="col-sm-2">
            <input type="file" class="" name="dish_img_path" id="dish_img_path"  accept="image/*">
          </div>
        </div>

        <div class="d-flex">
          <label class="col-form-label col-form-label-lg mr-4">Disponibilità</label>

          <div class="radio_box ml-5">
            <div class="form-check">
              <label class="col-sm-2 col-form-label">
                <input type="radio" {{$dish->visible == 0 ? 'checked' : ''}} name="visibility" class="form-check-input" value="0"> NO
              </label>
            </div>

            <div class="form-check">
              <label class="col-sm-2 col-form-label">
                <input type="radio" {{$dish->visible == 1 ? 'checked' : ''}} name="visibility" class="form-check-input" value="1"> SI
              </label>
            </div>
          </div>
        </div>

        <input class="btn btn-success mt-5" type="submit" value="MODIFICA">
      </form>

      <div>
        <a href="{{route('admin.menu.index', $dish->restaurant->slug)}}" class="btn btn-primary btn_circle mt-5">
          <i class="fas fa-arrow-left"></i>
        </a>
      </div>

  </div>

@endsection