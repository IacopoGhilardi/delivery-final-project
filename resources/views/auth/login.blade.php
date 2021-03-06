@extends('layouts.guest.main')

<!-- style css-->
@section('links')
  <link rel="stylesheet" href="{{asset('css/loginRegisterLayout.css')}}"> 
@endsection


@section('content')
<div class="container ">
 
    <div class="row justify-content-center align-items-center pt-4">
        <div class="col-md-8">
            <div class="card card_shadow card_on_login">
                <div class="card-header text-center">{{ __('Accedi') }}</div>
                
                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-12 text-center col-form-label ">{{ __('Indirizzo E-Mail') }}</label>

                            <div class="col align-self-center ">
                                <input id="email" type="email" class="col-md-8 offset-md-2 form-control  @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-12 text-center col-form-label ">{{ __('Password') }}</label>

                            <div class="col align-self-center ">
                                <input id="password" type="password" class="col-md-8 offset-md-2 form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input text-center" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label " for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-2 text-center">
                                <a class="btn bounce-change" href="{{route('guest.homepage')}}">Torna alla home</a>
                                <button type="submit" class="btn bounce-change ">
                                    {{ __('Accedi') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Hai dimenticato la password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
