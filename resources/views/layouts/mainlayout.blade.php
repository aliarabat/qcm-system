<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8"/>
    <title>UCA QCM | Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="{{ asset('css/materialize.min.css') }}" rel="stylesheet" type="text/css"/>
    @yield('css')
    <link href="{{ asset('css/main.css') }}" rel="stylesheet" type="text/css"/>
    <link rel="shortcut icon" href="logos/favicon.ico"/>
</head>
<body>
        @if(\Illuminate\Support\Facades\Auth::check())
        @include('layouts.sidebar')
        @endif
    <nav>
        <div class="nav-wrapper deep-orange accent-3">
            <div class="brand-logo left">
                @if(\Illuminate\Support\Facades\Auth::check())
                <a href="#" data-activates="slide-out" class="button button-collapse show-on-large" style="margin: 0 0 0 10px;">
                    <i class="material-icons">menu</i>
                </a>
                @endif
                <a href="#">
                    <img src="{{asset('images/fssm.png')}}" alt="UCA Logo" style="width: 100px; height: 50px; filter: brightness(0) invert(1);padding-top: 10px;margin-left: 10px;">
                </a>
        </div>
            <ul class="right">
                <!-- Authentication Links -->
                @guest
                    <li class="">
                        <a class="" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    {{-- @if (Route::has('register'))
                        <li class="">
                            <a class="" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif --}}
                @else
                    <li class="">
                        <a id="" class="" href="#"  >
                            {{ Auth::user()->last_name }} {{ Auth::user()->first_name }} <span class=""></span>
                        </a></li>

                        <li>
                            <a class="" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" >
                                @csrf
                            </form>

                    </li>
                @endguest
            </ul>
        </div>
        </nav>

        <div class="container">
            @yield('mainContent')
        </div>

<script src="{{asset('js/jquery.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
<script src="{{ asset('js/materialize.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('js/loader.js')}}"></script>
<script src="{{ asset('js/createquestion.js')}}" type="text/javascript"></script>
<script src="{{ asset('js/app.js')}}" type="text/javascript"></script>
@yield('script')
@yield('messages')
<script>
    $(document).ready(function(){
        $('.collapsible').collapsible();
    });
</script>
</body>
</html>
