@extends('layouts.mainLayout')
@section('mainContent')


    <div class="col s12 m7">
        <h2 class="header">Ooooops !</h2>
        <div class="card horizontal">

            <div class="card-stacked">
                <div class="card-content">
                    <p>Vous n'êtes pas autorisé de consulter cette page ....</p>
                </div>
                <div class="card-action">
                    <a href="{{route('home')}}">retour</a>
                </div>
            </div>
        </div>
    </div>

@endsection