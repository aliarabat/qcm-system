@extends('layouts.mainlayout')

@section('mainContent')

    <form id="form-student" class="row z-depth-4 mt-p-1" data-route="{{route('affectationStudent.store')}}">
        <div class="input-field col s6">
            <select name="student" id="student">
                <option  value="prof" selected disabled>Etudiant</option>
                @forelse ($students as $student)
                <option  value="{{$student->id}}">{{$student->last_name}} {{$student->first_name}}</option>
                @empty
                @endforelse
            </select>
            <label for="student">Etudiant</label>
        </div>
        @include('layouts.forms.affectationform')
        <div class="input-field col s6 offset-s3">
            <input type="text" name="annee" id="annee" minlength="4" maxlength="4"/>
            <label for="anneeUniversitaire">Année<i style="font-size: 13px">(20XX)</i></label>
        </div>
        <div class="col s12 d-flex justify-content-center">
            <button type="submit" class="btn btn-flat waves-effect waves-light deep-orange accent-3 white-text">Affecter</button>
        </div>
        <div class="col s12">
            <table id="affectationStudent" class="centered">
                <thead>
                    <tr>
                        <th>Etudiant</th>
                        <th>Semestre</th>
                        <th>Date d'affectation</th>
                        <th>Désaffecter</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($studentSemestres->items() as $stuSem)
                    <tr>
                        <td>{{$stuSem->student->last_name}} {{$stuSem->student->first_name}}</td>
                        <td>{{$stuSem->semestre->libelle}}</td>
                        <td>{{$stuSem->updated_at}}</td>
                        <td>
                            <a href="#modal1" onclick="return onDesafecter({{$stuSem->id}},false)" class="red-text text-accent-4 tooltipped modal-trigger" data-position="top" data-tooltip="Désaffecter">
                                <div class="material-icons">edit</div>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5">Aucune affectation trouvées</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if (count($studentSemestres)>0)
        <div class="col s12 d-flex justify-content-end">
            <ul class="pagination">
                <li class="{{$studentSemestres->onFirstPage()?'disabled':'waves-effect'}}"><a href="{{$studentSemestres->onFirstPage()?'':$studentSemestres->previousPageUrl()}}"><i class="material-icons">chevron_left</i></a></li>
                <li class="{{$studentSemestres->hasMorePages()?'waves-effect':'disabled'}}"><a href="{{$studentSemestres->nextPageUrl()}}"><i class="material-icons">chevron_right</i></a></li>
            </ul>
        </div>
        @endif
    </form>

    <div id="modal1" class="modal">
        <div class="modal-content">
            <h4>Désaffecter étudiant</h4>
            <p>Voulez-vous vraiment désaffecter cet étudiant?</p>
            <input type="hidden"/>
        </div>
        <div class="modal-footer">
            <a class="modal-close waves-effect waves-light btn-flat">Annuler</a>
            <a onclick="return onDesafecter(null,true)" class="waves-effect waves-light btn-flat deep-orange accent-4 white-text">Désaffecter</a>

        </div>
    </div>

@endsection

@section('script')
    <script src="{{asset('js/affectations.js')}}"></script>
@endsection


