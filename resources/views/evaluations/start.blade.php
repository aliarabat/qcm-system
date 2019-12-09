@extends('layouts.mainlayout')

@section('mainContent')
    <div class="row z-depth-4 mt-p-1">
        <div class="col-s12">
            <h4 class="flow-text center-align">You are about to start the exam! click the button below to start</h4>
            <div class="center-align">
                <a href="{{route('evaluations.start')}}" class="btn-flat waves-effect waves-light deep-orange accent-3 white-text">
                    Start
                    <i class="material-icons right">arrow_forward</i>
                </a>
            </div>
        </div>
    </div>
@endsection