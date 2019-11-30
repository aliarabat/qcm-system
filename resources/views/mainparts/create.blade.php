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





        <!--Niveau-->
        <div id="niveau" class="col s12" style="display: flex; align-items: baseline;">
            <form action="{{route('mainParts.createNiveau')}}" method="post" class="col s12" >
                    @csrf  

                                    <div class="input-field col s5 ">
                                           <input id="niveauIn" name="niveau" type="text"/>
                                            <label for="niveauIn">Niveau</label>
                                    </div>
                                    <div class="input-field col s5">
                                        <input  id="typeIn" name="type" type="text"/>
                                        <label for="typeIn">Type</label>
                                    </div>
                                    <div class="input-field col s2">
                                        <button type="submit" class="btn waves-effect waves-light btn-flat white-text deep-orange accent3">Créer</button>
                                    </div>
        </form>
        </div>





        <!--Filiere -->
        <div id="filiere" class="col s12" style="display: flex; align-items: baseline;">
                <form action="{{route('mainParts.createFiliere')}}" method="post" class="col s12" >
                        @csrf  
                        <div class="input-field col s4">
                                <select name="niveauFiliere" id="niveauFiliere">
                                        <option value="m1" selected disabled>Niveau</option>
                                        @forelse ($niveaux as $niveau)
                                        <option value="{{$niveau->niveau}}-{{$niveau->type}}">{{$niveau->niveau}}-{{$niveau->type}}</option>
                                        @empty
                                        <option value="m1" selected disabled>Niveau</option>
                                        @endforelse
                                </select>
                                <label>Niveau</label>
                            </div>

                            <div class="input-field col s3 ">
                                    <input id="filiereIn" name="nom_filiere" type="text"/>
                                     <label for="filiereIn">Filière</label>
                             </div>

                             <div class="input-field col s3">
                                 <input  id="libelleIn" name="libelle" type="text"/>
                                 <label for="libelleIn">Libellé</label>
                             </div>

                            <div class=" input-field col s2">
                                <button type="submit" class="btn waves-effect waves-light btn-flat white-text deep-orange accent3 text-accent-4">Créer</button>
                            </div>
            </form>

            
        </div>






        <!--Module-->
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





        <!--Chapitre-->
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
