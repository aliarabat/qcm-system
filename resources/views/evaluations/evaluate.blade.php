@extends('layouts.mainlayout')

@section('mainContent')
    <div class="row z-depth-4 mt-p-1">
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
                        {{-- <button class="play" id="pause"></button> --}}
                    </div>
            </div>
            <div class="col s12 d-flex align-items-start">
                <div class="progress col s11">
                    <div class="determinate" style="width: 5%"></div>
                </div>
                <div class="col s1">{{__('1/20')}}</div>
            </div>
            <div class="col s12 d-flex justify-content-center">
                <ul class="pagination">
                    {{-- <li class="disabled"><a href="#!"><i class="material-icons">chevron_left</i></a></li> --}}
                    <li class="active"><a href="#!">1</a></li>
                    <li class="waves-effect"><a href="#!">2</a></li>
                    <li class="waves-effect"><a href="#!">3</a></li>
                    <li class="waves-effect"><a href="#!">4</a></li>
                    <li class="waves-effect"><a href="#!">5</a></li>
                    <li class="waves-effect"><a href="#!">6</a></li>
                    <li class="waves-effect"><a href="#!">7</a></li>
                    <li class="waves-effect"><a href="#!">8</a></li>
                    <li class="waves-effect"><a href="#!">9</a></li>
                    <li class="waves-effect"><a href="#!">10</a></li>
                    <li class="waves-effect"><a href="#!">11</a></li>
                    <li class="waves-effect"><a href="#!">12</a></li>
                    <li class="waves-effect"><a href="#!">13</a></li>
                    <li class="waves-effect"><a href="#!">14</a></li>
                    <li class="waves-effect"><a href="#!">15</a></li>
                    <li class="waves-effect"><a href="#!">16</a></li>
                    <li class="waves-effect"><a href="#!">17</a></li>
                    <li class="waves-effect"><a href="#!">18</a></li>
                    <li class="waves-effect"><a href="#!">19</a></li>
                    <li class="waves-effect"><a href="#!">20</a></li>
                    <li class="waves-effect"><a href="#!">21</a></li>
                    <li class="waves-effect"><a href="#!">22</a></li>
                    {{-- <li class="waves-effect"><a href="#!"><i class="material-icons">chevron_right</i></a></li> --}}
                </ul>
            </div>
            <div class="col s12">
                <div class="col s10 offset-s1">
                    <h5>Question 1: <span class="flow-text">What is your name?</span></h5>
                    <div class="col s10 offset-s1">
                        <p>
                            <input class="with-gap" name="choice1" type="radio" id="choice1"/>
                            <label class="black-text" for="choice1">Ali</label>
                        </p>
                        <p>
                            <input class="with-gap" name="choice1" type="radio" id="choice2" />
                            <label class="black-text" for="choice2">Jaafar</label>
                        </p>
                        <p>
                            <input class="with-gap" name="choice1" type="radio" id="choice3" />
                            <label class="black-text" for="choice3">Sma33in</label>
                        </p>
                        <p>
                            <input class="with-gap" name="choice1" type="radio" id="choice4" />
                            <label class="black-text" for="choice4">Amine</label>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col s12 d-flex justify-content-center">
                <button type="button" class="btn-flat waves-effect waves-light deep-orange accent-3 white-text">Valider</button>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{asset('js/countdown.js')}}"></script>
@endsection

@section('countdowncss')
    <link rel="stylesheet" href="{{asset('css/countdown.css')}}">
@endsection