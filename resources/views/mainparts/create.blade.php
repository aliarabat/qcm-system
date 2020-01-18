@extends('layouts.mainLayout')

@section('mainContent')

    <div class="row z-depth-4 mt-p-1" style="padding-top: 12%">
        <span style="padding-left: 39.7%;font-size: x-large;padding-bottom: 5%">Plan pédagogique</span>
        <br><br><br>
        <nav style="background-color: white">
            <div class="nav-wrapper col s12">
                <ul id="nav-mobile" class="center hide-on-med-and-down " style="background-color: white">
                    <li class="col s3"><a style="color: orangered" href="{{route('mainParts.niveau')}}">NIVEAU</a></li>
                    <li class="col s3"><a style="color: orangered" href="{{route('mainParts.filiere')}}">FILIÈRE</a>
                    </li>
                    <li class="col s3"><a style="color: orangered" href="{{route('mainParts.module')}}">MODULE</a></li>
                    <li class="col s3"><a style="color: orangered" href="{{route('mainParts.chapitre')}}">CHAPITRE</a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>

@endsection








