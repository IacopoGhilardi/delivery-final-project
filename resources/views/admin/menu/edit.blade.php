<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div class="container mt-4">
        <form action="{{ route('admin.menu.update', $dish->id) }}" method="post">
          @csrf
          @method('PUT')
          <div class="form-group row">
            <label class="col-sm-2 col-form-label col-form-label-lg" for="name">Nome</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="name" id="name"  value="{{$dish->name}}">
            </div>
          </div>
      
          <div class="form-group row">
            <label class="col-sm-2 col-form-label col-form-label-lg" for="price">prezzo</label>
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
          
          <input class="btn btn-primary mt-4" type="submit" value="Crea">
        </form>  
      </div>
</body>
</html>