@extends('layouts.admin.main')

@section('links')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js" integrity="sha512-d9xgZrVZpmmQlfonhQUvTR7lMPtO7NkZMkA0ABN3PHCbKA5nqylQ/yWlFAyY6hYgdF1Qh6nYiuADWwKB4C2WSw==" crossorigin="anonymous"></script>
<link rel="stylesheet" href="{{asset('css/statistic.css')}}">
@endsection

@section('content')
    
    <div id="analitics" class="container mt-4">
        <div class="my-4 card-direction">
            <div class="card_div">
                <div v-if=" venditaMax.length != 1 ">
                    <div>
                       <h5 >il piatto più acquistato :</h5>
                        <h5> @{{venditaMax}}</h5>
                    </div>
                    
                </div>                
                <h6>Totale acquisti :  @{{dishMaxSell}} </h6>
            </div>
            
            <div class="card_div">
                <p class="coscia">
                    <i class="fas fa-drumstick-bite"></i>
                </p>
                
            </div>
            
            {{--! <img style="width: 50%; " :src="`../../storage/${imgUrlMax}`" alt=""> --}}
        </div>
        
        <div class="analitics-container" >
           
            <div  class="canvas-container" >    
                <h2>Fatturato Totale</h2> 
                <div>
                    <select @change="onChangeYears($event)" style="min-width: 100px" name="anni" id="">
                        <option value="All"> Tutti gli anni </option>
                        <option style="min-width: 100px" v-for="year in years" :value="year"> @{{year}}</option>
                    </select>
                    <select @change="onChangeMonth($event)" style="min-width: 100px" name="mesi" id="">
                        <option value="All">Tutti i mesi </option>
                        <option style="min-width: 100px" v-for="month in months" :value="month"> @{{month}}</option>
                    </select>
                </div>        
               
                <canvas id="myChart" width="400" height="400"></canvas>
            </div>
        </div>
        
    
    </div>


    <a href="{{ route('admin.restaurant.index') }}" class="btn btn-primary btn_circle my-5">
        {{-- Indietro --}}
        <i class="fas fa-arrow-left"></i>
    </a>

    <script src="{{ asset('js/statistic.js') }}" defer></script>

@endsection
