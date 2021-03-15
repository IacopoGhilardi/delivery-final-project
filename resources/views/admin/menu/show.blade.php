@extends('layouts.admin.main')

@section('content')

  <h1>Questo piatto</h1>
  <ul>
    @foreach ($restaurant->dishes as $dish)
        <li>{{$dish->name}}</li>
    @endforeach
  </ul>

@endsection