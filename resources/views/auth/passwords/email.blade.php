@extends('layouts.mainlayout')

@section('mainContent')

    <div class="row mt-1">
        <div class="col s12 m8 l6 offset-m2 offset-l3 z-depth-4" style="padding: .75em;">
            <form method="POST" action="{{ route('password.email') }}">
                <div class="col s12">
                    <div class="d-flex justify-content-center align-items-center">
                        {{-- <img src="{{asset('images/logo_uca.png')}}" alt="UCA" style="width: 60px; height: 6Opx;"> --}}
                        <h3>{{ __('Reset Password') }}</h2>
                    </div>
                </div>
                @csrf
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <div class="col s12">
                    <div class="input-field">
                        <input id="email" type="email" class="@error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        <label for="email">{{ __('E-Mail Address') }}</label>
                    </div>
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="col s12">
                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn-flat waves-effect waves-light deep-orange accent-3 white-text">
                                {{ __('Send Password Reset Link') }}
                        </button>
                    </div>
                </div>
            </div>    
        </div>
    </div>

@endsection
