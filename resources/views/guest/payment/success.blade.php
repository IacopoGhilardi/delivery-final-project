@extends('layouts.guest.payment')

@section('links')
    <link rel="stylesheet" href="{{ asset('css/paymentLayout.css') }}">
    <link rel="stylesheet" href="{{ asset('css/success.css') }}">
@endsection
@section('content')
    <div class="container recap_container" id="success">
        <div class="col-lg-8 left_side">
            <div class="status">
                <h2>Ordine {{$newOrder->status}}</h2>
                <p v-if="orders.status != 'cancellato'">Il tuo ordine arriverà in <span>@{{ countDown }} minuti</span></p>
            </div>
            <div class="recap_info">
                <div class="info_order_success">
                    <h2>Informazioni sul tuo ordine</h2>
                    <div class="col-md-12 d-flex justify-content-between">
                        <p>Ordine numero: <strong>{{$newOrder->id}}</strong></p>
                        <p>Ordine effettuato: <strong>{{Carbon\Carbon::parse($newOrder->created_at)->format('d/m/Y H:i')}}</strong></p>
                    </div>

                    <div class="col-md-12 d-flex">
                        <div class="restaurant_img">
                          <img src="{{ asset('storage/'. $restaurant->img_path) }}" alt="restaurant">
                        </div>
                        <div class="restaurant_info">
                          <p><strong>{{ $restaurant->business_name }}</strong></p>
                          <span><strong>{{ $restaurant->address }}</strong></span>
                        </div>
                      </div>
                    <h3>Informazioni per la consegna</h3>
                     <p>Indirizzo di consegna: {{$address}}</p>
                     <p>Destinatario: {{ucfirst($newOrder->firstName)}} {{ucfirst($newOrder->lastName)}}</p>
                     <p>Metodo di pagamento: Carta di credito</p>
                </div>
            </div>
        </div>
       
        <div class="col-lg-4">
            <div class="cart_recap">
                <h2>Il tuo ordine</h2>
                <p>Consegna presso: <strong>{{ $newOrder->address }}</strong></p>
                @foreach ($dishes as $dish)
                <div class="order_recap">
                    <div class="recap_dish">
                        <span>x {{$dish->quantity}}</span>
                        <span>{{$dish->name}}</span>
                      </div>
                      <span>{{$dish->price * $dish->quantity}}&euro;</span>
                    </div>
                    @endforeach
                <h4>Totale: {{$newOrder->total_amount}}</h4>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/success.js') }}"></script>
@endsection