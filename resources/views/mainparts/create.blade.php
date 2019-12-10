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

        @if(session()->has('status'))
           @section('messages')
                <script>
                    var $toastContent = $("<span>{{session()->get('status')}}</span>").add($('<button class="btn-flat toast-action">Annuler</button>'));
                    Materialize.toast($toastContent, 3000);    
                </script>
           @endsection
        @endif
        @if(session()->has('errorStatus'))
            @section('messages')
                <script>
                    var $toastContent = $("<span>{{session()->get('errorStatus')}}</span>").add($('<button class="btn-flat toast-action">Annuler</button>'));
                    Materialize.toast($toastContent, 3000);    
                </script>
           @endsection
        @endif

        <!--Niveau-->
        <div id="niveau" class="col s12" >

            <div style="display: flex; align-items: center;">
            
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

            <!-- list des Niveaux-->
            <div class="row">
                <table class="centered" id="tableNiveaux">
                    <thead>
                        <tr>
                            <th>Niveau</th>
                            <th>Type</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
            
                    <tbody>
                            @forelse ($niveaux as $niveau)
                            <tr>
                                <td>{{$niveau->niveau}}</td>
                                <td>{{$niveau->type}}</td>
                                <td>
                                    <a href="#modal1" onclick="return onUpdateNiveau({{$niveau->id}}, '{{$niveau->niveau}}', '{{$niveau->type}}',false)" class="light-blue-text text-darken-4 tooltipped modal-trigger" data-position="top" data-tooltip="Mettre à jour">
                                        <div class="material-icons">edit</div>
                                    </a>
                                    <a href="#delete1" onclick="return onDeleteNiveau({{$niveau->id}},false)" class="red-text text-accent-4 tooltipped modal-trigger" data-position="top" data-tooltip="Supprimer">
                                        <div class="material-icons">delete</div>
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <div>pas de niveaux</div>
                            @endforelse
    
        
                    </tbody>
                </table>
            </div>
            <!-- END - list des Niveaux-->

        </div>



        <!--Filiere -->
        <div id="filiere" class="col s12">
            <div  style="display: flex; align-items: center;">

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

            <!-- list des Filieres-->
            <div class="row">
                <table class="centered" id="tableFilieres">
                    <thead>
                        <tr>
                            <th>Niveau</th>
                            <th>Filière</th>
                            <th>Libellé</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
            
                    <tbody>
                            @forelse ($filieres as $filiere)
                            <tr>
                                <td>{{App\Niveau::find($filiere->niveau_id)->niveau}}-{{App\Niveau::find($filiere->niveau_id)->type}}</td>
                                <td>{{$filiere->nom_filiere}}</td>
                                <td>{{$filiere->libelle}}</td>
                                <td>
                                    <a href="#modal2" onclick="return onUpdateFiliere({{$filiere->id}},'{{App\Niveau::find($filiere->niveau_id)->niveau}}-{{App\Niveau::find($filiere->niveau_id)->type}}','{{$filiere->nom_filiere}}','{{$filiere->libelle}}',false)" class="light-blue-text text-darken-4 tooltipped modal-trigger" data-position="top" data-tooltip="Mettre à jour">
                                        <div class="material-icons">edit</div>
                                    </a>
                                    <a href="#delete2" onclick="return onDeleteFiliere({{$filiere->id}},false)" class="red-text text-accent-4 tooltipped modal-trigger" data-position="top" data-tooltip="Supprimer">
                                        <div class="material-icons">delete</div>
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>Pas de filières</tr>
                            @endforelse
    
                    </tbody>
                </table>
            </div>
            <!-- End list des Filieres-->
        </div>



        <!--Module-->
        <div id="module" class="col s12">

            <div style="display: flex; align-items: center;">
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
                        <!-- list des Modules-->
            <div class="row">
                <table class="centered" id="tableModules">
                    <thead>
                        <tr>
                            <th>Filière</th>
                            <th>Module</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
            
                    <tbody>
                        @forelse ($assocfilmod as $assoc)
                            <tr>
                                <td id="{{$assoc->module_id}}-{{$assoc->filiere_id}}">{{App\Filiere::find($assoc->filiere_id)->nom_filiere}}</td>
                                <td>{{App\Module::find($assoc->module_id)->nom_module}}</td>
                                <td>
                                    <a href="#modal3" onclick="return onUpdateModule({{$assoc->module_id}},'{{App\Filiere::find($assoc->filiere_id)->nom_filiere}}','{{App\Module::find($assoc->module_id)->nom_module}}','{{App\Module::find($assoc->module_id)->libelle}}','{{$assoc->module_id}}-{{$assoc->filiere_id}}',false)" class="light-blue-text text-darken-4 tooltipped modal-trigger" data-position="top" data-tooltip="Mettre à jour">
                                        <div class="material-icons">edit</div>
                                    </a>
                                    <a href="#delete3" onclick="return onDeleteModule({{$assoc->module_id}},false)" class="red-text text-accent-4 tooltipped modal-trigger" data-position="top" data-tooltip="Supprimer">
                                        <div class="material-icons">delete</div>
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>Pas de Modules</tr>
                            @endforelse
    
                    </tbody>
                </table>
            </div>
       <!-- End list des Modules-->

        </div>

        <!--Chapitre-->
        <div id="chapitre" class="col s12">
            <div style="display: flex; align-items: center;">
                <form action="{{route('mainParts.createChapitre')}}" method="post" class="col s12" >
                        @csrf
                        <div class="input-field col s4">
                            <select name="filiereChapitre" id="filiereChapitre" >
                                    <option value="m1" selected disabled>Filière</option>
                                    @forelse ($filieres as $filiere)
                                        <option value="{{$filiere->nom_filiere}}">{{$filiere->nom_filiere}}-{{$filiere->libelle}}</option>
                                    @empty
                                        {{-- <option value="m1" selected disabled>Filière</option> --}}
                                    @endforelse
                            </select>
                            <label>Filière</label>
                        </div>
                        <div class="input-field col s4" id="moduleChapitre">
                            <select name="moduleChapitre">
                                
                            </select>
                            <label>Module</label>
                        </div>
                        <div class="input-field col s4 ">
                            <input id="chapitreIn" name="nom_chapitre" type="text"/>
                            <label for="chapitreIn">Chapitre</label>
                            </div>
                        <div class="col s2 offset-s5">
                            <button type="submit" class="btn waves-effect waves-light btn-flat white-text deep-orange accent3 text-accent-4">Créer</button>
                        </div>
                </form>
            </div>
            <div class="row">
                <!-- list des Chapitres-->
                    <table class="centered" id="tableChapitres">
                        <thead>
                            <tr>
                                <th>Module</th>
                                <th>Chapitre</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                
                        <tbody>
                                @forelse ($chapitres as $chapitre)
                                <tr>
                                    <td>{{App\Module::find($chapitre->module_id)->nom_module}}</td>
                                    <td>{{$chapitre->nom_chapitre}}</td>
                                    <td>
                                        <a href="#modal4" onclick="return onUpdateChapitre({{$chapitre->id}},'{{$chapitre->nom_chapitre}}',false)" class="light-blue-text text-darken-4 tooltipped modal-trigger" data-position="top" data-tooltip="Mettre à jour">
                                            <div class="material-icons">edit</div>
                                        </a>
                                        <a href="#delete4" onclick="return onDeleteChapitre({{$chapitre->id}},false)" class="red-text text-accent-4 tooltipped modal-trigger" data-position="top" data-tooltip="Supprimer">
                                            <div class="material-icons">delete</div>
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>Pas de Chapitres</tr>
                                @endforelse
                        </tbody>
                    </table>
                </div>
                   <!-- end des Chapitres-->
            </div>

       
    </div>
    @endsection






<!-- Modals-->
<!-- Modal Structure -->
<div id="modal1" class="modal">
        <div class="modal-content">
            <h4>Mise à jour</h4>
            <div class="row">
                <input type="hidden" name="id" value=" ">
                <div class="input-field col s12">
                    <input type="text" name="updatedNiveau" value=" "/>
                    <label for="Niveau">Niveau</label>
                </div>
                <div class="input-field col s12">
                    <input type="text" name="updatedTypeNiveau" value=" "/>
                    <label for="Niveau">Type</label>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <a class="modal-close waves-effect waves-light btn-flat">Annuler</a>
            <a onclick="return onUpdateNiveau(null, null, null, true)" class="waves-effect waves-light btn-flat deep-orange accent-4 white-text">Mettre à jour</a>
        </div>
    </div>


    <div id="modal2" class="modal">
            <div class="modal-content">
                <h4>Mise à jour</h4>
                <div class="row">
                    <input type="hidden" name="id" value=" ">
                    <div class="input-field col s12">
                            <select name="updatedNiveauFiliere" id="updatedNiveauFiliere">
                                    <option value="m1" selected disabled>Niveau</option>
                                    @forelse ($niveaux as $niveau)
                                    <option value="{{$niveau->niveau}}-{{$niveau->type}}">{{$niveau->niveau}}-{{$niveau->type}}</option>
                                    @empty
                                    <option value="m1" selected disabled>Niveau</option>
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
                <a onclick="return onUpdateFiliere(null, null, null,null, true)" class="waves-effect waves-light btn-flat deep-orange accent-4 white-text">Mettre à jour</a>
            </div>
        </div>


        <div id="modal3" class="modal">
            <div class="modal-content">
                <h4>Mise à jour</h4>
                <div class="row">
                    <input type="hidden" name="id" value=" ">
                    <div class="input-field col s12">
                            <select name="updatedFiliereModule" id="updatedFiliereModule">
                                    <option value="m1" selected disabled>Filiere</option>
                                    @forelse ($filieres as $filiere)
                                    <option value="{{$filiere->nom_filiere}}">{{$filiere->nom_filiere}}</option>
                                    @empty
                                    <option value="m1" selected disabled>Filière</option>
                                    @endforelse
                            </select>
                            <label>Filière</label>
                        </div>
                    <div class="input-field col s12">
                        <input type="text" name="updatedModule" value=" "/>
                        <label for="module">Module</label>
                    </div>
                    <div class="input-field col s12">
                        <input type="text" name="updatedlibelleModule" value=" "/>
                        <label for="libelle">Libellé</label>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
            </div>
        </div>



        <div id="modal4" class="modal">
                <div class="modal-content">
                    <h4>Mise à jour</h4>
                    <div class="row">
                        <input type="hidden" name="id" value=" ">
                        <div class="input-field col s12">
                            <input type="text" name="updatedChapitre" value=" "/>
                            <label for="chapitre">Chapitre</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                <a class="modal-close waves-effect waves-light btn-flat">Annuler</a>
                <a onclick="return onUpdateChapitre(null, null,true)" class="waves-effect waves-light btn-flat deep-orange accent-4 white-text">Mettre à jour</a>
                </div>
            </div>
    
    <!-- Modal Structure -->
    <div id="delete1" class="modal">
        <div class="modal-content">
            <h4>Suppression</h4>
            <p>Voulez-vous vraiment supprimer ce Niveau?</p>
            <input type="hidden"/>
        </div>
        <div class="modal-footer">
            <a class="modal-close waves-effect waves-light btn-flat">Annuler</a>
            <a onclick="return onDeleteNiveau(null, true)" class="waves-effect waves-light btn-flat materialize-red white-text">Supprimer</a>
        </div>
    </div>


    <div id="delete2" class="modal">
            <div class="modal-content">
                <h4>Suppression</h4>
                <p>Voulez-vous vraiment supprimer cette Filière?</p>
                <input type="hidden"/>
            </div>
            <div class="modal-footer">
                <a class="modal-close waves-effect waves-light btn-flat">Annuler</a>
                <a onclick="return onDeleteFiliere(null, true)" class="waves-effect waves-light btn-flat materialize-red white-text">Supprimer</a>
            </div>
        </div>

        <div id="delete3" class="modal">
            <div class="modal-content">
                <h4>Suppression</h4>
                <p>Voulez-vous vraiment supprimer ce Module?</p>
                <input type="hidden"/>
            </div>
            <div class="modal-footer">
                <a class="modal-close waves-effect waves-light btn-flat">Annuler</a>
                <a onclick="return onDeleteModule(null, true)" class="waves-effect waves-light btn-flat materialize-red white-text">Supprimer</a>
            </div>
        </div>

        <div id="delete4" class="modal">
                <div class="modal-content">
                    <h4>Suppression</h4>
                    <p>Voulez-vous vraiment supprimer ce Chapitre?</p>
                    <input type="hidden"/>
                </div>
                <div class="modal-footer">
                    <a class="modal-close waves-effect waves-light btn-flat">Annuler</a>
                    <a onclick="return onDeleteChapitre(null, true)" class="waves-effect waves-light btn-flat materialize-red white-text">Supprimer</a>
                </div>
            </div>
    
<!--Script de la génération du select modules par filiere-->

    @section('script')
    <script type="text/javascript">
    $(document).ready(function() {
    
    $('#filiereChapitre').on('change',function(){
       var nom_filiere = $(this).val();
       //console.log(nom_filiere);
       $.ajax({
           url: "{{route('mainParts.modulesFiliere')}}",
           dataType: 'JSON',
          data: {
            "_token": "{{ csrf_token() }}",
            "nom_filiere": nom_filiere
            },
          type: 'GET',
          dataType: 'JSON',
          success: function( result )
          {
            var len = 0;
            len = result['data'].length;
            console.log(len);

                 if(len!=0){
                   //len = result['data'].length;
                   //console.log(len);
                   //$('select[name="moduleChapitre"]').empty();
                   var s='<option value="m1" selected disabled>Module</option>';
                   for( var i = 0; i<len; i++){
                        var id = result['data'][i].id;
                        var name = result['data'][i].nom_module;
                        s+='<option value="' + name + '">' + name + '</option>'; 
                        $('select[name="moduleChapitre"]').html(s);
                        $('select[name="moduleChapitre"]').material_select();
                    }
                 }
                 else{
                    //$('select[name="moduleChapitre"]').empty();
                    var s='<option value="m1" selected disabled>Module</option>';
                    $('select[name="moduleChapitre"]').html(s);
                    $('select[name="moduleChapitre"]').material_select();
                 }             
          },
          error: function()
         {
             //handle errors
             alert('error...');
         }
       });

    });

    
    
    
    });

    //Mettre à jour le niveau
    function onUpdateNiveau(id, niveau, type, updateInDb) {
        if (updateInDb==false) {
            $("#modal1 input[type='hidden']").val(id);
            $("#modal1 input[type='text']:first").val(niveau);
            $("#modal1 input[type='text']:last").val(type);
            console.log('Opened Modal');
        }else{
            console.log('Called Ajax');
            //mettre a jour avec Ajax
            var idNiveau=$("#modal1 input[type='hidden']").val();
            var nomNiveau=$("#modal1 input[type='text']:first").val();
            var typeNiveau=$("#modal1 input[type='text']:last").val();
            $.post({
           url: "http://127.0.0.1:8000/mainparts/"+idNiveau+"/updateNiveau",
           dataType: 'JSON',
           data: {
            "_token": "{{ csrf_token() }}",
            "nomNiveau": nomNiveau,
            "typeNiveau": typeNiveau
            },
            success:function(result){
            console.log(result);
            if(result=1){
                $( "#tableNiveaux" ).load( "http://127.0.0.1:8000/mainparts #tableNiveaux" );
                $( "#tableFilieres" ).load( "http://127.0.0.1:8000/mainparts #tableFilieres" );
                $('#modal1').modal('close');
            // update les selects niveaux
                $.ajax({
             url: "{{route('mainParts.refreshNiveaux')}}",
             type: 'GET',
             "_token": "{{ csrf_token() }}",
             dataType: 'JSON',
          success: function( result )
          {
            console.log(result);
            var len = 0;
            len = result['data'].length;
            console.log(len);
                 if(len!=0){
                     console.log("kayn");
                   var s='<option value="m1" selected disabled>Niveau</option>';
                   for( var i = 0; i<len; i++){
                        var niveau = result['data'][i].niveau;
                        var type = result['data'][i].type;
                        s+='<option value="'+ niveau+'-'+type+'">'+niveau+'-'+type+'</option>'; 
                        $('select[name="niveauFiliere"]').html(s);
                        $('select[name="niveauFiliere"]').material_select();
                        $('#modal2 select[name="updatedNiveauFiliere"]').html(s);
                        $('#modal2 select[name="updatedNiveauFiliere"]').material_select();
                    }
                 }
                 else{
                    console.log("makaynch");
                    var s='<option value="m1" selected disabled>Niveau</option>';
                    $('select[name="niveauFiliere"]').html(s);
                    $('select[name="niveauFiliere"]').material_select();
                    $('#modal2 select[name="updatedNiveauFiliere"]').html(s);
                    $('#modal2 select[name="updatedNiveauFiliere"]').material_select();
                 }
             
          },
          error: function()
         {
             //handle errors
             alert('error...');
         }
       });
            }
            else if(result=-1){
                $('#modal1').modal('close');
                alert("Niveau existe déja");
            }
            else {
                $('#modal1').modal('close');
                alert("Niveau introuvable");
            }
           }
            });
        }
    }
    //Delete le niveau
    function onDeleteNiveau(id, deleteFromDb) {
        if (deleteFromDb==false) {
            $("#delete1 input[type='hidden']").val(id);
            console.log('delete modal opened');
        } else {
            console.log('Delete with ajax');
            //Suppression d'un niveau avec ajax
            var idNiveau=$("#delete1 input[type='hidden']").val();

            $.ajax({
           url: "http://127.0.0.1:8000/mainparts/"+idNiveau+"/deleteNiveau",
           dataType: 'JSON',
           data: {
            "_token": "{{ csrf_token() }}"
            },
            type: 'DELETE',
            success:function(result){
            console.log(result);
            if(result=1){
                $( "#tableNiveaux" ).load( "http://127.0.0.1:8000/mainparts #tableNiveaux" );
                $( "#tableFilieres" ).load( "http://127.0.0.1:8000/mainparts #tableFilieres" );
                $('#delete1').modal('close');
                //update les selects niveaux
                $.ajax({
             url: "{{route('mainParts.refreshNiveaux')}}",
             type: 'GET',
             "_token": "{{ csrf_token() }}",
             dataType: 'JSON',
          success: function( result )
          {
            console.log(result);
            var len = 0;
            len = result['data'].length;
            console.log(len);
                 if(len!=0){
                     console.log("kayn");
                   var s='<option value="m1" selected disabled>Niveau</option>';
                   for( var i = 0; i<len; i++){
                        var niveau = result['data'][i].niveau;
                        var type = result['data'][i].type;
                        s+='<option value="'+ niveau+'-'+type+'">'+niveau+'-'+type+'</option>'; 
                        $('select[name="niveauFiliere"]').html(s);
                        $('select[name="niveauFiliere"]').material_select();
                        $('#modal2 select[name="updatedNiveauFiliere"]').html(s);
                        $('#modal2 select[name="updatedNiveauFiliere"]').material_select();
                    }
                 }
                 else{
                    console.log("makaynch");
                    var s='<option value="m1" selected disabled>Niveau</option>';
                    $('select[name="niveauFiliere"]').html(s);
                    $('select[name="niveauFiliere"]').material_select();
                    $('#modal2 select[name="updatedNiveauFiliere"]').html(s);
                    $('#modal2 select[name="updatedNiveauFiliere"]').material_select();
                 }
             
          },
          error: function()
         {
             //handle errors
             alert('error...');
         }
       });


            }
            else {
                alert("Niveau introuvable");
            }
           }                
            });
        }
    }

    //mettre a jour la filiere
    function onUpdateFiliere(id, niveau, filiere,libelle, updateInDb) {
        if (updateInDb==false) {
            $("#modal2 input[type='hidden']").val(id);
            $("#modal2 input[name='updatedFiliere']").val(filiere);
            $("#modal2 input[type='text']:first").val(niveau);
            $("#modal2 input[type='text']:last").val(libelle);
            console.log('Opened Modal');
        }
        else{
            console.log('Called Ajax');

            var idFiliere=$("#modal2 input[type='hidden']").val();
            var nomFiliere=$("#modal2 input[name='updatedFiliere']").val();
            var libelle=$("#modal2 input[type='text']:last").val();
            var niveau=$("#modal2 input[type='text']:first").val();

            $.post({
           url: "http://127.0.0.1:8000/mainparts/"+idFiliere+"/updateFiliere",
           dataType: 'JSON',
           data: {
            "_token": "{{ csrf_token() }}",
            "nomFiliere": nomFiliere,
            "libelle": libelle,
            "niveau":niveau
            },
            success:function(result){
            if(result=1){
                $( "#tableFilieres" ).load( "http://127.0.0.1:8000/mainparts #tableFilieres" );
                $( "#tableModules" ).load( "http://127.0.0.1:8000/mainparts #tableModules" );
                $('#modal2').modal('close');
                //update select filieres
                $.ajax({
             url: "{{route('mainParts.refreshFilieres')}}",
             type: 'GET',
             "_token": "{{ csrf_token() }}",
             dataType: 'JSON',
          success: function( result )
          {
            console.log(result);
            var len = 0;
            len = result['data'].length;
            console.log(len);
                 if(len!=0){
                     console.log("kayn");
                   var s='<option value="m1" selected disabled>Filière</option>';
                   for( var i = 0; i<len; i++){
                        var filiere = result['data'][i].nom_filiere;
                        var libelle = result['data'][i].libelle;
                        s+='<option value="'+filiere+'">'+filiere+'-'+libelle+'</option>'; 
                        $('select[name="filiereModule"]').html(s);
                        $('select[name="filiereModule"]').material_select();
                        $('#modal3 select[name="updatedFiliereModule"]').html(s);
                        $('#modal3 select[name="updatedFiliereModule"]').material_select();
                        $('select[name="filiereChapitre"]').html(s);
                        $('select[name="filiereChapitre"]').material_select();
                    }
                 }
                 else{
                    console.log("makaynch");
                    var s='<option value="m1" selected disabled>Filière</option>';
                    $('select[name="filiereModule"]').html(s);
                    $('select[name="filiereModule"]').material_select();
                    $('#modal3 select[name="updatedFiliereModule"]').html(s);
                    $('#modal3 select[name="updatedFiliereModule"]').material_select();
                    $('select[name="filiereChapitre"]').html(s);
                    $('select[name="filiereChapitre"]').material_select();
                 }
             
          },
          error: function()
         {
             //handle errors
             alert('error...');
         }
       });


            }
            else if(result=-1){
                $('#modal2').modal('close');
                alert("Filiere existe déja");
            }
            else {
                $('#modal2').modal('close');
                alert("Filiere introuvable");
            }
           }
            });
            }
    }


            //Delete le filiere
    function onDeleteFiliere(id, deleteFromDb) {
        if (deleteFromDb==false) {
            $("#delete2 input[type='hidden']").val(id);
            console.log('delete modal opened');
            //console.log(id);
        } else {
            console.log('Delete with ajax');
            //Suppression d'un niveau avec ajax
            var idFiliere=$("#delete2 input[type='hidden']").val();

            $.ajax({
           url: "http://127.0.0.1:8000/mainparts/"+idFiliere+"/deleteFiliere",
           dataType: 'JSON',
           data: {
            "_token": "{{ csrf_token() }}"
            },
            type: 'DELETE',
            success:function(result){
            console.log(result);
            if(result=1){
                $( "#tableFilieres" ).load( "http://127.0.0.1:8000/mainparts #tableFilieres" );
                $( "#tableModules" ).load( "http://127.0.0.1:8000/mainparts #tableModules" );
                $('#delete2').modal('close');
                //update select filieres
                $.ajax({
             url: "{{route('mainParts.refreshFilieres')}}",
             type: 'GET',
             "_token": "{{ csrf_token() }}",
             dataType: 'JSON',
          success: function( result )
          {
            console.log(result);
            var len = 0;
            len = result['data'].length;
            console.log(len);
                 if(len!=0){
                     console.log("kayn");
                   var s='<option value="m1" selected disabled>Filière</option>';
                   for( var i = 0; i<len; i++){
                        var filiere = result['data'][i].nom_filiere;
                        var libelle = result['data'][i].libelle;
                        s+='<option value="'+filiere+'">'+filiere+'-'+libelle+'</option>'; 
                        $('select[name="filiereModule"]').html(s);
                        $('select[name="filiereModule"]').material_select();
                        $('#modal3 select[name="updatedFiliereModule"]').html(s);
                        $('#modal3 select[name="updatedFiliereModule"]').material_select();
                        $('select[name="filiereChapitre"]').html(s);
                        $('select[name="filiereChapitre"]').material_select();
                    }
                 }
                 else{
                    console.log("makaynch");
                    var s='<option value="m1" selected disabled>Filière</option>';
                    $('select[name="filiereModule"]').html(s);
                    $('select[name="filiereModule"]').material_select();
                    $('#modal3 select[name="updatedFiliereModule"]').html(s);
                    $('#modal3 select[name="updatedFiliereModule"]').material_select();
                    $('select[name="filiereChapitre"]').html(s);
                    $('select[name="filiereChapitre"]').material_select();
                 }
             
          },
          error: function()
         {
             //handle errors
             alert('error...');
         }
       });


            }
            else {
                alert("Filiere introuvable");
            }
           }                
            });        
            }
    }



    //mettre a jour le module
    function onUpdateModule(id, filiere, module,libelle,moduleFiliere, updateInDb) {
        var oldFiliere=document.getElementById(moduleFiliere).innerHTML;
        if (updateInDb==false) {
            $("#modal3 input[type='hidden']").val(id);
            $("#modal3 input[name='updatedModule']").val(module);
            $("#modal3 input[type='text']:first").val(filiere);
            $("#modal3 input[type='text']:last").val(libelle);
            //if ($("#modal3 div[class='modal-footer']").children().length<2) {
                var s='<a class="modal-close waves-effect waves-light btn-flat">Annuler</a>';
                s+='<a onclick="return onUpdateModule('+id+',\''+filiere+'\',\''+module+'\',\''+libelle+'\',\''+moduleFiliere+'\','+true+')" class="waves-effect waves-light btn-flat deep-orange accent-4 white-text">Mettre à jour</a>';
                $("#modal3 div[class='modal-footer']").html(s);
            //}

            console.log(oldFiliere);
            console.log('Opened Modal');
        }
        else{
            console.log('Called Ajax');
            console.log(oldFiliere);
            var idModule=$("#modal3 input[type='hidden']").val();
            var nomModule=$("#modal3 input[name='updatedModule']").val();
            var libelle=$("#modal3 input[type='text']:last").val();
            var filiereSelected=$("#modal3 input[type='text']:first").val();

            $.post({
           url: "http://127.0.0.1:8000/mainparts/"+idModule+"/updateModule",
           dataType: 'JSON',
           data: {
            "_token": "{{ csrf_token() }}",
            "nomModule": nomModule,
            "libelle": libelle,
            "filiere":filiereSelected,
            "oldFiliere":oldFiliere
            },
            success:function(result){
                console.log(result);
            if(result=1){
                $( "#tableModules" ).load( "http://127.0.0.1:8000/mainparts #tableModules" );
                $( "#tableChapitres" ).load( "http://127.0.0.1:8000/mainparts #tableChapitres" );
                $('#modal3').modal('close');
                //window.location.reload();


            }
            else if(result=-1){
                $('#modal3').modal('close');
                alert("Filiere existe déja");
            }
            else {
                $('#modal3').modal('close');
                alert("Module introuvable");
            }
           }
            });
            }
    }

     //Delete le module
     function onDeleteModule(id, deleteFromDb) {
        if (deleteFromDb==false) {
            $("#delete3 input[type='hidden']").val(id);
            console.log('delete modal opened');
            //console.log(id);
        } else {
            console.log('Delete with ajax');
            //Suppression d'un niveau avec ajax
            var idModule=$("#delete3 input[type='hidden']").val();
            $.ajax({
           url: "http://127.0.0.1:8000/mainparts/"+idModule+"/deleteModule",
           dataType: 'JSON',
           data: {
            "_token": "{{ csrf_token() }}"
            },
            type: 'DELETE',
            success:function(result){
            console.log(result);
            if(result=1){
                $( "#tableModules" ).load( "http://127.0.0.1:8000/mainparts #tableModules" );
                $('#delete3').modal('close');
                //window.location.reload();


            }
            else {
                alert("Module introuvable");
            }
           }                
            });        
            }
    }


    //mettre a jour le chapitre
    function onUpdateChapitre(id, chapitre, updateInDb) {
        if (updateInDb==false) {
            $("#modal4 input[type='hidden']").val(id);
            $("#modal4 input[type='text']:first").val(chapitre);
            console.log('Opened Modal');
        }
        else{
            console.log('Called Ajax');

            var idChapitre=$("#modal4 input[type='hidden']").val();
            var chapitre=$("#modal4 input[type='text']:first").val();

            $.post({
           url: "http://127.0.0.1:8000/mainparts/"+idChapitre+"/updateChapitre",
           dataType: 'JSON',
           data: {
            "_token": "{{ csrf_token() }}",
            "chapitre":chapitre
            },
            success:function(result){
                console.log(result);
            if(result=1){
                $( "#tableChapitres" ).load( "http://127.0.0.1:8000/mainparts #tableChapitres" );
                $('#modal4').modal('close');
                //window.location.reload();
            }
            else if(result=-1){
                $('#modal4').modal('close');
                alert("Chapitre existe déja");
            }
            else {
                $('#modal4').modal('close');
                alert("Chapitre introuvable");
            }
           }
            });
            }
    }

     //Delete le chapitre
     function onDeleteChapitre(id, deleteFromDb) {
        if (deleteFromDb==false) {
            $("#delete4 input[type='hidden']").val(id);
            console.log('delete modal opened');
            //console.log(id);
        } else {
            console.log('Delete with ajax');
            //Suppression d'un niveau avec ajax
            var idChapitre=$("#delete4 input[type='hidden']").val();
            $.ajax({
           url: "http://127.0.0.1:8000/mainparts/"+idChapitre+"/deleteChapitre",
           dataType: 'JSON',
           data: {
            "_token": "{{ csrf_token() }}"
            },
            type: 'DELETE',
            success:function(result){
            console.log(result);
            if(result=1){
                $( "#tableChapitres" ).load( "http://127.0.0.1:8000/mainparts #tableChapitres" );
                $('#delete4').modal('close');
            }
            else {
                alert("Chapitre introuvable");
            }
           }                
            });        
            }
    }





    </script>
    
    @endsection