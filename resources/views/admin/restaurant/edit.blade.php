@extends('layouts.admin.main')

@section('content')

  <div style="overflow-x: hidden">
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{$error}}</li>
          @endForeach
        </ul>
      </div>
    @endif
  </div>
  
  <div class="my-4">
      <form class="my_form" action="{{ route('admin.restaurant.update', $restaurant->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group row">
          <label class="col-sm-2 col-form-label col-form-label-lg" for="business_name">Nome</label>
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
          <label class="col-sm-2 col-form-label col-form-label-lg " for="img_path">Nuova immagine</label>
          @if (!empty($restaurant->img_path))
            <img style="width: 150px; margin-left: 15px" class="img-fluid mb-3" src="{{ asset('storage/' . $restaurant->img_path) }}" alt="{{ $restaurant->business_name }}">
          @else
            <img style="width: 150px; margin-left: 15px" class="img-fluid mb-3" src="{{ asset('images/restaurantDefault.png') }}" alt="{{ $restaurant->business_name }}">
          @endif
          <div class="col-sm-2">
            <input type="file" class="" name="img_path" id="img_path"  accept="image/*">
          </div>
        </div>

        <div class="form-group row">
            <label for="address" class="col-sm-2 col-form-label col-form-label-lg">{{ __('Tipologia') }}</label>

            <div class="col-md-6">
                <select id="type_id" name="types[]" class="js-example-basic-multiple" multiple="multiple" style="width: 100%">
                    @foreach ($types as $type)
                        <option value="{{ $type->id }}" 
                          @foreach ($restaurant->types as $restaurantType)
                              @if ($restaurantType->id == $type->id)
                                  selected
                              @endif
                          @endforeach
                          >{{ $type->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        
        <input class="btn btn-success" type="submit" value="MODIFICA">
      </form>
      
      <div class="mt-5">
        <a class="btn btn-primary btn_circle" href="{{ route('admin.restaurant.show', $restaurant->id) }}">
          {{-- Indietro --}}
          <i class="fas fa-arrow-left"></i>
        </a>
      </div>
  </div>

  <script>
    // In your Javascript (external .js resource or <script> tag)
    $(document).ready(function() {
      $('.js-example-basic-multiple').select2();
    });
  </script>
@endsection