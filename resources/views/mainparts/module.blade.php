@extends('layouts.mainLayout')
@section('mainContent')
    <div class="row z-depth-4 mt-p-1">
        <!--Module-->
        <div id="module" class="col s12">

            <div style="display: flex; align-items: center;">
                <form id="module-form" method="post" class="col s12">
                    @csrf
                    <div class="row">
                        <div class="input-field col s6">
                            <input type="hidden" id="routeFiliereModule" value="{{route('mainParts.module.semestresFiliere')}}">
                            <select name="filiereModule" id="filiereModule" >
                                <option value="m1" selected disabled>Filière</option>
                                @forelse ($filieres as $filiere)
                                    <option value="{{$filiere->nom_filiere}}">{{$filiere->nom_filiere}}-{{$filiere->libelle}}</option>
                                @empty
                                @endforelse
                            </select>
                            <label>Filière</label>
                            <span class="error"><p id="nameFiliere_error"></p></span>
                        </div>
                        <div class="input-field col s6 ">
                            <select name="semestreFiliere" id="semestreFiliere">
                            </select>
                            <label for="semestreFiliere">Semestres</label>
                            <span class="error"><p id="nameSemestreFiliere_error"></p></span>

                        </div>


                    </div>
                    <div class="row">
                        <div class="input-field col s6 ">
                            <input id="moduleIn" name="nom_module" type="text"/>
                            <label for="moduleIn">Module</label>
                        </div>


                        <div class="input-field col s6">
                            <input id="libelleModuleIn" name="libelleModule" type="text"/>
                            <label for="libelleModuleIn">Libellé</label>
                        </div>


                    </div>

                    <div class="col s2 offset-s5">
                        <button id="moduleSubmit" type="submit" value="{{route('mainParts.module.createModule')}}"
                                class="btn waves-effect waves-light btn-flat white-text deep-orange accent3 text-accent-4">
                            Créer
                        </button>
                    </div>
                </form>

            </div>
            <br>
            <!-- list des Modules-->
            <div class="row">
                <table class="centered" id="tableModules">
                    <thead>
                    <tr>
                        <th>Filière</th>
                        <th>Module</th>
                        <th>Actions</th>
                    </tr>
                    </thead>

                    <tbody>
                    @forelse ($assocSemestreModule as $assoc)
                        <tr>
                            <td>{{App\Filiere::find(App\Semestre::find($assoc->semestre_id)->filiere_id)->nom_filiere}}-{{App\Semestre::find($assoc->semestre_id)->libelle}}</td>
                            <td>{{App\Module::find($assoc->module_id)->nom_module}}</td>
                            <td>
                                <a href="#modal3"
                                   onclick='return onUpdateModule({{$assoc->module_id}},"{{App\Module::find($assoc->module_id)->nom_module}}","{{App\Module::find($assoc->module_id)->libelle}}",false)'
                                   class="light-blue-text text-darken-4 tooltipped modal-trigger" data-position="top"
                                   data-tooltip="Mettre à jour">
                                    <div class="material-icons">edit</div>
                                </a>
                                <a href="#delete3" onclick="return onDeleteModule({{$assoc->module_id}},false)"
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
            <!-- End list des Modules-->

        </div>
    </div>
@endsection

<!-- Modals-->
<!-- Update Module-->
<div id="modal3" class="modal">
    <div class="modal-content">
        <h4>Mise à jour</h4>
        <div class="row">
            <input type="hidden" name="id" value=" ">

            <div class="input-field col s12">
                <input type="text" name="updatedModule" value=" "/>
                <label for="module">Module</label>
            </div>
            <div class="input-field col s12">
                <input type="text" name="updatedlibelleModule" value=" "/>
                <label for="libelle">Libellé</label>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <a class="modal-close waves-effect waves-light btn-flat">Annuler</a>
        <a onclick="return onUpdateModule(null,null, null,true)"
           class="waves-effect waves-light btn-flat deep-orange accent-4 white-text">Mettre à jour</a>

    </div>
</div>
<!-- Delete Module-->
<div id="delete3" class="modal">
    <div class="modal-content">
        <h4>Suppression</h4>
        <p>Voulez-vous vraiment supprimer ce Module?</p>
        <input type="hidden"/>
    </div>
    <div class="modal-footer">
        <a class="modal-close waves-effect waves-light btn-flat">Annuler</a>
        <a onclick="return onDeleteModule(null, true)"
           class="waves-effect waves-light btn-flat materialize-red white-text">Supprimer</a>
    </div>
</div>


@section('script')
    <script src="{{asset('js/module.js')}}"></script>
@endsection
