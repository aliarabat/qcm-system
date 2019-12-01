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

                                    <div class="input-field col s6 ">
                                           <input id="niveauIn" name="niveau" type="text"/>
                                            <label for="niveauIn">Niveau</label>
                                    </div>
                                    <div class="input-field col s6">
                                        <input  id="typeIn" name="type" type="text"/>
                                        <label for="typeIn">Type</label>
                                    </div>
                                    <div class="col s2 offset-s5">
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

                            <div class="input-field col s4 ">
                                    <input id="filiereIn" name="nom_filiere" type="text"/>
                                     <label for="filiereIn">Filière</label>
                             </div>

                             <div class="input-field col s4">
                                 <input  id="libelleIn" name="libelle" type="text"/>
                                 <label for="libelleIn">Libellé</label>
                             </div>

                            <div class=" col s2 offset-s5">
                                <button type="submit" class="btn waves-effect waves-light btn-flat white-text deep-orange accent3 text-accent-4">Créer</button>
                            </div>
            </form>

            
        </div>






        <!--Module-->
        <div id="module" class="col s12" style="display: flex; align-items: baseline;">
            <form action="{{route('mainParts.createModule')}}" method="post" class="col s12" >
                @csrf  
                <div class="input-field col s4">
                        <select name="filiereModule" id="filiereModule">
                                <option value="m1" selected disabled>Filière</option>
                                @forelse ($filieres as $filiere)
                                <option value="{{$filiere->nom_filiere}}-{{$filiere->libelle}}">{{$filiere->nom_filiere}}-{{$filiere->libelle}}</option>
                                @empty
                                <option value="m1" selected disabled>Filière</option>
                                @endforelse
                        </select>
                        <label>Filière</label>
                    </div>

                    <div class="input-field col s4 ">
                            <input id="moduleIn" name="nom_module" type="text"/>
                             <label for="moduleIn">Module</label>
                     </div>

                     <div class="input-field col s4">
                         <input  id="libelleModuleIn" name="libelleModule" type="text"/>
                         <label for="libelleModuleIn">Libellé</label>
                     </div>

                    <div class="col s2 offset-s5">
                        <button type="submit" class="btn waves-effect waves-light btn-flat white-text deep-orange accent3 text-accent-4">Créer</button>
                    </div>
    </form>

        </div>





        <!--Chapitre-->
        <div id="chapitre" class="col s12">
            <form action="{{route('mainParts.createChapitre')}}" method="post" class="col s12" >
                @csrf  
                <div class="input-field col s6">
                        <select name="moduleChapitre" id="moduleChapitre">
                                <option value="m1" selected disabled>Module</option>
                                @forelse ($allModules  as $module)
                                <option value="{{$module->nom_module}}-{{$module->libelle}}">{{$module->nom_module}}-{{$module->libelle}}</option>
                                @empty
                                <option value="m1" selected disabled>Module</option>
                                @endforelse
                        </select>
                        <label>Module</label>
                    </div>

                    <div class="input-field col s6 ">
                            <input id="chapitreIn" name="nom_chapitre" type="text"/>
                             <label for="chapitreIn">Chapitre</label>
                     </div>

                    

                    <div class="col s2 offset-s5">
                        <button type="submit" class="btn waves-effect waves-light btn-flat white-text deep-orange accent3 text-accent-4">Créer</button>
                    </div>
    </form>

        </div>



        @if(session()->has('status'))
        <h6 style="color: green">
            {{session()->get('status')}}
            </h6>
@endif
@if(session()->has('errorStatus'))
<h6 style="color: red">
{{session()->get('errorStatus')}}
</h6>
@endif

    </div>

@endsection
