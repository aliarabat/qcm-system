@extends('layouts.mainLayout')

@section('mainContent')

    <div class="row z-depth-4 mt-p-1">
        <div class="col s12" >
            <table id="tabValidation"class="centered">
                <thead>
                    <tr>
                        <th>Question</th>
                        <th>Professeur</th>
                        <th>Date de création</th>
                        <th>Vote</th>
                        @can('create', App\Niveau::class)
                        <th>Etat</th>
                        @endcan
                        @can('create', App\Question::class)
                        <th>Voter</th>
                        @endcan
                    </tr>
                </thead>
                <tbody>
                    @forelse ($questions->items() as $question)
                    <tr>
                        <td>{{$question->question}}</td>
                        <td>{{$question->user->last_name}} {{$question->user->first_name}}</td>
                        <td>{{$question->created_at}}</td>

                        <td>{{$question->vote??'Pas encore'}}</td>
                        @can('create', App\Niveau::class)
                        <td class="d-flex justify-content-between">
                            <p>
                                <input class="with-gap" onchange="return validate('valid-{{$question->id}}')" type="radio" {{$question->validite=='valid'?'checked':''}} name="validite{{$loop->index}}" id="valid{{$loop->index}}">
                                <label for="valid{{$loop->index}}" class="black-text">Valide</label>
                            </p>
                            <p>
                                <input class="with-gap" onchange="return validate('libre-{{$question->id}}')" type="radio" {{$question->validite=='libre'?'checked':''}} name="validite{{$loop->index}}" id="libre{{$loop->index}}">
                                <label for="libre{{$loop->index}}" class="black-text">Libre</label>
                            </p>
                            <p>
                                <input class="with-gap" onchange="return validate('invalid-{{$question->id}}')" type="radio" {{$question->validite=='invalid'?'checked':''}} name="validite{{$loop->index}}" id="invalid{{$loop->index}}">
                                <label for="invalid{{$loop->index}}" class="black-text">Invalide</label>
                            </p>
                        </td>
                        @endcan
                        @can('create', App\Question::class)
                        <td>
                            @if (App\QuestionProfessor::get()->where('question_id',$question->id)->where('professor_id',Auth::user()->id)->first())
                            <p>
                                <input type="checkbox" onchange="return vote({{$question->id}},{{$loop->index}},$('#filled-in-box'+{{$loop->index}}).is(':checked'))" checked class="filled-in" id="filled-in-box{{$loop->index}}"/>
                                <label for="filled-in-box{{$loop->index}}"></label>
                            </p>
                            @else
                            <p>
                                <input type="checkbox" onchange="return vote({{$question->id}},{{$loop->index}},$('#filled-in-box'+{{$loop->index}}).is(':checked'))" class="filled-in" id="filled-in-box{{$loop->index}}"/>
                                <label for="filled-in-box{{$loop->index}}"></label>
                            </p>                            
                            @endif
                            
                        </td>
                        @endcan
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5">Aucune questions trouvées</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="row d-flex justify-content-end">
            <ul class="pagination">
                <li class="{{$questions->onFirstPage()?'disabled':'waves-effect'}}"><a href="{{$questions->onFirstPage()?'':$questions->previousPageUrl()}}"><i class="material-icons">chevron_left</i></a></li>
                {{-- @if ($questions->lastPage()>6)
                    <li class="waves-effect"><a href="{{$questions->previousPageUrl()}}">{{$i}}</a></li>
                    <li class="active"><a href="{{$questions->url($quesions->currentPage())}}">{{$i}}</a></li>
                    <li class="waves-effect"><a href="{{$questions->nextPageUrl($i)}}">{{$i}}</a></li>
                @else --}}
                    @for ($i = 1; $i <= $questions->lastPage(); $i++)
                    <li class="{{$questions->currentPage()==$i?'active':'waves-effect'}}"><a href="{{$questions->url($i)}}">{{$i}}</a></li>
                    @endfor
                {{-- @endif --}}
                <li class="{{$questions->hasMorePages()?'waves-effect':'disabled'}}"><a href="{{$questions->nextPageUrl()}}"><i class="material-icons">chevron_right</i></a></li>
            </ul>
        </div>
    </div>

@endsection

@section('script')
    <script src="{{asset('js/questions.js')}}"></script>
    <script>
    function validate(choice=''){
        var data=choice.split('-');
        data={
            '_token': '{{csrf_token()}}',
            'validity': data[0],
            'id': data[1],
        };
        $.post({
            url: "{{route('questions.changeValidation')}}",
            data: data,
            dataType: 'JSON',
            success: function (data) { 
                console.log(data);
            },
            error: function(error){
                console.log(error);
            }
        })
    }


    function vote(id,loopIndex,checked){
        var id_question=id;
        //console.log(id)
        if(checked==true){
            console.log(1);
            $.post({
            url: "{{route('questions.voted')}}",
            dataType: 'JSON',
            data: {
             "_token": '{{csrf_token()}}',
             "id_question": id_question
             },
           success: function( result )
           {
            $( "#tabValidation" ).load( "http://127.0.0.1:8000/questions/validations #tabValidation" );
           },
           error: function()
          {
              //handle errors
              alert('error...');
          }
        });


        }
        else{
            console.log(2);
            $.post({
            url: "{{route('questions.devoted')}}",
            dataType: 'JSON',
            data: {
             "_token": '{{csrf_token()}}',
             "id_question": id_question
             },
           success: function( result )
           {
            $( "#tabValidation" ).load( "http://127.0.0.1:8000/questions/validations #tabValidation" );
           },
           error: function()
          {
              //handle errors
              alert('error...');
          }
        });
        }

    }
    </script>
@endsection
