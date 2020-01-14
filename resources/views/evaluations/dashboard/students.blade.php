@extends('layouts.mainLayout')

@section('mainContent')
    
    <div class="row z-depth-4 mt-p-1">

    @forelse ($qcms as $qcm)
        <div class="col s12 m6">
            <div class="card deep-orange accent-3">
                <div class="card-content white-text">
                    <span class="card-title">{{$qcm->description}}</span>
                    <span><strong>Durée :</strong> {{$qcm->duration}}min</span><br>
                    <span><strong>Préparé par :</strong> Prof.{{$qcm->semestreModuleProfessor->professor->last_name}} {{$qcm->semestreModuleProfessor->professor->first_name}}</span><br>
                    <p>Vous aurez une seule chance de passer cet examen. Si vous êtes prét cliquer sur le bouton ci-dessous.</p>
                </div>
                <div class="card-action">
                    <a href="{{route('evaluations.start', ['id'=>$qcm->id])}}" class="btn btn-flat waves-effect waves-light white-text deep-orange accent-4">Commencer</a>
                </div>
            </div>
        </div>    
    @empty
        <h4 class="flow-text">Aucun qcm trouvé à ce moment</h4>
    @endforelse
    </div>

@endsection