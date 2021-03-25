@extends('layouts.admin.main')

@section('links')
  <link rel="stylesheet" href="{{asset('css/dishCreateLayout.css')}}"> 
@endsection

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

  <div class="container my-5">
    <form action="{{ route('admin.menu.store', $slug) }}" method="post" enctype="multipart/form-data">
      @csrf
      @method('POST')
      <div class="form-group row">
        <label class="col-sm-2 col-form-label col-form-label-lg" for="name">Nome</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="name" id="name" placeholder="" value="{{ old('name') }}">
        </div>
      </div>
  
      <div class="form-group row">
        <label class="col-sm-2 col-form-label col-form-label-lg" for="price">Prezzo</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="price" id="price" placeholder="" value="{{ old('price') }}">
        </div>
      </div>
      
      <div class="form-group row">
        <label class="col-sm-2 col-form-label col-form-label-lg" for="ingredients">Ingredienti</label>
        <div class="col-sm-10">
          <textarea class="form-control" name="ingredients" id="ingredients" rows="10" placeholder="">{{ old('ingredients') }}</textarea>
        </div>
      </div>

      <div class="form-group row">
        <label class="col-sm-2 col-form-label col-form-label-lg " for="dish_img_path">Immagine</label>
        <div class="col-sm-10">
          <input type="file" class="" name="dish_img_path" id="dish_img_path" value="{{ old('dish_img_path') }}" accept="image/*">
        </div>
      </div>

      <div class="d-flex">
        <label class="col-form-label col-form-label-lg mr-4">Disponibilità</label>

        <div class="radio_box ml-5">
          <div class="form-check">
            <label class="col-sm-2 col-form-label">
              <input type="radio" name="visibility" class="form-check-input" value="0"> NO
            </label>
          </div>

          <div class="form-check">
            <label class="col-sm-2 col-form-label">
              <input type="radio" name="visibility" class="form-check-input" value="1"> SI
            </label>
          </div>
        </div>
      </div>
  
      
      
      <input class="btn btn-danger my_btn mt-4" type="submit" value="Crea">
    </form>  
  </div>
  
@endsection