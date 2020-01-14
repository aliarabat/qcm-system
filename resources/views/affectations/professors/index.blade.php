@extends('layouts.mainLayout')

@section('mainContent')

    <form id="form-professor" class="row z-depth-4 mt-p-1" data-route="{{route('affectationProfessor.store')}}">
        
        <div class="input-field col s6">
            <select name="professor" id="professor">
                <option  value="prof" selected disabled>Professeur</option>
                @forelse ($profs as $prof)
                <option  value="{{$prof->id}}">Pr. {{$prof->last_name}} {{$prof->first_name}}</option>
                @empty
                @endforelse
            </select>
            <label for="professor">Professeur</label>
        </div>
        @include('layouts.forms.affectationform')
        <div class="input-field col s6">
            <select name="module" id="module">
        
            </select>
            <label for="module">Module</label>
        </div>
        <div class="input-field col s6">
            <input type="text" name="annee" id="annee" minlength="4" maxlength="4"/>
            <label for="annee">Année<i style="font-size: 13px">(20XX)</i></label>
        </div>
        <div class="col s12 d-flex justify-content-center">
            <button type="submit" class="btn btn-flat waves-effect waves-light deep-orange accent-3 white-text">Affecter</button>
        </div>
    </form>
@endsection

@section('script')
    <script src="{{asset('js/affectations.js')}}"></script>
@endsection