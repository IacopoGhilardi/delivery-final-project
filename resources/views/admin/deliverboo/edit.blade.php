@extends('layouts.admin.main')


@section('content')
<div class="container my-5">

    <form action="{{ route('admin.deliverboo.update', $restaurant->id) }}" method="post" enctype="multipart/form-data">
      @csrf
      @method('PUT')
      <div class="form-group row">
        <label class="col-sm-2 col-form-label col-form-label-lg" for="business_name">Nome Ristorante</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" name="business_name" id="business_name"  value="{{ $restaurant->business_name }}">
        </div>
      </div>
  
      <div class="form-group row">
        <label class="col-sm-2 col-form-label col-form-label-lg" for="address">Indirizzo</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" name="address" id="address"  value="{{ $restaurant->address }}">
        </div>
      </div>
  
      <div class="form-group row">
        <label class="col-sm-2 col-form-label col-form-label-lg" for="PIVA">PIVA</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" name="PIVA" id="PIVA"  value="{{ $restaurant->PIVA }}">
        </div>
      </div>
  
      <div class="form-group row">
        <label class="col-sm-2 col-form-label col-form-label-lg " for="img_path">Scegli nuova immagine</label>
        <div class="col-sm-10">
          <input type="file" class="" name="img_path" id="img_path"  accept="image/*">
        </div>
      </div>
      
      <input class="btn btn-success" type="submit" value="Modifica">
    </form> 
@endsection