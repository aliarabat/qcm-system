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
        <div class="col s12">
            <table class="centered">
                <thead>
                    <tr>
                        <th>Professeur</th>
                        <th>Semestre</th>
                        <th>Module</th>
                        <th>Date d'affectation</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($semestreModuleProfs->items() as $semModProf)
                    <tr>
                        <td>{{$semModProf->professor->last_name}} {{$semModProf->professor->first_name}}</td>
                        <td>{{$semModProf->semestreModule->module->nom_module}}</td>
                        <td>{{$semModProf->semestreModule->semestre->libelle}}</td>
                        <td>{{$semModProf->updated_at}}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4">Aucune affectation trouvées</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if (count($semestreModuleProfs)>0)
        <div class="col s12 d-flex justify-content-end">
            <ul class="pagination">
                <li class="{{$semestreModuleProfs->onFirstPage()?'disabled':'waves-effect'}}"><a href="{{$semestreModuleProfs->onFirstPage()?'':$semestreModuleProfs->previousPageUrl()}}"><i class="material-icons">chevron_left</i></a></li>
                <li class="{{$semestreModuleProfs->hasMorePages()?'waves-effect':'disabled'}}"><a href="{{$semestreModuleProfs->nextPageUrl()}}"><i class="material-icons">chevron_right</i></a></li>
            </ul>
        </div>
        @endif
    </form>
@endsection

@section('script')
    <script src="{{asset('js/affectations.js')}}"></script>
@endsection