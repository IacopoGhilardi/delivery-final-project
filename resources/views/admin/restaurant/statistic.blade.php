@extends('layouts.admin.main')

@section('links')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js" integrity="sha512-d9xgZrVZpmmQlfonhQUvTR7lMPtO7NkZMkA0ABN3PHCbKA5nqylQ/yWlFAyY6hYgdF1Qh6nYiuADWwKB4C2WSw==" crossorigin="anonymous"></script>
<link rel="stylesheet" href="{{asset('css/statistic.css')}}">
@endsection

@section('content')
    
    <div id="analitics" class="container">
        <div class="analitics-container" >
            <div class="card card-direction">
                <h3 style="text-transform: uppercase">il più venduto è il piatto: @{{venditaMax}}</h3>
                <img style="width: 50%; " :src="`../../storage/${imgUrlMax}`" alt="">
            </div>
            <div class="canvas-container" >             
               
                <canvas id="myChart" width="100px" height="100px"></canvas>
            </div>
        </div>
        
    
    </div>
    

    <script src="{{ asset('js/statistic.js') }}" defer></script>

@endsection
