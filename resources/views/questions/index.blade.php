@extends('layouts.mainLayout')

@section('mainContent')

    <div class="row z-depth-4 mt-p-1">
        <!--Niveau-->
        <div id="niveau" class="col s12" >
            <div style="display: flex; align-items: center;">
                <form action="#" method="post" class="col s12" >
                    @csrf  
                    <div class="input-field col s6 ">
                        <select name="module" id="module">
                            <option value="">Selectionner le module</option>
                        </select>
                        <label for="niveauIn">Module</label>
                    </div>
                    <div class="input-field col s6">
                        <select name="chapitre" id="chapitre">
                            <option value="">Selectionner le chapitre</option>
                        </select>
                        <label for="typeIn">Chapitre</label>
                    </div>
                    <div class="col s2 offset-s5">
                        <button type="submit" class="btn waves-effect waves-light btn-flat white-text deep-orange accent3">Créer</button>
                    </div>
                </form>
            </div>
            <!-- list des Niveaux-->
            <div class="row">
                <table class="centered" id="tableNiveaux">
                    <thead>
                        <tr>
                            <th>Question</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Ma</td>
                            <td>
                                <a href="#update-modal" onclick="return onUpdateQuestion()" class="light-blue-text text-darken-4 tooltipped modal-trigger" data-position="top" data-tooltip="Mettre à jour">
                                    <div class="material-icons">edit</div>
                                </a>
                                <a href="#delete-modal" onclick="return onDeleteQuestion()" class="red-text text-accent-4 tooltipped modal-trigger" data-position="top" data-tooltip="Supprimer">
                                    <div class="material-icons">delete</div>
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- END - list des Niveaux-->
        </div>
    </div>


    <div id="update-modal" class="modal">
        <div class="modal-content">
            <h4>Mise à jour</h4>
            <div class="row">
                <input type="hidden" name="id" value=" ">
                <div class="input-field col s12">
                    <input type="text" name="question" value=""/>
                    <label for="question">Question</label>
                </div>
                <div class="input-field col s6">
                    <input type="text" name="duree" value=" "/>
                    <label for="duree">Durée</label>
                </div>
                <div class="input-field col s6">
                    <select name="difficulte" id="difficulte">
                        <option value="">Facile</option>
                        <option value="">Normale</option>
                        <option value="">Difficile</option>
                    </select>
                    <label for="difficulte">Difficulté</label>
                </div>
                <div class="input-field col s6">
                    <input type="number" name="note" value=""/>
                    <label for="note">Note</label>
                </div>
            </div>
            <div class="row">
                <div id="response0" class="d-flex align-items-center">
                    <div class="input-field col s6 offset-s3">
                        <input type="text" name="proposition[]" id="proposition">
                        <label>Réponse 1</label>
                    </div>
                    <p class="">

                    <input id="hiden" type="hidden" name="reponse[0]" value="0" >
                    <input name="reponse[0]"  type="checkbox" id="check0"  value="1">
                        <label for="check0"></label>
                    </p>
                    <a href="#" onclick="return deleteResponse('response0')" class="red-text text-accent-4">
                        <i class="material-icons ">delete</i>
                    </a>
                </div>
            </div>
            <div id="add-button" class="row center-align">
                <button class="btn-flat waves-effect btn-floating orange accent-3 tooltipped" data-position="right" data-tooltip="Ajouter une réponse">
                    <i class="material-icons">add</i>
                </button>
            </div>
        </div>
        <div class="modal-footer">
            <a class="modal-close waves-effect waves-light btn-flat">Annuler</a>
            <a onclick="return onUpdateQuestion(null, null, null, true)" class="waves-effect waves-light btn-flat deep-orange accent-4 white-text">Mettre à jour</a>
        </div>
    </div>

    <!-- Modal Structure -->
    <div id="delete-modal" class="modal">
        <div class="modal-content">
            <h4>Suppression</h4>
            <p>Voulez-vous vraiment supprimer ce Niveau?</p>
            <input type="hidden"/>
        </div>
        <div class="modal-footer">
            <a class="modal-close waves-effect waves-light btn-flat">Annuler</a>
            <a onclick="return onDeleteQuestion(null, true)" class="waves-effect waves-light btn-flat materialize-red white-text">Supprimer</a>
        </div>
    </div>

@endsection

@section('script')
    <script src="{{asset('js/questions.js')}}"></script>
@endsection
