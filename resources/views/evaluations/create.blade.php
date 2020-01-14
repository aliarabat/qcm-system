@extends('layouts.mainLayout')

@section('mainContent')
    
    <div class="row z-depth-4 mt-p-1">
        <div class="col-s12">
            <div class="input-field col s4">
                <input type="text" name="description" id="description"/>
                <label for="description">Description</label>
            </div>
            <div class="input-field col s4">
                <input type="number" name="duree" id="duree"/>
                <label for="duree">Durée</label>
            </div>
            <div class="input-field col s4">
                <input type="number" name="difficulte" id="difficulte"/>
                <label for="difficulte">Difficulté en (%)</label>
            </div>
            <div class="input-field col s4">
                <select name="filiere" id="filiere">
                        
                    <option value="m1" selected disabled>Filière</option>
                    @forelse ($filieres as $filiere)
                    <option value="{{$filiere->id}}">{{$filiere->nom_filiere}}</option>
                    @empty
                    <option value="m1" selected disabled>Filière</option>
                    @endforelse
            </select>
                <label for="module">Filière</label>
            </div>

            <div class="input-field col s4">
                <select name="semestre" id="semestre">

            </select>
                <label for="semestre">Semestre</label>
            </div>

          <div class="input-field col s4">
                <select name="module" id="module">

            </select>
                <label for="module">Module</label>
            </div>

            <div class="input-field col s4">
                <select name="chapitre" id="chapitre">
                       
                </select>
                <label for="chapitre">Chapitre</label>
            </div>

            <div class="col s4 d-flex align-items-baseline">
                <div class="input-field col s10" style="padding-left: 0;">
                    <input type="number" name="nbrQuestionCahpitre" id="nbrQuestionCahpitre" min="1"/>
                    <label for="nbrQuestionCahpitre" style="left: 0;">Nombre de questions</label>
                </div>
                <div class="col s2">
                    <a onclick="void addQCMQuestions()" class="waves-effect btn-floating deep-orange waves-light accent-3 white-text">
                        <i class="material-icons">add</i>
                    </a>
                </div>
            </div>
            <table class="centered" id="tableQCM">
                <thead>
                    <tr>
                        <th>Module</th>
                        <th>Chapitre</th>
                        <th>Nobre de questions</th>
                        <th></th>
                    </tr>
                </thead>

                <tbody>
                </tbody>
            </table>
            <div class="col s12 d-flex justify-content-center mt-1">
                <button onclick="return createQCM()" class="btn btn-flat waves-effect waves-light deep-orange accent-3 white-text">
                    <i class="material-icons left">storage</i>
                    Créer
                </button>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        function addQCMQuestions() {
            var tbody=$('#tableQCM tbody');
            var nbrRow=$('#tableQCM tbody tr').length;
        
            var row=`<tr id='row${nbrRow}'>
                        <td>${$('#module').val()}</td>
                        <td>${$('#chapitre').val()}</td>
                        <td>${$('#nbrQuestionCahpitre').val()}</td>
                        <td>
                            <a style='cursor: pointer;' onclick="return deleteQCMQuestions('row${nbrRow}')" class="red-text text-accent-4">
                                <i class="material-icons ">delete</i>
                            </a>
                        </td>
                    </tr>`;
            $(tbody).append(row);
              nbrRow=$('#tableQCM tbody tr').length;
            if (nbrRow>0) {
                $('#description').attr('disabled', true);
                $('#duree').attr('disabled', true);
                $('#difficulte').attr('disabled', true);
                $('#filiere').attr('disabled');
                $('#semestre').attr('disabled');
                $('#module').attr('disabled');
            }else{
                $('#description').removeAttr('disabled');
                $('#duree').removeAttr('disabled');
                $('#difficulte').removeAttr('disabled');
                $('#filiere').removeAttr('disabled');
                $('#semestre').removeAttr('disabled');
                $('#module').removeAttr('disabled');
            }    
        }

     
        function deleteQCMQuestions(id) {
            $('#'+id).remove();
        }

        function createQCM() {
            var questions=[];
            $('#tableQCM tbody tr').each(function (index, elem) { 
                var question={
                    "chapitre": $(this).children('td').eq(1).text(),
                    "nbrQuestion": parseInt($(this).children('td').eq(2).text())
                };
                questions.push(question);
            });
            var qcm={
                "_token": '{{csrf_token()}}',
                "description": $('#description').val(),
                "duree": $('#duree').val(),
                "difficulte": $('#difficulte').val(),
                "chapitres": questions,
                "module":$('#module').val(),
                "semestre":$('#semestre').val(),
            }

            $.post({
                url: "{{route('evaluations.store')}}",
                data: qcm,
                dataType: 'JSON',
                success: function (data) { 
                    console.log(data);
                    $("#tableQCM tbody tr").remove(); 
                    $( '#description' ).val("");
                    $( '#duree' ).val("");
                    $( '#difficulte' ).val("");
                },
                error: function (error) { 

                },
                beforeSend: function () { 

                }  
            });
        }

        $(document).ready(function() {

$('#filiere').on('change',function(){

var filiere_id= $(this).val();
console.log(filiere_id);


$.ajax({
    url: "{{route('evaluations.findSemesterByFiliere')}}",
    dataType: 'JSON',
   data: {

    "_token": "{{ csrf_token() }}",
     "filiere_id": filiere_id,
     
     },
   type: 'GET',
   dataType: 'JSON',
   success: function( result )
   {
     var len = 0;
          
     if(result['data'] != null){
            len = result['data'].length;
            $('select[name="semestre"]').empty();
            var s='<option value="m1" selected disabled>Semestre</option>';
     }
      for( var i = 0; i<len; i++){
                 var id = result['data'][i].id;
                  var name = result['data'][i].libelle;
                 s+='<option value="' + id  + '">' + name + '</option>'; 
                 $('select[name="semestre"]').html(s);
                 $('select[name="semestre"]').material_select();
                 console.log(name);
             }
   },
   error: function()
  {
      //handle errors
      alert('error...');
  
  }
});


});


$('#semestre').on('change',function(){

var semestre_id= $(this).val();
console.log(semestre_id);


$.ajax({
    url: "{{route('evaluations.findModuleBySemestre')}}",
    dataType: 'JSON',
   data: {

    "_token": "{{ csrf_token() }}",
     "semestre_id": semestre_id,
     
     },
   type: 'GET',
   dataType: 'JSON',
   success: function( result )
   {
     var len = 0;
          
     if(result['data'] != null){
            len = result['data'].length;
            $('select[name="module"]').empty();
            var s='<option value="m1" selected disabled>Module</option>';
     }
      for( var i = 0; i<len; i++){
                 var id = result['data'][i].id;
                  var name = result['data'][i].nom_module;
                 s+='<option value="' + name  + '">' + name + '</option>'; 
                 $('select[name="module"]').html(s);
                 $('select[name="module"]').material_select();
                 console.log(name);
             }
   },
   error: function()
  {
      //handle errors
      alert('error...');
  
  }
});


});

$('#module').on('change',function(){

var sel = document.getElementById('module');
var nom_module = $("#module option:selected").val();
console.log(nom_module);


$.ajax({
    url: "{{route('evaluations.findChapitreByModule')}}",
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

});
    </script>
@endsection