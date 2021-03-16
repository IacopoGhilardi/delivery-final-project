@extends('layouts.admin.main')

@section('content')

  <div>
    {{-- gestisco il messaggio status update e destroy --}}
    @if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
    @endif

    <table class="table table-striped table-bordered">
      <thead>
        <tr>
          <th scope="col"> Nome Attività </th>
          <th scope="col"> Indirizzo </th>
          <th scope="col"> PIVA </th>
          <th style="width: 30px"> Immagine </th>
          <th colspan="4"></th>
        </tr>
      </thead>
      <tbody>
        @foreach ($restaurants as $restaurant)
          <tr>
            <td style="vertical-align: middle"> {{$restaurant->business_name}} </td>
            <td style="vertical-align: middle"> {{$restaurant->address}} </td>
            <td style="vertical-align: middle"> {{$restaurant->PIVA}} </td>
            <td style="vertical-align: middle">
              @if (!empty($restaurant->img_path))
                <img class="img-fluid" src="{{ asset('storage/' . $restaurant->img_path) }}" alt="{{ $restaurant->business_name }}">
              @else
                <img class="img-fluid" src="{{ asset('images/restaurantDefault.png') }}" alt="{{ $restaurant->business_name }}">
              @endif
            </td>
            <td style="vertical-align: middle; text-align:center"> <a href="{{ route('admin.deliverboo.show', $restaurant->id) }}" class="btn btn-info"><i class="far fa-eye"></i></a></td>
            <td style="vertical-align: middle; text-align:center"> <a href="{{ route('admin.deliverboo.edit', $restaurant->id) }}" class="btn btn-success"><i class="fas fa-pencil-alt"></i></a> </td>
            <td style="vertical-align: middle; text-align:center">
              <form action="{{ route('admin.deliverboo.destroy', $restaurant->id) }}" method="post" onSubmit="return confirm('Sei sicuro di voler eliminare questo ristorante?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
              </form>
            </td>
            <td style="vertical-align: middle; text-align:center"> <a href="{{ route('admin.menu.index', $restaurant->slug) }}" class="btn btn-success"><i class="fas fa-utensils"></i></a> </td>

          </tr>          
        @endforeach      
      </tbody>
    </table>
  </div>
    
@endsection

