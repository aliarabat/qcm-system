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
    <link rel="shortcut icon" href="logos/favicon.ico"/>
    <style>
        .brand-logo a i{
            padding-left: 10px;
        }
        .mt-p-1{
            padding: 1em;
            margin-top: 1em;    
        }
        .mr-1{
            margin-right: 1em;
        }
        .ml-1{
            margin-left: 1em;
        }
        .mt-1{
            margin-top: 1em;
        }
        .mb-1{
            margin-bottom: 1em;
        }
        .m-1{
            margin: 1em;
        }
        .p-1{
            padding: 1em;
        }
        .d-flex{
            display: flex;
        }
        .flex-column{
            flex-direction: column;
        }
        .justify-content-start{
            justify-content: flex-start;
        }
        .justify-content-center{
            justify-content: center;
        }
        .justify-content-end{
            justify-content: flex-end;
        }
        .justify-content-between{
            justify-content: space-between;
        }
        .justify-content-around{
            justify-content: space-around;
        }
        .align-items-start{
            align-items: flex-start;
        }
        .align-items-center{
            align-items: center;
        }
        .align-items-end{
            align-items: flex-end;
        }
        .align-items-baseline{
            align-items: baseline;
        }
        .align-items-stretch{
            align-items: stretch;
        }
        .align-content-start{
            align-content: flex-start;
        }
        .align-content-center{
            align-content: center;
        }
        .align-content-end{
            align-content: flex-end;
        }
        .align-content-around{
            align-content: space-around;
        }
        .align-content-between{
            align-content: space-between;
        }
        .align-content-stretch{
            align-content: stretch;
        }
        #delete1,#modal1{
            width: 35% !important;
        }
        /* Extra small devices (phones, 600px and down) */
        @media only screen and (max-width: 600px) {
            #delete1,#modal1{
                width: 90% !important;
            }
        } 

        /* Small devices (portrait tablets and large phones, 600px and up) */
        @media only screen and (min-width: 600px) {
            #delete1,#modal1{
                width: 70% !important;
            }
        } 

        /* Medium devices (landscape tablets, 768px and up) */
        @media only screen and (min-width: 768px) {
            #delete1, #modal1{
                width: 50% !important;
            }
        } 

        /* Large devices (laptops/desktops, 992px and up) */
        @media only screen and (min-width: 992px) {
            #delete1, #modal1{
                width: 40% !important;
            }
        } 

        /* Extra large devices (large laptops and desktops, 1200px and up) */
        @media only screen and (min-width: 1200px) {
            #delete1, #modal1{
                width: 40% !important;
            }
        }
        .modal .modal-content{
            padding: 24px 24 0px 24px;
        }
        .pagination li.answered{
            background-color: green;
        }
        .progress{
            background-color: #f3cbbf !important;
        }
        .progress .determinate{
            background-color: #ff3d00 !important;
        }
        .pagination li.active{
            background-color: #d50000;
        }
        .collapsible .collapsible-body a{
            margin-left: 2em;
            color: #ff3d00;
            transition-duration: 500ms;
        }
        .collapsible .collapsible-body a:hover{
            margin-left: 3em;
        }
    </style>
</head>
<body>
        @if(\Illuminate\Support\Facades\Auth::check())
        <ul id="slide-out" class="side-nav collapsible" data-collapsible="accordion">
            <li><div class=" collapsible-header"><i class="material-icons">dashboard</i>QCM</div>
            @can(['create'], App\Question::class)
                <div class="collapsible-body"><a href="{{route('questions.create')}}">Création des questions</a></div>
            @endcan
            <div class="collapsible-body"><a href="{{route('questions.edit')}}">Editer la question</a></div>
            @can('create', App\Niveau::class)
                <div class="collapsible-body"><a href="{{route('mainParts.create')}}">Plan pédagogique</a></div>
            @endcan
            </li>
            <li><div class=" collapsible-header"><i class="material-icons">work</i>Evaluations</div>
            <div class="collapsible-body"><a href="{{route('evaluations.create')}}">Création</a></div>
            <div class="collapsible-body"><a href="{{route('evaluations.index')}}">Commencer</a></div>
            <div class="collapsible-body"><a href="{{route('evaluations.start')}}">Evaluer</a></div>
            </li>
            <li><div class=" collapsible-header"><i class="material-icons">supervisor_account</i>Professeurs</div>
            <div class="collapsible-body"><a href="{{route('professors.create')}}">Création</a></div>
            </li>
            <li><div class=" collapsible-header"><i class="material-icons">supervised_user_circle</i>Etudiants</div>
            <div class="collapsible-body"><a href="{{route('students.create')}}">Création</a></li>
            </li>
            </ul>
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
            {{-- <div>
                <a href="#!" class="breadcrumb">First</a>
                <a href="#!" class="breadcrumb">Second</a>
                <a href="#!" class="breadcrumb">Third</a>
            </div> --}}
        </div>
            <ul class="right">
                <!-- Authentication Links -->
                @guest
                    <li class="">
                        <a class="" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="">
                            <a class="" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="">
                        <a id="" class="" href="#"  >
                            {{ Auth::user()->name }} <span class=""></span>
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
<script src="{{ asset('js/materialize.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/createquestion.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/app.js') }}" type="text/javascript"></script>
@yield('script')
@yield('messages')
        <script>
            $(document).ready(function(){
    $('.collapsible').collapsible();
  });
        </script>
</body>
</html>
