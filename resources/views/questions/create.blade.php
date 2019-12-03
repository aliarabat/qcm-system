@extends('layouts.mainLayout')
@section('mainContent')
    <form id="question-form" class="row" method="POST" action="{{route('questions.store')}}">
        @csrf
        <div id="question-create-form1" class="col-s12 z-depth-4 mt-p-1">
            <div class="row">
                <div class="input-field col s6">
                    <select name="level">
                        <option value="f1" selected>F1</option>
                        <option value="f2">F2</option>
                        <option value="f3">F3</option>
                    </select>
                    <label>Filière</label>
                </div>
                <div class="input-field col s6">
                    <select name="branch">
                        <option value="m1" selected>M1</option>
                        <option value="m2">M2</option>
                        <option value="m3">M3</option>
                    </select>
                    <label>Module</label>
                </div>
                <div class="input-field col s6 offset-s3">
                    <select id="chapitre" name="chapitre">
                        <option  value="C1" >C1</option>
                        <option  value="C2">C2</option>
                        <option  value="C3">C3</option>
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
                <div class="col s6" style="display: flex; align-items: center; justify-content: flex-start">
                    <div class="input-field col s10" style="padding: 0;">
                        <input type="text" name="question" id="question">
                        <label style="left: 0px;">Question</label>
                    </div>
                    <p class="col s2" >
                        <input id="hidend" type="hidden" name="visibilite" value="0" >
                        <input name="visibilite"  type="checkbox" id="test5" value="1" />
                        <label for="test5" style="padding-left: 25px;">Visible</label>
                    </p>
                </div>
                <div class="input-field col s6">
                    <input name="duree" id="duree" type="number">
                    <label>Durée</label>
                </div>
                <div class="input-field col s6">
                    <select name="difficulte" id="difficulte">
                        <option value="Facile">Facile</option>
                        <option value="Normal">Normal</option>
                        <option value="Difficile">Difficile</option>
                    </select>
                    <label>Difficulte</label>
                </div>
                <div class="input-field col s6">
                    <input name="note" id="note" type="number" min="0">
                    <label>Note</label>
                </div>
            </div>
            <div class="row">
                <div id="response1" style="display: flex; align-items: center;">
                    <div class="input-field col s6 offset-s3">
                        <input type="text" name="proposition[]" id="proposition">
                        <label>Réponse 1</label>
                    </div>
                    <p class="">

                    <input id="hiden" type="hidden" name="reponse[0]" value="0" >
                    <input name="reponse[0]"  type="checkbox" id="check1"  value="1">
                        <label for="check1"></label>
                    </p>
                    <a href="#" class="red-text text-accent-4">
                        <i class="material-icons ">delete</i>
                    </a>
                </div>
            </div>
            <div  class="row" style="display: flex; justify-content: center">
                    <button type="submit" class="btn btn-default">
                        Ajouter
                    </button>
                </div>
            <div id="add-button" class="row" style="display: flex; justify-content: center">
                <button class="btn-flat waves-effect btn-floating orange accent-3 tooltipped" data-position="right" data-tooltip="Ajouter une réponse">
                    <i class="material-icons">add</i>
                </button>
            </div>
            <div class="row" style="display: flex; justify-content: space-around;">
                    <a href="#" id="arrow-back" class="btn-flat waves-effect waves-light deep-orange accent-3 btn-small white-text">
                        <i class="material-icons left">arrow_back</i>
                        Revenir
                    </a>
                    <button type="submit" href="#" id="save-question" class="btn-flat waves-effect waves-light deep-orange accent-3 btn-small white-text">
                        Créer
                    </button>
            </div>
         
    </form>
    
@endsection