@extends('layouts.mainlayout')

@section('mainContent')

    <div class="row mt-1">
        <div class="col s12 m8 l6 offset-m2 offset-l3 z-depth-4" style="padding: .75em;">
            <form method="POST" action="{{ route('login') }}">
                <div class="col s12">
                    <div class="d-flex justify-content-center align-items-center">
                        {{-- <img src="{{asset('images/logo_uca.png')}}" alt="UCA" style="width: 60px; height: 6Opx;"> --}}
                        <span>
                            <i class="material-icons large">account_circle</i>
                        </span>
                    </div>
                </div>
                @csrf
                <div class="col s12">
                    <div class="input-field">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus/>
                        <label for="email">{{ __('Email') }}</label>
                    </div>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col s12">
                    <div class="input-field">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                        <label for="password">{{ __('Mot de passe') }}</label>
                    </div>
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col s12 d-flex justify-content-between align-items-baseline">
                    <p >
                        <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}/>
                        <label for="remember">{{ __('Souvenez moi') }}</label>
                    </p>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
                    @endif
                </div>
                <div class="col s12">
                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn-flat waves-effect waves-light deep-orange accent-3 white-text">
                            {{ __('Se connecter') }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection