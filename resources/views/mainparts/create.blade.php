@extends('layouts.mainlayout')

@section('mainContent')

    <div class="row z-depth-4 mt-p-1" style="padding-top: 12%">
        <span style="padding-left: 23.5%;padding-bottom: 5%; font-family: 'Raleway',sans-serif; font-size: 50px; font-weight: 800; line-height: 72px; margin: 0 0 24px; text-align: center; text-transform: uppercase; ">Plan pédagogique</span>
        <br><br><br>
        <nav style="background-color: white">
            <div class="nav-wrapper col s12">
                <ul id="nav-mobile" class="center hide-on-med-and-down " style="background-color: white">
                    <li class="col s3"><a style="color: orangered" href="{{route('mainParts.niveau.niveaux')}}">NIVEAUX</a></li>
                    <li class="col s3"><a style="color: orangered" href="{{route('mainParts.filiere')}}">FILIÈRES</a>
                    </li>
                    <li class="col s3"><a style="color: orangered" href="{{route('mainParts.module')}}">MODULES</a></li>
                    <li class="col s3"><a style="color: orangered" href="{{route('mainParts.chapitre')}}">CHAPITRES</a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>

@endsection








