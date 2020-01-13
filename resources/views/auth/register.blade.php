@extends('layouts.mainlayout')

@section('mainContent')

    <div class="row mt-1">
        <div class="col s12 m8 l6 offset-m2 offset-l3 z-depth-4" style="padding: .75em;">
            <form method="POST" action="{{ route('register') }}">
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
                        <input id="name" type="text" class="@error('name') is-invalid @enderror" name="lastName" value="{{ old('name') }}" required autocomplete="name" autofocus/>
                        <label for="name">{{ __('Last name') }}</label>
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col s12">
                    <div class="input-field">
                        <input id="name" type="text" class="@error('name') is-invalid @enderror" name="firstName" value="{{ old('name') }}" required autocomplete="name" autofocus/>
                        <label for="name">{{ __('First name') }}</label>
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col s12">
                    <div class="input-field">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email"/>
                        <label for="email">{{ __('Email') }}</label>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col s12">
                    <div class="input-field">
                        <input id="password" type="password" class="@error('email') is-invalid @enderror" name="password" value="{{ old('password') }}" required autocomplete="password"/>
                        <label for="email">{{ __('Password') }}</label>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col s12">
                    <div class="input-field">
                        <input id="password-confirm" type="password" name="password_confirmation" required autocomplete="new-password"/>
                        <label for="password-confirm">{{ __('Confirm Password') }}</label>
                    </div>
                </div>
                <div class="col s12">
                    <div class="input-field">
                        <select id="role"  name="role" required autocomplete="role">
                            <option>--SELECT ROLE--</option>
                            @foreach(App\Role::all() as $role)
                                <option value="{{$role->id}}">{{$role->name}}</option>
                            @endforeach
                        </select>
                        <label for="role" class="col-md-4 col-form-label text-md-right">{{ __('Roles') }}</label>
                    </div>
                </div>
                <div class="col s12">
                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn-flat waves-effect waves-light deep-orange accent-3 white-text">
                            {{ __('S\'inscrire') }}
                        </button>
                    </div>
                </div>
            </div>    
        </div>
    </div>
    
@endsection
