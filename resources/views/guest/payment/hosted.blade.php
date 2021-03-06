@extends('layouts.guest.payment')

@section('links')
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <style>
      .spacer {
          margin-bottom: 24px;
      }
      #card-number, #cvv, #expiration-date {
          background: white;
          height: 38px;
          border: 1px solid #CED4DA;
          padding: .375rem .75rem;
          border-radius: .25rem;
      }
  </style>

  <link rel="stylesheet" href="{{ asset('css/paymentLayout.css') }}">
  <link rel="stylesheet" href="{{ asset('css/hosted.css') }}">
@endsection

@section('loader')
  <div class="loader">
    <div>
      <img src="{{ asset('images/logo/loader.gif') }}" alt="">
    </div>
  </div>
@endsection

      @section('content')
        <div class="container">
          
          @if (session()->has('success_message'))
              <div class="alert alert-success">
                  {{ session()->get('success_message') }}
              </div>
          @endif

          @if(count($errors) > 0)
              <div class="alert alert-danger">
                  <ul>
                      @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                      @endforeach
                  </ul>
              </div>
          @endif
        </div>

        <div class="container payment_container">
          <div class="col-md-12 payment_wrapper">
              <div class="spacer"></div>

              <form class="col-lg-8 payment_form" action="{{ route('guest.order.payment.result') }}" method="POST" id="payment-form">
                  @csrf
                  @method('POST')

                  <div class="row first_row">
                    <div class="col-md-12 restaurant_title">
                      <h1>Manca poco!</h1>
                    </div>
                    <div class="col-md-12 d-flex restaurant_info_container">
                      <div class="restaurant_img">
                        <img src="{{ asset('storage/'. $restaurant->img_path) }}" alt="restaurant">
                      </div>
                      <div class="restaurant_info">
                        <p>{{ $restaurant->business_name }}</p>
                        <span>{{ $restaurant->address }}</span>
                      </div>
                    </div>
                  </div>

                  <div class="row second_row">
                    <div class="col-md-12 info_consegna">
                      <h3>Informazioni di consegna:</h3>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                          <label for="firstName">Nome</label>
                          <input type="text" class="form-control" id="firstName" name="firstName" required>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group">
                          <label for="lastName">Cognome</label>
                          <input type="text" class="form-control" id="lastName" name="lastName" required>
                      </div>
                    </div>
                  </div>
                
                  <div class="form-group">
                      <label for="email">Email</label>
                      <input type="email" class="form-control" id="email" name="email" required>
                  </div>
                  
                  <div class="row">
                    <div class="col-md-8">
                      <div class="form-group">
                        <label for="address">Indirizzo di consegna</label>
                        <input type="text" class="form-control" id="address" name="address" required>
                      </div>
                    </div>
                    

                    <div class="col-md-4">
                      <div class="form-group">
                          <label for="phone">Telefono</label>
                          <input type="text" class="form-control" id="phone" name="phone" required>
                    </div>
                  </div>

                  </div>
              

                  <div class="form-group">
                      <label for="name_on_card">Nome sulla carta</label>
                      <input type="text" class="form-control" id="name_on_card" name="name_on_card" required>
                  </div>

                  <div class="row">
                      <div class="col-md-6">
                          <div class="form-group">
                              <h4>Totale: {{ $data["finalPrice"] }}&euro;</h4>
                              <input type="hidden" class="form-control" id="amount" name="amount" value="{{ $data["finalPrice"] }}">
                          </div>
                      </div>
                  </div>

                  
                  <div class="row">
                      <div class="col-md-6">
                          <label for="cc_number">Numero Carta</label>

                          <div class="form-group" id="card-number">

                          </div>
                      </div>

                      <div class="col-md-3">
                          <label for="expiry">Scadenza</label>

                          <div class="form-group" id="expiration-date">

                          </div>
                      </div>

                      <div class="col-md-3">
                          <label for="cvv">CVV</label>

                          <div class="form-group" id="cvv">

                          </div>
                      </div>

                  </div>
                  <input type="hidden" name="dishesId" value="{{ json_encode($data["dishes"], TRUE) }}">
                  <input type="hidden" name="numberOfDishes" value="{{ json_encode($data["numberOfDishes"]) }}">
                  <input type="hidden" name="restaurant" value="{{$restaurant}}">

                  <div class="spacer"></div>

                  <div id="paypal-button"></div>

                  <div class="spacer"></div>

                  <input id="nonce" name="payment_method_nonce" type="hidden" />
                  <button type="submit" class="btn btn-success" id="proceed">Procedi</button>
              </form>

              <div class="cart_recap col-lg-4">
                <div class="d-flex justify-content-between recap_order_title">
                  <h2 id="order_title">Il tuo ordine</h2>
                  <div class="d-flex align-items-center">
                    <form action="{{ route('guest.restaurant.show') }}" method="post">
                      @csrf
                      @method('POST')
                      <input name="business_name" type="hidden" value="{{$data['business_name']}}">
                      <button type="submit" href="#"><i class="fas fa-pencil-alt"></i></button>
                    </form>
                  </div>
                </div>


                <div class="menu">
                  <div class="orders">
                    @foreach ($data["orders"] as $key => $order)
                    <div class="recap_order">
                      <div class="recap_dish">
                        <span>x{{ $data["numberOfDishes"][$key] }}</span>
                        <span>{{ $order }}</span>
                      </div>
                      <span>{{ $data["dishPrices"][$key] }}&euro;</span>
                    </div>
                    @endforeach
                  </div>
                  <h4>Totale: {{ $data["finalPrice"] }}&euro;</h4>
                </div>
              </div>
          </div>
      </div>
      @endsection

      @section('scripts')
        <script src="https://js.braintreegateway.com/web/3.38.1/js/client.min.js"></script>
        <script src="https://js.braintreegateway.com/web/3.38.1/js/hosted-fields.min.js"></script>
    
        <!-- Load PayPal's checkout.js Library. -->
        <script src="https://www.paypalobjects.com/api/checkout.js" data-version-4 log-level="warn"></script>
    
        <!-- Load the PayPal Checkout component. -->
        <script src="https://js.braintreegateway.com/web/3.38.1/js/paypal-checkout.min.js"></script>
        <script>
          var form = document.querySelector('#payment-form');
          var submit = document.querySelector('input[type="submit"]');
          braintree.client.create({
            authorization: '{{ $token }}'
          }, function (clientErr, clientInstance) {
            if (clientErr) {
              console.error(clientErr);
              return;
            }
            // This example shows Hosted Fields, but you can also use this
            // client instance to create additional components here, such as
            // PayPal or Data Collector.
            braintree.hostedFields.create({
              client: clientInstance,
              styles: {
                'input': {
                  'font-size': '14px'
                },
                'input.invalid': {
                  'color': 'red'
                },
                'input.valid': {
                  'color': 'green'
                }
              },
              fields: {
                number: {
                  selector: '#card-number',
                  placeholder: '4111 1111 1111 1111'
                },
                cvv: {
                  selector: '#cvv',
                  placeholder: '123'
                },
                expirationDate: {
                  selector: '#expiration-date',
                  placeholder: '10/2019'
                }
              }
            }, function (hostedFieldsErr, hostedFieldsInstance) {
              if (hostedFieldsErr) {
                $(".loader").fadeOut();
                console.error(hostedFieldsErr);
                return;
              }
              // submit.removeAttribute('disabled');
              form.addEventListener('submit', function (event) {
                let valid = true;
                let requiredFields = form.querySelectorAll("[required]")
                requiredFields.forEach(function(element) {
                if (!valid) return;
                if (!element.value) valid = false;
                });
                console.log(valid);
                if (valid) {
                  $(".loader").fadeIn();
                }
                event.preventDefault();
                hostedFieldsInstance.tokenize(function (tokenizeErr, payload) {
                  if (tokenizeErr) {
                    console.error(tokenizeErr);
                    $(".loader").fadeOut();
                    return;
                  }
                  // If this was a real integration, this is where you would
                  // send the nonce to your server.
                  // console.log('Got a nonce: ' + payload.nonce);
                  document.querySelector('#nonce').value = payload.nonce;
                  form.submit();
                });
              }, false);
            });
            // Create a PayPal Checkout component.
            braintree.paypalCheckout.create({
                client: clientInstance
            }, function (paypalCheckoutErr, paypalCheckoutInstance) {
            // Stop if there was a problem creating PayPal Checkout.
            // This could happen if there was a network error or if it's incorrectly
            // configured.
            if (paypalCheckoutErr) {
              console.error('Error creating PayPal Checkout:', paypalCheckoutErr);
              return;
            }
            // Set up PayPal with the checkout.js library
            paypal.Button.render({
              env: 'sandbox', // or 'production'
              commit: true,
              payment: function () {
                return paypalCheckoutInstance.createPayment({
                  // Your PayPal options here. For available options, see
                  // http://braintree.github.io/braintree-web/current/PayPalCheckout.html#createPayment
                  flow: 'checkout', // Required
                  amount: 11.00, // Required
                  currency: 'USD', // Required
                });
              },
              onAuthorize: function (data, actions) {
                return paypalCheckoutInstance.tokenizePayment(data, function (err, payload) {
                  // Submit `payload.nonce` to your server.
                  document.querySelector('#nonce').value = payload.nonce;
                  form.submit();
                });
              },
              onCancel: function (data) {
                console.log('checkout.js payment cancelled', JSON.stringify(data, 0, 2));
              },
              onError: function (err) {
                console.error('checkout.js error', err);
              }
            }, '#paypal-button').then(function () {
              // The PayPal button will be rendered in an html element with the id
              // `paypal-button`. This function will be called when the PayPal button
              // is set up and ready to be used.
            });
            });
          });
        </script>
      @endsection
</html>