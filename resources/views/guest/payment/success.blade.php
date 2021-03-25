@extends('layouts.guest.show')

@section('content')
    <div class="recap_container">
       <div class="info_order_success">
            <h2 style="color: green">{{$newOrder->status}}</h2>
            <h2>{{$business_name}}</h2>
            <p>{{Carbon\Carbon::parse($newOrder->created_at)->format('d-m-Y i')}}</p>
            <p>{{$newOrder->id}}</p>
            <p>Indirizzo di consegna: {{$address}}</p>
            <p>Destinatario: {{ucfirst($newOrder->firstName)}} {{ucfirst($newOrder->lastName)}}</p>
            <p>Metodo di pagamento: Carta di credito</p>
       </div>

       <div class="info_recap_payment">
           @foreach ($dishes as $dish)
           <p>{{$dish->name}} {{$dish->quantity}} {{$dish->price * $dish->quantity}}</p>
           @endforeach
           <p>{{$newOrder->total_amount}}</p>
       </div>
    </div>

    
@endsection