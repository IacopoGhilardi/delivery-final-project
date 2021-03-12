<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
  </head>
  <body>

    <div class="container my-5">

      <form action="{{route('admin.deliverboo.store')}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('POST')
        <div class="form-group row">
          <label class="col-sm-2 col-form-label col-form-label-lg" for="business_name">Nome Ristorante</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="business_name" id="business_name"  value="">
          </div>
        </div>
    
        <div class="form-group row">
          <label class="col-sm-2 col-form-label col-form-label-lg" for="address">Indirizzo</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="address" id="address"  value="">
          </div>
        </div>
    
        <div class="form-group row">
          <label class="col-sm-2 col-form-label col-form-label-lg" for="PIVA">PIVA</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="PIVA" id="PIVA"  value="">
          </div>
        </div>
    
        <div class="form-group row">
          <label class="col-sm-2 col-form-label col-form-label-lg " for="img_path">Immagine</label>
          <div class="col-sm-10">
            <input type="file" class="" name="img_path" id="img_path"  accept="image/*">
          </div>
        </div>
        
        <input class="btn btn-primary" type="submit" value="Crea">
      </form> 

    </div>
    
  </body>
</html>