@extends('layouts.mainlayout')

@section('mainContent')
    <div class="row z-depth-4 mt-p-1" id="Hello" onload="alert('wakhdmmmet');">
        <div class="col-s12">
            <div class="col s12 d-flex justify-content-between align-items-center">
                <h4>Evaluation de Web</></h4>
                    <div class="controlls">
                        <div class="circle">
                            <svg width="120" viewBox="0 0 220 220" xmlns="http://www.w3.org/2000/svg">
                                <g transform="translate(110,110)">
                                    <circle r="100" class="e-c-base"/>
                                    <g transform="rotate(-90)">
                                        <circle r="100" class="e-c-progress"/>
                                        <g id="e-pointer">
                                        <circle cx="100" cy="0" r="8" class="e-c-pointer"/>
                                        </g>
                                    </g>
                                </g>
                            </svg>
                        </div>
                        <div class="display-remain-time"></div>
                        <div id="wholeTime" hidden>{{$qcm['wholeTime']}}</div>
                    </div>
            </div>
            <div class="col s12 d-flex align-items-start">
                <div class="progress col s11">
                    <div class="determinate" style="width: 0px;"></div>
                </div>
                <div id="answered-questions" onchange="return onProgressChange()" class="col s1">0/{{count($qcm['questions'])}}</div>
            </div>
            <div class="col s12 d-flex justify-content-center">
                <ul class="pagination">
                    {{-- <li class="disabled"><a href="#!"><i class="material-icons">chevron_left</i></a></li> --}}
                    @foreach ($qcm['questions'] as $question)
                        @if ($loop->first)
                        <li id="pg{{$loop->index}}" class="active"><a onclick="return changeQuestion('question{{$loop->index}}')">{{$loop->index+1}}</a></li>
                        @else
                        <li id="pg{{$loop->index}}" class="waves-effect"><a onclick="return changeQuestion('question{{$loop->index}}')">{{$loop->index+1}}</a></li>
                        @endif
                        
                    @endforeach
                    {{-- <li class="waves-effect"><a href="#!"><i class="material-icons">chevron_right</i></a></li> --}}
                </ul>
            </div>
            <form class="col s12" id="qcm-form" method="POST" data-route="{{route('evaluations.end')}}">
                @foreach ($qcm['questions'] as $question)
                    <div class="col s10 offset-s1" id="question{{$loop->index}}" style="display: {{$loop->index!=0?'none':''}}">
                        <h5>Question {{$loop->index+1}}: <span class="flow-text">{{$question->question}}</span></h5>
                        <input type="hidden" name="question[{{$loop->index}}]['id']" value="{{$question->id}}">
                        @if ($question->type=="unique")
                        <div class="col s10 offset-s1">
                            @foreach ($question->propositions as $proposition)
                            <p>
                                <input class="with-gap" onclick="return answerQuestion({{$loop->parent->index}})" name="question[{{$loop->parent->index}}]['proposition']" type="radio" value="{{$proposition->id}}" id="choice{{$loop->parent->index}}{{$loop->index}}"/>
                                <label class="black-text" for="choice{{$loop->parent->index}}{{$loop->index}}" >{{$proposition->proposition}}</label>
                            </p>
                            @endforeach
                        </div>
                        @else
                        <div class="col s10 offset-s1">
                            @foreach ($question->propositions as $proposition)
                            <p>
                                <input type="checkbox" class="filled-in" onclick="return answerQuestion({{$loop->parent->index}})" name="question[{{$loop->parent->index}}]['proposition']" id="check{{$loop->parent->index}}{{$loop->index}}" value="{{$proposition->id}}"/>
                                <label class="black-text" for="check{{$loop->parent->index}}{{$loop->index}}">{{$proposition->proposition}}</label>
                            </p>
                            @endforeach
                        </div>
                        @endif
                    </div>
                @endforeach
                <div class="col s12 d-flex justify-content-end">
                    <button onclick="return submitQCM();" class="btn-flat waves-effect waves-light deep-orange accent-3 white-text tooltipped" data-position="top" data-tooltip="Terminer l'évaluation" disabled>Terminer</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Structure -->
    <div id="modal1" class="modal">
        <div class="modal-content">
            <h4>Terminition</h4>
            <p>Voulez-vous vraiment treminer cet évaluation?</p>
            <input type="hidden"/>
        </div>
        <div class="modal-footer">
            <a class="modal-close waves-effect waves-light btn-flat">Annuler</a>
            <button class="waves-effect waves-light btn-flat materialize-red white-text">Terminer</button>
        </div>
    </div>
@endsection


@section('script')
    
    <script type="text/javascript">
        window.addEventListener('beforeunload', function (e) { 
            e.preventDefault();
            e.returnValue='';
        });
        $(function () { 
            
            $('body').attr('onload', 'return pauseTimer("event")');
            $.post({
               async: true,
               data:{
                   '_token': '{{csrf_token()}}',
                   'data': 'user_id'
               }, 
               dataType: 'JSON',
               url: '{{route("registerUser")}}'
            });
        });
        function changeQuestion(id) {
            $('[id^="question"]').each(function(index){
                if (parseInt(id.substr(8))!==index) {
                    $('#pg'+index).addClass('waves-effect');
                    $('#pg'+index).removeClass('active');
                    $(this).hide();
                }else{
                    $(this).show();
                    $('#pg'+index).removeClass('waves-effect');
                    $('#pg'+index).addClass('active');
                }
            });
        }

        function answerQuestion(index) {
            var totalQuestions=$('[id^=question]').length;
            var answeredQuestions=$('.answered').length;
            
            if ($(`#question${index} input:last`).attr('type')==='checkbox') {
                var checkedProposotions=0;
                $(`#question${index} input[type='checkbox']`).each(function (index, elem) {
                    if ($(elem).is(':checked')) {
                        checkedProposotions++;
                    }
                });
                if (checkedProposotions==0) {
                    $('#pg'+index).removeClass('answered waves-effect');
                    $('#pg'+index+' a').removeClass('white-text');
                    $('#pg'+index+' a').removeClass('black-text');
                    $('#pg'+index).addClass('active');
                    answeredQuestions--;
                    $('.progress .determinate').css('width', (answeredQuestions*100/totalQuestions)+"%");
                    $('#answered-questions').text(answeredQuestions+'/'+totalQuestions);
                    $('#qcm-form button').attr('disabled', true);
                    return;
                }
            } 
            $('#pg'+index).removeClass('active waves-effect');
            $('#pg'+index).addClass('answered');
            answeredQuestions=$('.answered').length;
            $('#pg'+index+' a').addClass('white-text');
            $('.progress .determinate').css('width', (answeredQuestions*100/totalQuestions)+"%");
            $('#answered-questions').text(answeredQuestions+'/'+totalQuestions);

            if(totalQuestions==answeredQuestions){
                $('#qcm-form button').removeAttr('disabled');
            }
        }

        function submitQCM(e=event) {
            if (e!=null) {
                e.preventDefault();
            }
            var form = $('#qcm-form');
            var questions=[];
            var i=0;
            while (i<form.serializeArray().length) {
                var row=form.serializeArray()[i];
                if(row.name.endsWith('[\'id\']')){
                    var question={
                        question_id: parseInt(row.value),
                        propositions:[]
                    };
                    questions.push({...question});
                }else{
                    questions.forEach(function (question, index){
                        if(index===parseInt(row.name.replace(/[^0-9]/g, ""))){
                            question.propositions.push(parseInt(row.value));
                        }
                    });
                }
                i++;
            }
            questions.sort(function (q1,q2) { return q1.question_id-q2.question_id ;});
            $.post({
                url: form.data('route'),
                data:{
                    "_token":"{{csrf_token()}}",
                    "data": questions
                },
                dataType: 'JSON',
                beforeSend: function () { 
                    console.log("before send");
                },
                error: function (e) {
                    console.log(e);
                }, 
                success: function (data) { 
                    console.log(data);
                }
            });
        }
    </script>
    <script src="{{asset('js/countdown.js')}}"></script>
@endsection

@section('css')
    <link rel="stylesheet" href="{{asset('css/countdown.css')}}">
@endsection