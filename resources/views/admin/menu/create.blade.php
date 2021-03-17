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
    <form action="{{ route('admin.menu.store', $slug) }}" method="post">
      @csrf
      @method('POST')
      <div class="form-group row">
        {{-- <label class="col-sm-2 col-form-label col-form-label-lg" for="name">Nome</label> --}}
        <div class="col-sm-10">
            <input type="text" class="form-control" name="name" id="name" placeholder="Nome"  value="">
        </div>
      </div>
  
      <div class="form-group row">
        {{-- <label class="col-sm-2 col-form-label col-form-label-lg" for="price">prezzo</label> --}}
        <div class="col-sm-10">
            <input type="text" class="form-control" name="price" id="price" placeholder="Prezzo"  value="">
        </div>
      </div>
      
      <div class="form-group row">
        {{-- <label class="col-sm-2 col-form-label col-form-label-lg" for="ingredients">Lista ingredienti</label> --}}
        <div class="col-sm-10">
          <textarea class="form-control" name="ingredients" id="ingredients" rows="10" placeholder="Ingredienti"></textarea>
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