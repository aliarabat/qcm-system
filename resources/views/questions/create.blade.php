@extends('layouts.mainLayout')
@section('mainContent')

@if(session()->has('status'))
<h6 style="color: green">{{session()->get('status')}}</h6>
@endif
@if(session()->has('errorStatus'))
<h6 style="color: red">{{session()->get('errorStatus')}}</h6>
@endif
    <form id="question-form" class="row" method="POST" action="{{route('questions.createQuestion')}}">
        @csrf
        <div id="question-create-form1" class="col-s12 z-depth-4 mt-p-1">
            <div class="row">
                <div class="input-field col s4">
                    <select name="filiereModule" id="filiereModule">
                            
                            <option value="m1" selected disabled>Filière</option>
                            @forelse ($filieres as $filiere)
                            <option value="{{$filiere->nom_filiere}}">{{$filiere->nom_filiere}}-{{$filiere->libelle}}</option>
                            @empty
                            <option value="m1" selected disabled>Filière</option>
                            @endforelse
                    </select>
                    <label>Filière</label>
                </div>
                   <div class="input-field col s4" id="moduleChap">
                            <select  name="moduleChap" id="moduleChap">
                                   
                            </select>
                            <label>Module</label>
                        </div>
                        <div class="input-field col s4">
                                <select name="chapitre" id="chapitre">
                                       
                                </select>
                                <label>Chapitre</label>
                            </div>
            </div>
            <div class="row center-align">
                <button id="arrow-forward" class="btn-flat waves-effect waves-light deep-orange accent-3 btn-small white-text disabled">
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
            <div  class="center-align">
                <a href="#" id="arrow-back" class="btn-flat waves-effect waves-light deep-orange accent-3 btn-small white-text mr-1">
                    <i class="material-icons left">arrow_back</i>
                    Revenir
                </a>
                <button type="submit" class="button-small btn-flat waves-effect waves-light deep-orange accent-3 white-text">
                    <i class="material-icons left">storage</i>
                    Créer
                </button>
            </div>
         
    </form>
    
@endsection
<!--Script de la génération du select modules par filiere-->

@section('script')
<script type="text/javascript">
$(document).ready(function() {

$('#filiereModule').on('change',function(){
    var sel = document.getElementById('filiereModule');
   var nom_filiere= sel.value;
 
   

   $.ajax({
       url: "{{route('questions.findModuleByFiliere')}}",
       dataType: 'JSON',
      data: {
        "nom_filiere": nom_filiere
        },
      type: 'GET',
      dataType: 'JSON',
      success: function( result )
      {
        var len = 0;
             if(result['data'] != null){
               len = result['data'].length;
            //    console.log(result['data']);
            //    console.log(result['data'].length);
               $('select[name="moduleChap"]').empty();
               var s='<option value="m1" selected disabled>Module</option>';
             }
        //  console.log(result);
        //   console.log(len);
         for( var i = 0; i<len; i++){
                    var id = result['data'][i].id;
                    var name = result['data'][i].nom_module;
                    s+='<option value="' + name + '">' + name + '</option>'; 
                    $('select[name="moduleChap"]').html(s);
                    $('select[name="moduleChap"]').material_select();
                    
                    
                }
      },
      error: function()
     {
         //handle errors
         //alert('error...');
         console.log(error);
     }
   });

   
});


$('#moduleChap').on('change',function(){

   var sel = document.getElementById('moduleChap');
   var nom_module = $("#moduleChap option:selected").val();
   console.log(nom_module);
   

   $.ajax({
       url: "{{route('questions.findChapitreByModule')}}",
       dataType: 'JSON',
      data: {
        "nom_module": nom_module,
        
        },
      type: 'GET',
      dataType: 'JSON',
      success: function( result )
      {
        var len = 0;
             
        if(result['data'] != null){
               len = result['data'].length;
               $('select[name="chapitre"]').empty();
               var s='<option value="m1" selected disabled>Chapitre</option>';
        }
         for( var i = 0; i<len; i++){
                    var id = result['data'][i].id;
                     var name = result['data'][i].nom_chapitre;
                    s+='<option value="' + name + '">' + name + '</option>'; 
                    console.log(name)
                    $('select[name="chapitre"]').html(s);
                    $('select[name="chapitre"]').material_select();
                    
                }
      },
      error: function()
     {
         //handle errors
         alert('error...');
     
     }
   });

   
});

    $('#chapitre').on('change', function (e) { 
        e.preventDefault();
        var chapitreValue=$(this).val();
        if (chapitreValue!=='') {
            $('#arrow-forward').removeClass('disabled');
        }else{
            $('#arrow-forward').addClass('disabled');
        }
     });

});

</script>

@endsection



