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

  <div class="form_container">
    <form action="{{ route('admin.menu.store', $slug) }}" method="post" enctype="multipart/form-data">
      @csrf
      @method('POST')
      <div class="form-group row">
        {{-- <label class="col-sm-2 col-form-label col-form-label-lg" for="name">Nome</label> --}}
        <div class="col-sm-10">
            <input type="text" class="form-control" name="name" id="name" placeholder="Nome" value="{{ old('name') }}">
        </div>
      </div>
  
      <div class="form-group row">
        {{-- <label class="col-sm-2 col-form-label col-form-label-lg" for="price">prezzo</label> --}}
        <div class="col-sm-10">
            <input type="text" class="form-control" name="price" id="price" placeholder="Prezzo" value="{{ old('price') }}">
        </div>
      </div>
      
      <div class="form-group row">
        {{-- <label class="col-sm-2 col-form-label col-form-label-lg" for="ingredients">Lista ingredienti</label> --}}
        <div class="col-sm-10">
          <textarea class="form-control" name="ingredients" id="ingredients" rows="10" placeholder="Ingredienti">{{ old('ingredients') }}</textarea>
        </div>
      </div>

      <div class="form-group row">
        <label class="col-sm-2 col-form-label col-form-label-lg " for="dish_img_path">Immagine</label>
        <div class="col-sm-10">
          <input type="file" class="" name="dish_img_path" id="dish_img_path" value="{{ old('dish_img_path') }}" accept="image/*">
        </div>
      </div>
  
      <div class="radio_box">
        <div class="form-check">
          <label class="form-check-label">
            <input type="radio" name="visibility" class="form-check-input" value="0"> NO
          </label>
        </div>

        <div class="form-check">
          <label class="form-check-label">
            <input type="radio" name="visibility" class="form-check-input" value="1"> SI
          </label>
        </div>
      </div>
      
      <input class="btn btn-primary mt-4" type="submit" value="Crea">
    </form>  
  </div>
  
@endsection