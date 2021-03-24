

@extends('layouts.admin.main')

@section('links')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js" integrity="sha512-d9xgZrVZpmmQlfonhQUvTR7lMPtO7NkZMkA0ABN3PHCbKA5nqylQ/yWlFAyY6hYgdF1Qh6nYiuADWwKB4C2WSw==" crossorigin="anonymous"></script>

@endsection

@section('content')
    <div id="analitics" style="position: relative; width: 50%; height=50%; display: flex, justify-content:center; margin:auto">
        <canvas id="myChart" width="100px" height="100px"></canvas>
    </div>

    <script src="{{ asset('js/statistic.js') }}" defer></script>

@endsection
