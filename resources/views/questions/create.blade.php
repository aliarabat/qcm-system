@extends('layouts.mainLayout')
@section('mainContent')


    <form id="question-form" class="row" method="POST" action="{{route('questions.store')}}">
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
            <div class="row" style="display: flex; justify-content: center;">
                <button id="arrow-forward" disabled class="btn-flat waves-effect waves-light deep-orange accent-3 btn-small white-text">
                    <i class="material-icons right">arrow_forward</i>
                    suivant
                </button>
            </div>
        </div>
        <div id="question-create-form2" class="col-s12 z-depth-4 mt-p-1" hidden>
            <div class="row">
                <div class="input-field col s6">
                    <input type="text" onfocus="this.value=''" name="question" id="question">
                    <label for="question">Question</label>
                </div>
                <div class="input-field col s6">
                    <label>Durée</label>
                    <input name="duree" id="duree" type="number">
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
    
                        <input id="hidden" type="hidden" name="reponse[0]" value="0" >
                        <input name="reponse[0]"  type="checkbox" class="filled-in" id="check0"  value="1">
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
                    <button type="submit" id="submit" class="button-small btn-flat waves-effect waves-light deep-orange accent-3 white-text">
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

if ($("#question-form").length > 0) {
    $("#question-form").validate({
      
    rules: {
        question: {
        required: true,
        maxlength: 100,
      },
  
      duree: {
            required: true,
            digits:true,
            min: 1,
           
        },
        difficulte: {
                required: true,
                maxlength: 50,
            },   
            note: {
                required: true,
                number:true,
                max: 20,
                min: 1,
            }, 
            'proposition[]': {
                required: true,
                
            },  
            
    },
    messages: {
        
        question: {
        required: "Please enter question",
      },
      duree: {
        required: "Please enter duree",
        digits: "Please enter only numbers",
        min:"Please enter duration greater than or equal to 1",
         
      },
      difficulte: {
          required: "Please enter difficulte",
        
        },
        note: {
          required: "Please enter note",
          max:"Please enter note less than or equal to 20",
          min:"Please enter note greater than or equal to 1",
          
        },
        'propostion[]': {
          required: "Please enter proposition",
        },
        
    },
    errorElement : 'div',
        errorPlacement: function(error, element) {
          var placement = $(element).data('error');
          if (placement) {
            $(placement).append(error)
          } else {
            error.insertAfter(element);
          }
        },
    submitHandler: function(form) {
     $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });
      $('#submit').html('Sending..');
      $.ajax({
        url: '{{route('questions.store')}}' ,
        type: "POST",
        data: $('#question-form').serialize(),
        success: function( response ) {
            $('#submit').html('Ajouter');
            $('#res_message').show();
            $('#res_message').html(response.msg);
            $('#msg_div').removeClass('d-none');
 
           //document.getElementById("question-create-form2").empty(); 
           $('[id^=response]').each(function(index){
               if(index!=0){
                   $(this).remove()
                                  }else{
                                    $( '#proposition' ).val("");
                                   //console.log('#response'+index)
                                   document.getElementById("check1").checked = false;
                                  }
           });
           $( '#question' ).val("");
           $( '#duree' ).val("");
           $( '#note' ).val("");
          
            setTimeout(function(){
            $('#res_message').hide();
            $('#msg_div').hide();
            },10000);
        }
      });

      
    }
  })
}

    $('#chapitre').on('change', function (e) { 
        var chapitreValue=$(this).val();
        if (chapitreValue!=='') {
            $('#arrow-forward').removeAttr('disabled');
        }else{
            $('#arrow-forward').attr('disabled', true);
        }
     });
});



</script>

@endsection



