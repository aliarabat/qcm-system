<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <title>UCA QCM | Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="{{ asset('css/materialize.min.css') }}" rel="stylesheet" type="text/css"/>
    <link rel="shortcut icon" href="logos/favicon.ico"/>
    <style>
        .brand-logo a i{
            padding-left: 10px;
        }
        .mt-p-1{
            padding: 1em;
            margin-top: 1em;    
        }
    </style>
</head>
<body>
        <ul id="slide-out" class="side-nav">
            <li><a class="subheader">QCM</a></li>
            <li><a class="waves-effect" href="/questions">Création des questions</a></li>
            <li><a class="waves-effect" href="{{route('mainParts.create')}}">Création NFMC</a></li>
        </ul>
    <nav>
        <div class="nav-wrapper deep-orange accent-3">
            <div class="brand-logo left">
                <a href="#" data-activates="slide-out" class="button button-collapse show-on-large">
                    <i class="material-icons">menu</i>
                </a>
                <a href="#">
                    <img src="{{asset('images/fssm.png')}}" alt="UCA Logo" style="width: 100px; height: 50px; filter: brightness(0) invert(1);padding-top: 10px;">
                </a>    
            {{-- <div>
                <a href="#!" class="breadcrumb">First</a>
                <a href="#!" class="breadcrumb">Second</a>
                <a href="#!" class="breadcrumb">Third</a>
            </div> --}}
        </div>
        <ul id="nav-mobile" class="right hide-on-med-and-down">
            <li>
                <a href="#">
                    <i class="material-icons">account_circle</i>
                </a>
            </li>
          </ul>
        </div>
        </nav>

        <div class="container">
            @yield('mainContent')
        </div>

<script src="{{ asset('js/jquery.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/materialize.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/createquestion.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/app.js') }}" type="text/javascript"></script>
</body>
</html>
