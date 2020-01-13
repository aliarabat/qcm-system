@extends('layouts.mainLayout')

@section('mainContent')

    <form id="form-student" class="row z-depth-4 mt-p-1" data-route="{{route('affectationStudent.store')}}">
        <div class="input-field col s6">
            <select name="student" id="student">
        
            </select>
            <label for="student">Etudiant</label>
        </div>
        @include('layouts.forms.affectationform')
        <div class="input-field col s6 offset-s3">
            <input type="text" name="anneeUniversitaire" id="anneeUniversitaire" minlength="9" maxlength="9"/>
            <label for="anneeUniversitaire">Année universitaire <i style="font-size: 13px">(20XX/20XX)</i></label>
        </div>
        <div class="col s12 d-flex justify-content-center">
            <button type="submit" class="btn btn-flat waves-effect waves-light deep-orange accent-3 white-text">Affecter</button>
        </div>
    </form>

@endsection

@section('script')
    <script src="{{asset('js/affectations.js')}}"></script>
@endsection