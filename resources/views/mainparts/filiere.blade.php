@extends('layouts.mainLayout')
@section('mainContent')
    <div class="row z-depth-4 mt-p-1">
        <!--Filiere -->
        <div id="filiere" class="col s12">
            <div style="display: flex; align-items: center;">

                <form id="filiere-form" method="post" class="col s12">
                    @csrf
                    <div class="row">
                        <div class="input-field col s6">
                            <select name="niveauFiliere" id="niveauFiliere">
                                <option value="Niveau" selected disabled>Niveau</option>
                                @forelse ($niveaux as $niveau)
                                    <option value="{{$niveau->niveau}}-{{$niveau->type}}">{{$niveau->niveau}}
                                        {{$niveau->type}}</option>
                                @empty
                                @endforelse
                            </select>
                            <label>Niveau</label>
                            <span class="error"><p id="nameNiveau_error"></p></span>
                        </div>

                        <div class="input-field col s6 ">
                            <input id="filiereIn" name="nom_filiere" type="text"/>
                            <label for="filiereIn">Filière</label>
                        </div>
                    </div>

                    <div class="row">

                        <div class="input-field col s6">
                            <input id="libelleIn" name="libelle" type="text"/>
                            <label for="libelleIn">Libellé</label>
                        </div>

                        <div class="input-field col s6">
                            <input id="semestres" name="semestres" type="number"/>
                            <label for="semestres">Nombre de semestres</label>
                        </div>
                    </div>

                    <div class=" col s2 offset-s5">
                        <button id="filiereSubmit" type="submit" value="{{route('mainParts.filiere.createFiliere')}}"
                                class="btn waves-effect waves-light btn-flat white-text deep-orange accent3 text-accent-4">
                            Créer
                        </button>
                    </div>
                </form>
            </div>
            <br>
            <!-- list des Filieres-->
            <div class="row">
                <table class="centered" id="tableFilieres">
                    <thead>
                    <tr>
                        <th>Niveau</th>
                        <th>Filière</th>
                        <th>Actions</th>
                    </tr>
                    </thead>

                    <tbody>
                    @forelse ($filieres as $filiere)
                        <tr>
                            <td>{{App\Niveau::find($filiere->niveau_id)->niveau}}
                                -{{App\Niveau::find($filiere->niveau_id)->type}}</td>
                            <td>{{$filiere->nom_filiere}}-{{$filiere->libelle}}</td>
                            <td>
                                <a href="#modal2"
                                   onclick='return onUpdateFiliere({{$filiere->id}},"{{App\Niveau::find($filiere->niveau_id)->niveau}}-{{App\Niveau::find($filiere->niveau_id)->type}}","{{$filiere->nom_filiere}}","{{$filiere->libelle}}",false)'
                                   class="light-blue-text text-darken-4 tooltipped modal-trigger" data-position="top"
                                   data-tooltip="Mettre à jour">
                                    <div class="material-icons">edit</div>
                                </a>
                                <a href="#delete2" onclick="return onDeleteFiliere({{$filiere->id}},false)"
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
            <!-- End list des Filieres-->
        </div>
    </div>
@endsection

<!-- Modals-->
<!-- Update filiere-->
<div id="modal2" class="modal">
    <div class="modal-content">
        <h4>Mise à jour</h4>
        <div class="row">
            <input type="hidden" name="id" value=" ">
            <div class="input-field col s12">
                <select name="updatedNiveauFiliere" id="updatedNiveauFiliere">
                    <option value="m1" selected disabled>Niveau</option>
                    @forelse ($niveaux as $niveau)
                        <option value="{{$niveau->id}}">{{$niveau->niveau}}-{{$niveau->type}}</option>
                    @empty
                    @endforelse
                </select>
                <label>Niveau</label>
            </div>
            <div class="input-field col s12">
                <input type="text" name="updatedFiliere" value=" "/>
                <label for="filiere">Filière</label>
            </div>
            <div class="input-field col s12">
                <input type="text" name="updatedlibelleFiliere" value=" "/>
                <label for="libelle">Libellé</label>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <a class="modal-close waves-effect waves-light btn-flat">Annuler</a>
        <a onclick="return onUpdateFiliere(null, null, null,null, true)"
           class="waves-effect waves-light btn-flat deep-orange accent-4 white-text">Mettre à jour</a>
    </div>
</div>
<!-- Delete filiere-->
<div id="delete2" class="modal">
    <div class="modal-content">
        <h4>Suppression</h4>
        <p>Voulez-vous vraiment supprimer cette Filière?</p>
        <input type="hidden"/>
    </div>
    <div class="modal-footer">
        <a class="modal-close waves-effect waves-light btn-flat">Annuler</a>
        <a onclick="return onDeleteFiliere(null, true)"
           class="waves-effect waves-light btn-flat materialize-red white-text">Supprimer</a>
    </div>
</div>


@section('script')
    <script src="{{asset('js/filiere.js')}}"></script>
@endsection
