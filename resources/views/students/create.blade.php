@extends('layouts.mainLayout')

@section('mainContent')

    <form id="create-student-form" class="row">
        @csrf
        <div class="col-s12 z-depth-4 mt-p-1">
            <div class="row">
                <div class="input-field col s6">
                    <input  id="CIN" name="CIN" type="text"/>
                    <label for="CIN">CIN/Passeport</label>
                </div>
                <div class="input-field col s6">
                    <input  id="codeMassar" name="codeMassar" type="text"/>
                    <label for="codeMassar">Code Massar</label>
                </div>
                <div class="input-field col s6 ">
                    <input id="nom" name="nom" type="text"/>
                    <label for="nom">Nom</label>
                </div>
                <div class="input-field col s6">
                    <input  id="prenom" name="prenom" type="text"/>
                    <label for="prenom">Prénom</label>
                </div>
                <div class="input-field col s6">
                    <input  id="emailAcadémique" name="emailAcadémique" type="email"/>
                    <label for="emailAcadémique">Email académique</label>
                </div>
                <div class="input-field col s6">
                    <input  id="email" name="email" type="email"/>
                    <label for="email">Email</label>
                </div>
                <div class="input-field col s6" >
                    <label for="dateNaissance" class="active">Date de naissance</label>
                    <input id="dateNaissance" name="dateNaissance" type="date"/>
                </div>
                <div class="input-field col s6">
                    <input  id="adresse" name="adresse" type="text"/>
                    <label for="adresse">Adresse</label>
                </div>
                {{-- <div class="input-field col s6">
                    <select name="pays" id="pays">

                    </select>
                    <label for="pays">Pays</label>
                </div>
                <div class="input-field col s6">
                    <select name="ville" id="ville">

                    </select>
                    <label for="ville">Ville</label>
                </div> --}}
                {{-- <div class="input-field col s6">
                    <select name="niveau" id="niveau">

                    </select>
                    <label for="niveau">Filiere</label>
                </div>
                <div class="input-field col s6">
                    <input  id="annee" name="annee" type="number"/>
                    <label for="annee">Année</label>
                </div> --}}
            </div>
            <div class="row center-align">
                <button type="submit" class="btn waves-effect waves-light btn-flat white-text deep-orange accent3">Créer</button>
            </div>
        </div>
    </form>

@endsection

@section('script')
    <script>
        $(document).ready(function(){
            $('.datepicker').pickadate();

            var preLoader=`<div class="preloader-wrapper small active" style="width: 30px; height: 30px; margin-top: 2.5px;">
                            <div class="spinner-layer" style="border-color: #ff5722 !important;">
                            <div class="circle-clipper left">
                                <div class="circle"></div>
                            </div><div class="gap-patch">
                                <div class="circle"></div>
                            </div><div class="circle-clipper right">
                                <div class="circle"></div>
                            </div>
                            </div>
                        </div>`;

            $('button').on('click', function(e){
                e.preventDefault();
                $('#create-student-form button[type="submit"]').text('');
                $('#create-student-form button[type="submit"]').removeClass('btn-flat');
                $('#create-student-form button[type="submit"]').addClass('disabled');

                $('#create-student-form button[type="submit"]').append(preLoader);
            });
        });
    </script>

@endsection