@extends('layouts.admin.main')

@section('content')

  <div class="container mt-4">
    <form action="{{ route('admin.menu.store', $slug) }}" method="post">
      @csrf
      @method('POST')
      <div class="form-group row">
        <label class="col-sm-2 col-form-label col-form-label-lg" for="name">Nome</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="name" id="name"  value="">
        </div>
      </div>
  
      <div class="form-group row">
        <label class="col-sm-2 col-form-label col-form-label-lg" for="price">prezzo</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="price" id="price"  value="">
        </div>
      </div>
      
      <div class="form-group row">
        <label class="col-sm-2 col-form-label col-form-label-lg" for="ingredients">Lista ingredienti</label>
        <div class="col-sm-10">
          <textarea class="form-control" name="ingredients" id="ingredients" rows="10"></textarea>
        </div>
      </div>
  
      <div class="form-check">
        <label class="form-check-label">
          <input type="radio" name="visibility" class="form-check-input" value="0"> NO
        </label>
      </div>
      <div class="form-check">
        <label class="form-check-label">
          <input type="radio" name="visibility" class="form-check-input" value="1"> Si
        </label>
      </div>
      
      <input class="btn btn-primary mt-4" type="submit" value="Crea">
    </form>  
  </div>
  
@endsection