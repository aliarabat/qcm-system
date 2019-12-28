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
                    <tr>
                        <td>What is ur name</td>
                        <td>Zouani Younes</td>
                        <td>{{Carbon\Carbon::now()}}</td>
                        <td>{{Carbon\Carbon::now()}}</td>
                        <td class="d-flex justify-content-between">
                            <p>
                                <input class="with-gap" value="1-valid" type="radio" name="questionValidity" id="valid">
                                <label for="valid" class="black-text">Valid</label>
                            </p>
                            <p>
                                <input class="with-gap" value="1-free" type="radio" name="questionValidity" id="free">
                                <label for="free" class="black-text">Free</label>
                            </p>
                            <p>
                                <input class="with-gap" value="1-invalid" type="radio" name="questionValidity" id="invalid">
                                <label for="invalid" class="black-text">Invalid</label>
                            </p>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col s12 d-flex justify-content-center">
            <ul class="pagination">
                <li class="disabled"><a href="#!"><i class="material-icons">chevron_left</i></a></li>
                <li class="active"><a href="#">1</a></li>
                <li class="waves-effect"><a href="#">2</a></li>
                <li class="waves-effect"><a href="#!"><i class="material-icons">chevron_right</i></a></li>
            </ul>
        </div>
    </div>

@endsection

@section('script')
    <script src="{{asset('js/questions.js')}}"></script>
@endsection
