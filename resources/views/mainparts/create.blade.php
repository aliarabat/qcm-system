@extends('layouts.mainLayout')

@section('mainContent')

    <div class="row z-depth-4 mt-p-1">
        <div class="col s12">
            <ul class="tabs deep-orange-text text-accent-3">
                <li class="tab col s3"><a href="{{route('mainParts.niveau')}}">Niveau</a></li>
                <li class="tab col s3"><a href="{{route('mainParts.filiere')}}">Filière</a></li>
                <li class="tab col s3"><a href="{{route('mainParts.module')}}">Module</a></li>
                <li class="tab col s3"><a href="{{route('mainParts.chapitre')}}">Chapitre</a></li>
            </ul>
        </div>
    </div>
@endsection








