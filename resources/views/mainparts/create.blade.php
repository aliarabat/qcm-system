@extends('layouts.mainLayout')

@section('mainContent')

    <div class="row z-depth-4 mt-p-1">
        <div class="col s12">
            <ul class="tabs deep-orange-text text-accent-3">
              <li class="tab col s3"><a class="active" href="#niveau">Niveau</a></li>
              <li class="tab col s3"><a href="#filiere">Filière</a></li>
              <li class="tab col s3"><a href="#module">Module</a></li>
              <li class="tab col s3"><a href="#chapitre">Chapitre</a></li>
            </ul>
        </div>
        <div id="niveau" class="col s12">
            <div style="display: flex; align-items: center;">
                <div class="input-field col s5">
                    <input type="text"/>
                    <label for="">Niveau</label>
                </div>
                <div class="input-field col s5">
                    <input type="text"/>
                    <label for="">Type</label>
                </div>
                <div class="col s2">
                    <button class="btn waves-effect waves-light btn-flat white-text deep-orange accent3">Créer</button>
                </div>
            </div>
            <div class="row">
                <table class="centered">
                    <thead>
                        <tr>
                            <th>Niveau</th>
                            <th>Type</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
            
                    <tbody>
                        <tr>
                            <td>Licence</td>
                            <td>Professionnelle</td>
                            <td>
                                <a href="#modal1" class="light-blue-text text-darken-4 tooltipped modal-trigger" data-position="top" data-tooltip="Mettre à jour">
                                    <div class="material-icons">edit</div>
                                </a>
                                <a href="#delete1" class="red-text text-accent-4 tooltipped modal-trigger" data-position="top" data-tooltip="Supprimer">
                                    <div class="material-icons">delete</div>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td>Master</td>
                            <td>Recherche</td>
                            <td>
                                <a href="#" class="light-blue-text text-darken-4 tooltipped" data-position="top" data-tooltip="Mettre à jour">
                                    <div class="material-icons">edit</div>
                                </a>
                                <a href="#" class="red-text text-accent-4 tooltipped" data-position="top" data-tooltip="Supprimer">
                                    <div class="material-icons">delete</div>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td>Licence</td>
                            <td>Fondamentale</td>
                            <td>
                                <a href="#" class="light-blue-text text-darken-4 tooltipped" data-position="top" data-tooltip="Mettre à jour">
                                    <div class="material-icons">edit</div>
                                </a>
                                <a href="#" class="red-text text-accent-4 tooltipped" data-position="top" data-tooltip="Supprimer">
                                    <div class="material-icons">delete</div>
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div id="filiere" class="col s12">
            <div style="display: flex; align-items: center;">
                <div class="input-field col s5">
                    <select>
                        <option value="m1" selected>N1</option>
                        <option value="m2">N2</option>
                        <option value="m3">N3</option>
                    </select>
                    <label>Niveau</label>
                </div>
                <div class="input-field col s5">
                    <input type="text">
                    <label>Filière</label>
                </div>
                <div class="col s2">
                    <button class="btn waves-effect waves-light btn-flat white-text deep-orange accent3 text-accent-4">Créer</button>
                </div>
            </div>
            <div class="row">
                <table class="centered">
                    <thead>
                        <tr>
                            <th>Niveau</th>
                            <th>Filière</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
            
                    <tbody>
                        <tr>
                            <td>Master</td>
                            <td>ISI</td>
                            <td>
                                <a href="#modal1" class="light-blue-text text-darken-4 tooltipped modal-trigger" data-position="top" data-tooltip="Mettre à jour">
                                    <div class="material-icons">edit</div>
                                </a>
                                <a href="#" class="red-text text-accent-4 tooltipped" data-position="top" data-tooltip="Supprimer">
                                    <div class="material-icons">delete</div>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td>License</td>
                            <td>SMI</td>
                            <td>
                                <a href="#" class="light-blue-text text-darken-4 tooltipped" data-position="top" data-tooltip="Mettre à jour">
                                    <div class="material-icons">edit</div>
                                </a>
                                <a href="#" class="red-text text-accent-4 tooltipped" data-position="top" data-tooltip="Supprimer">
                                    <div class="material-icons">delete</div>
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div id="module" class="col s12">
            <div  style="display: flex; align-items: center;">
                <div class="input-field col s5">
                    <select>
                        <option value="" disabled>Selectionner la filière</option>
                        <option value="m1">F1</option>
                        <option value="m2">F2</option>
                        <option value="m3">F3</option>
                    </select>
                    <label>Filière</label>
                </div>
                <div class="input-field col s5">
                    <input type="text">
                    <label>Module</label>
                </div>
                <div class="col s2">
                    <button class="btn waves-effect waves-light btn-flat white-text deep-orange accent3">Créer</button>
                </div>
            </div>
            <div class="row">
                <table class="centered">
                    <thead>
                        <tr>
                            <th>Filière</th>
                            <th>Module</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
            
                    <tbody>
                        <tr>
                            <td>ISI</td>
                            <td>SI</td>
                            <td>
                                <a href="#modal1" class="light-blue-text text-darken-4 tooltipped modal-trigger" data-position="top" data-tooltip="Mettre à jour">
                                    <div class="material-icons">edit</div>
                                </a>
                                <a href="#" class="red-text text-accent-4 tooltipped" data-position="top" data-tooltip="Supprimer">
                                    <div class="material-icons">delete</div>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td>SD</td>
                            <td>Machine Learning</td>
                            <td>
                                <a href="#" class="light-blue-text text-darken-4 tooltipped" data-position="top" data-tooltip="Mettre à jour">
                                    <div class="material-icons">edit</div>
                                </a>
                                <a href="#" class="red-text text-accent-4 tooltipped" data-position="top" data-tooltip="Supprimer">
                                    <div class="material-icons">delete</div>
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div id="chapitre" class="col s12">
            <div class="input-field col s4">
                <select>
                    <option value="" disabled>Selectionner la filière</option>
                    <option value="m1">F1</option>
                    <option value="m2">F2</option>
                    <option value="m3">F3</option>
                </select>
                <label>Filière</label>
            </div>
            <div class="input-field col s4">
                <select>
                    <option value="" disabled>Selectionner le module</option>
                    <option value="m1">F1</option>
                    <option value="m2">F2</option>
                    <option value="m3">F3</option>
                </select>
                <label>Module</label>
            </div>
            <div class="input-field col s4">
                <input type="text">
                <label>Chapitre</label>
            </div>
            <div class="col s2 offset-s5">
                <button class="btn waves-effect waves-light btn-flat white-text deep-orange accent3">Créer</button>
            </div>
            <div class="row">
                <table class="centered">
                    <thead>
                        <tr>
                            <th>Filière</th>
                            <th>Module</th>
                            <th>Chapitre</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
            
                    <tbody>
                        <tr>
                            <td>ISI</td>
                            <td>MERISE</td>
                            <td>DEMARCHE MCC</td>
                            <td>
                                <a href="#modal1" class="light-blue-text text-darken-4 tooltipped modal-trigger" data-position="top" data-tooltip="Mettre à jour">
                                    <div class="material-icons">edit</div>
                                </a>
                                <a href="#" class="red-text text-accent-4 tooltipped" data-position="top" data-tooltip="Supprimer">
                                    <div class="material-icons">delete</div>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td>SD</td>
                            <td>Machine Learning</td>
                            <td>Bases Python</td>
                            <td>
                                <a href="#" class="light-blue-text text-darken-4 tooltipped" data-position="top" data-tooltip="Mettre à jour">
                                    <div class="material-icons">edit</div>
                                </a>
                                <a href="#" class="red-text text-accent-4 tooltipped" data-position="top" data-tooltip="Supprimer">
                                    <div class="material-icons">delete</div>
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection


<!-- Modal Structure -->
<div id="modal1" class="modal">
    <div class="modal-content">
        <h4>Mise à jour</h4>
        <div class="row">
            <div class="input-field col s12">
                <input type="text" value="Licence"/>
                <label for="Niveau">Niveau</label>
            </div>
            <div class="input-field col s12">
                <input type="text" value="Professionnelle"/>
                <label for="Niveau">Type</label>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <a href="#!" class="modal-close waves-effect waves-light btn-flat">Annuler</a>
        <a href="#!" class="waves-effect waves-light btn-flat deep-orange accent-4 white-text">Mettre à jour</a>
    </div>
</div>

<!-- Modal Structure -->
<div id="delete1" class="modal">
    <div class="modal-content">
        <h4>Suppression</h4>
        <p>Voulez-vous vraiment supprimer ce Niveau?</p>
    </div>
    <div class="modal-footer">
        <a href="#!" class="modal-close waves-effect waves-light btn-flat">Annuler</a>
        <a href="#!" class="waves-effect waves-light btn-flat materialize-red white-text">Supprimer</a>
    </div>
</div>