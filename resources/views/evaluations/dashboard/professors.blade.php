@extends('layouts.mainLayout')

@section('mainContent')
    
    <div class="row z-depth-4 mt-p-1">

    @forelse ($qcms as $qcm)
        <table class="centered">
            <thead> 
                <tr>
                    <th>Description</th>
                    <th>Date de création</th>
                    <th>Difficulté</th>
                    <th>Durée</th>
                    <th>Nombre de questions</th>
                    <th>Résultats</th>
                </tr>
            </thead>    
            <tbody>
                <tr id="{{$qcm->id}}">
                    <td>{{$qcm->description}}</td>
                    <td>{{$qcm->created_at}}</td>
                    <td>{{$qcm->difficulty}}%</td>
                    <td>{{$qcm->duration}} min</td>
                    <td>{{$qcm->nbrQuestion}}</td>
                    <td>
                        <a href="#modal" onclick="return showQcmDetail({{$qcm->id}});" class="btn-floating btn-small waves-effect waves-light red tooltipped modal-trigger" data-position="top" data-tooltip="Afficher résultats"><i class="material-icons">add</i></a>
                    </td>
                </tr>
            </tbody>
        </table>   
    @empty
        <h4 class="flow-text">Aucun qcm trouvé à ce moment</h4>
    @endforelse
    </div>

     <!-- Modal Structure -->
     <div id="modal" class="modal">
        <div class="modal-content">
            <table>
                <thead>
                    <tr>
                        <th>Etudiant</th>
                        <th>Note</th>
                        <th>Statut</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>

@endsection

@section('script')
    <script>
        function showQcmDetail(qcmId){
            $('#modal tbody tr').each(function(index, el) {
                $(el).remove();
            });
            $.get({
               url: "{{route('evaluations.getResults')}}",
               data: {
                   '_token': "{{csrf_token()}}",
                   'quuid': qcmId
               },
               dataType: 'JSON',
               success: function(data){
                   var qcm_users=data.data.qcm_users;
                   const total =data.data.noteTotal;
                   qcm_users.forEach(qcm_user => {
                    const row=`<tr>
                            <td>${qcm_user.user.last_name} ${qcm_user.user.first_name}</td>
                            <td>${qcm_user.note}/${total}</td>
                            <td>${qcm_user.is_passed==1?'Passé':'Non passé'}</td>
                        </tr>`;
                    $('#modal tbody').append(row);
                   });
               },
               error: function () {
                }
            });
        }
    </script> 
@endsection