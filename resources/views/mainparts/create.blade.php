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
        <div id="niveau" class="col s12" style="display: flex; align-items: baseline;">
            <div class="input-field col s5">
                <input type="text"/>
                <label for="">Niveau</label>
            </div>
            <div class="col">
                <button class="btn waves-effect waves-light btn-flat white-text deep-orange accent3">Créer</button>
            </div>
        </div>
        <div id="filiere" class="col s12" style="display: flex; align-items: baseline;">
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
        <div id="module" class="col s12" style="display: flex; align-items: baseline;">
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
        </div>
    </div>

@endsection
