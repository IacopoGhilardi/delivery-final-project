@extends('layouts.guest.main')

@section('links')
  <link rel="stylesheet" href="{{asset('css/loginRegisterLayout.css')}}"> 
@endsection


@section('content')
<div class="container">
    <div class="row justify-content-center align-items-center py-5">
        <div class="col-md-8">
            <div class="card card_shadow card_on_register">
                <div class="card-header text-center">{{ __('Registrati') }}</div>

                <div class="card-body">
                    <form  method="POST" action="{{ route('register') }}">
                        @csrf
                        <h2 class="text-center">Dati Utente</h2>
                        <div class="row offset-md-1">
                            <div class="col-md-6  form-group row">
                                <label for="firstName" class="  col-md-9 offset-md-1  text-center col-form-label">{{ __('Nome') }}</label>

                                <div class="col-md-12 align-self-center">
                                    <input id="firstName" type="text" class="col-md-12   of form-control @error('firstName') is-invalid @enderror" name="firstName" value="{{ old('firstName') }}" required autocomplete="firstName" autofocus>

                                    @error('firstName')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 form-group row">
                                <label for="lastName" class="col-md-11 offset-md-1 text-center col-form-label">{{ __('Cognome') }}</label>

                                <div class="col-md-12 align-self-center" >
                                    <input id="lastName" type="text"  class="col-md-12 form-control @error('lastName') is-invalid @enderror"  name="lastName" value="{{ old('lastName') }}" required autocomplete="lastName" autofocus>

                                    @error('lastName')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 form-group row">
                            <label for="email" class="col-md-12 text-center col-form-label">{{ __('Indirizzo E-Mail') }}</label>

                            <div class="col align-self-center">
                                <input id="email" type="email" class="col-md-8 offset-md-2 form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row offset-md-1">
                            <div class="col-md-6 form-group row">
                                <label for="password" class="col-md-12 text-center col-form-label">{{ __('Password') }}</label>

                                <div class="col align-self-center">
                                    <input id="password" type="password" class="col-md-12 form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 form-group row">
                                <label for="password-confirm" class="col-md-12  text-center col-form-label">{{ __('Conferma Password') }}</label>

                                <div class="col align-self-center">
                                    <input id="password-confirm" type="password" class="col-md-12 form-control" name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>
                        </div>
                        
                        {{-- dati ristorante --}}
                        <h2 class="text-center">Dati Ristorante</h2>

                        <div class="form-group row">
                            <label for="business_name" class="col-md-12 text-center col-form-label">{{ __('Nome attività') }}</label>

                            <div class="col align-self-center">
                                <input id="business_name" type="text" class="col-md-8 offset-md-2 form-control @error('business_name') is-invalid @enderror" name="business_name" value="{{ old('business_name') }}" required autocomplete="business_name" autofocus>

                                @error('business_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="PIVA" class="col-md-12 text-center col-form-label">{{ __('P.IVA') }}</label>

                            <div class="col align-self-center">
                                <input id="PIVA" type="text" class="col-md-8 offset-md-2 form-control @error('PIVA') is-invalid @enderror" name="PIVA" value="{{ old('PIVA') }}" required autocomplete="PIVA" autofocus>

                                @error('PIVA')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="address" class="col-md-12 text-center col-form-label">{{ __('Indirizzo') }}</label>

                            <div class="col align-self-center">
                                <input id="address" type="text" class="col-md-8 offset-md-2 form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" required autocomplete="address" autofocus>

                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="address" class="col-md-12 text-center col-form-label">{{ __('Seleziona categoria') }}</label>

                            <div class="offset-md-2 col-8 align-self-center select-cucina">
                                <select name="types[]" class="text-center js-example-basic-multiple" multiple="multiple" style="width: 100%">
                                    @foreach ($types as $type)
                                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                                    @endforeach

                                </select>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-2 text-center">
                                <a class="btn bounce-change" href="{{route('guest.homepage')}}">Torna alla home</a>

                                <button type="submit" class="btn bounce-change">
                                    {{ __('Registrati') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// In your Javascript (external .js resource or <script> tag)
    $(document).ready(function() {
    $('.js-example-basic-multiple').select2();
});
</script>
@endsection
