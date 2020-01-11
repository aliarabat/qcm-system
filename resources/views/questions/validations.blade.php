@extends('layouts.mainLayout')

@section('mainContent')

    <div class="row z-depth-4 mt-p-1">
        <div class="col s12" >
            <table class="centered">
                <thead>
                    <tr>
                        <th>Question</th>
                        <th>Professeur</th>
                        <th>Date de création</th>
                        <th>Date de modification</th>
                        <th>Etat</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($questions->items() as $question)
                    <tr>
                        <td>{{$question->question}}</td>
                        <td>Ana</td>
                        <td>{{$question->created_at}}</td>
                        <td>{{$question->updated_at}}</td>
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
    </script>
@endsection
