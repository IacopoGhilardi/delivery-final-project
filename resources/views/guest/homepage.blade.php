@extends('layouts.guest.main')

@section('links')
    <link rel="stylesheet" href="{{ asset('css/homepageGuest.css') }}">
@endsection

@section('content')
    <div class="image_hero">
        <img src="https://images.pexels.com/photos/1640777/pexels-photo-1640777.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940" alt="">
        <div class="search_container">
            <div class="slogan">
                <h1>Ordina da noi, Siamo il tuo Pane Quotidiano, Veneraci</h1>
            </div>
            <div class="input_container">
                <div class="input_field">
                    <input class="search" type="text">
                    <input class="submit" type="submit">
                </div>
            </div>
        </div>
    </div>
@endsection