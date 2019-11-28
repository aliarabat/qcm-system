@extends('layouts.mainLayout')
@section('mainContent')
    <form class="row">
        <div id="question-create-form1" class="col-s12 z-depth-4 mt-p-1">
            <div class="row">
                <div class="input-field col s6">
                    <select>
                        <option value="f1" selected>F1</option>
                        <option value="f2">F1</option>
                        <option value="f3">F2</option>
                    </select>
                    <label>Filière</label>
                </div>
                <div class="input-field col s6">
                    <select>
                        <option value="m1" selected>M1</option>
                        <option value="m2">M2</option>
                        <option value="m3">M3</option>
                    </select>
                    <label>Module</label>
                </div>
                <div class="input-field col s6 offset-s3">
                    <select>
                        <option value="C1" selected>C1</option>
                        <option value="C2">C2</option>
                        <option value="C3">C3</option>
                    </select>
                    <label>Chapitre</label>
                </div>
            </div>
            <div class="row" style="display: flex; justify-content: center;">
                <button id="arrow-forward" class="btn-flat waves-effect waves-light deep-orange accent-3 btn-small white-text">
                    <i class="material-icons right">arrow_forward</i>
                    suivant
                </button>
            </div>
        </div>
        <div id="question-create-form2" hidden class="col-s12 z-depth-4 mt-p-1">
            <div class="row">
                <div class="col s6" style="display: flex; align-items: center">
                    <div class="input-field col s11" style="padding: 0;">
                        <input type="text">
                        <label>Question</label>
                    </div>
                    <p class="col s2" >
                        <input type="checkbox" id="test5" />
                        <label for="test5">Unique</label>
                    </p>
                </div>
                <div class="input-field col s6">
                    <input type="number">
                    <label>Durée</label>
                </div>
                <div class="input-field col s6">
                    <select name="" id="">
                        <option value="Facile">Facile</option>
                        <option value="Normal">Normal</option>
                        <option value="Difficile">Difficile</option>
                    </select>
                    <label>Chapitre</label>
                </div>
                <div class="input-field col s6">
                    <input type="number" min="0">
                    <label>Note</label>
                </div>
            </div>
            <div class="row">
                <div id="response1" style="display: flex; align-items: center;">
                    <div class="input-field col s6 offset-s3">
                        <input type="text" >
                        <label>Réponse 1</label>
                    </div>
                    <p class="">
                        <input type="checkbox" id="check1" />
                        <label for="check1"></label>
                    </p>
                    <span class="red-text" style="cursor: pointer">
                        <i class="material-icons ">delete</i>
                    </span>
                </div>
            </div>
            <div id="add-button" class="row" style="display: flex; justify-content: center">
                <button class="btn-flat waves-effect btn-floating orange accent-3 tooltipped" data-position="right" data-tooltip="Ajouter une réponse">
                    <i class="material-icons">add</i>
                </button>
            </div>
            <div class="row" style="display: flex; justify-content: center;">
                    <a href="#" id="arrow-back" class="btn-flat waves-effect waves-light deep-orange accent-3 btn-small white-text">
                        <i class="material-icons left">arrow_back</i>
                        Revenir
                    </a>
            </div>
        </div>
    </form>
@endsection