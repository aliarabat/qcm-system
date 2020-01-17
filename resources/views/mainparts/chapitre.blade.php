@extends('layouts.mainLayout')
@section('mainContent')
    <div class="row z-depth-4 mt-p-1">
        <!--Chapitre-->
        <div id="chapitre" class="col s12">
            <div style="display: flex; align-items: center;">
                <form id="chapitre-form" method="post" class="col s12">
                    @csrf
                    <div class="row">
                        <div class="input-field col s6">
                            <input type="hidden" id="routeFiliereChapitre" value="{{route('mainParts.chapitre.modulesFiliere')}}">
                            <select name="filiereChapitre" id="filiereChapitre">
                                <option value="m1" selected disabled>Filière</option>
                                @forelse ($filieres as $filiere)
                                    <option value="{{$filiere->nom_filiere}}">{{$filiere->nom_filiere}}-{{$filiere->libelle}}</option>
                                @empty
                                @endforelse
                            </select>
                            <label>Filière</label>
                            <span class="error"><p id="nameFiliereChapitre_error"></p></span>
                        </div>
                        <div class="input-field col s6" id="moduleChapitre">
                            <select name="moduleChapitre">

                            </select>
                            <label>Module</label>
                            <span class="error"><p id="nameModule_error"></p></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s6 offset-s3 ">
                            <input id="chapitreIn" name="nom_chapitre" type="text"/>
                            <label for="chapitreIn">Chapitre</label>
                        </div>
                    </div>
                    <div class="col s2 offset-s5">
                        <button id="chapitreSubmit" type="submit" value="{{route('mainParts.chapitre.createChapitre')}}"
                                class="btn waves-effect waves-light btn-flat white-text deep-orange accent3 text-accent-4">
                            Créer
                        </button>
                    </div>
                </form>
            </div>
            <div class="row">
                <br>
                <!-- list des Chapitres-->
                <table class="centered" id="tableChapitres">
                    <thead>
                    <tr>
                        <th>Module</th>
                        <th>Chapitre</th>
                        <th>Actions</th>
                    </tr>
                    </thead>

                    <tbody>
                    @forelse ($chapitres as $chapitre)
                        <tr>
                            <td>{{App\Module::find($chapitre->module_id)->nom_module}}</td>
                            <td>{{$chapitre->nom_chapitre}}</td>
                            <td>
                                <a href="#modal4"
                                   onclick='return onUpdateChapitre({{$chapitre->id}},"{{$chapitre->nom_chapitre}}",false)'
                                   class="light-blue-text text-darken-4 tooltipped modal-trigger" data-position="top"
                                   data-tooltip="Mettre à jour">
                                    <div class="material-icons">edit</div>
                                </a>
                                <a href="#delete4" onclick="return onDeleteChapitre({{$chapitre->id}},false)"
                                   class="red-text text-accent-4 tooltipped modal-trigger" data-position="top"
                                   data-tooltip="Supprimer">
                                    <div class="material-icons">delete</div>
                                </a>
                            </td>
                        </tr>
                    @empty
                    @endforelse
                    </tbody>
                </table>
            </div>
            <!-- end des Chapitres-->
        </div>
    </div>
@endsection

<!-- Modals-->
<!-- Update niveau -->
<div id="modal4" class="modal">
    <div class="modal-content">
        <h4>Mise à jour</h4>
        <div class="row">
            <input type="hidden" name="id" value=" ">
            <div class="input-field col s12">
                <input type="text" name="updatedChapitre" value=" "/>
                <label for="chapitre">Chapitre</label>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <a class="modal-close waves-effect waves-light btn-flat">Annuler</a>
        <a onclick="return onUpdateChapitre(null, null,true)"
           class="waves-effect waves-light btn-flat deep-orange accent-4 white-text">Mettre à jour</a>
    </div>
</div>


<!-- Delete niveau -->
<div id="delete4" class="modal">
    <div class="modal-content">
        <h4>Suppression</h4>
        <p>Voulez-vous vraiment supprimer ce Chapitre?</p>
        <input type="hidden"/>
    </div>
    <div class="modal-footer">
        <a class="modal-close waves-effect waves-light btn-flat">Annuler</a>
        <a onclick="return onDeleteChapitre(null, true)"
           class="waves-effect waves-light btn-flat materialize-red white-text">Supprimer</a>
    </div>
</div>

@section('script')
    <script src="{{asset('js/chapitre.js')}}"></script>
@endsection
