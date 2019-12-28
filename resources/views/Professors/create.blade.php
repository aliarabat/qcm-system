@extends('layouts.mainLayout')

@section('mainContent')

    <form id="create-professor-form" class="row">
        @csrf
        <div id="question-create-form1" class="col-s12 z-depth-4 mt-p-1">
            <div class="row">
                <div class="input-field col s6 ">
                    <input id="cin" name="cin" type="text"/>
                    <label for="cin">CIN</label>
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
                    <input  id="adresse" name="adresse" type="text"/>
                    <label for="adresse">Adresse</label>
                </div>
                <div class="input-field col s6">
                    <input  id="emailAcademique" name="emailAcademique" type="email"/>
                    <label for="emailAcademique">Email académique</label>
                </div>
                <div class="input-field col s6">
                    <input  id="email" name="email" type="email"/>
                    <label for="email">Email</label>
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
                <div class="input-field col s6">
                    <input  id="dateNaissance" name="dateNaissance" type="date"/>
                    <label for="dateNaissance" class="active">Date de naissance</label>
                </div>
                <div class="input-field col s6">
                    <input  id="password" name="password" type="password"/>
                    <label for="password">Mot de passe</label>
                </div>
                <div class="input-field col s6">
                    <input  id="r-password" name="r-password" type="password"/>
                    <label for="r-password">Confirmer Mot de passe</label>
                </div>
            </div>
            <div class="row center-align">
                <button type="submit" class="btn waves-effect waves-light btn-flat white-text deep-orange accent3">Créer</button>
            </div>
        </div>
    </form>

@endsection

@section('script')
    <script>
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
            $('#create-professor-form button[type="submit"]').text('');
            $('#create-professor-form button[type="submit"]').removeClass('btn-flat');
            $('#create-professor-form button[type="submit"]').addClass('disabled');

            $('#create-professor-form button[type="submit"]').append(preLoader);
        });
    </script>
@endsection