@extends('layouts.mainLayout')

@section('mainContent')

    <div class="row z-depth-4 mt-p-1">
        <form id="create-student-form" data-route="{{route('students.creation')}}">
            @csrf
            @section('codemassar')
                <div class="input-field col s6">
                    <input  id="codeMassar" name="codeMassar" type="text" required/>
                    <label for="codeMassar">Code Massar</label>
                </div>
            @endsection
            @include('layouts.forms.agentsform')
        </form>
        @include('layouts.forms.line')
        <form id="form-import" data-route="{{route('students.creation')}}" enctype="multipart/form-data" class="d-flex justify-content-center align-items-center">
            @include('layouts.forms.fileupload')
        </form>
    </div>

@endsection

@section('script')
    <script src="{{asset('js/students.js')}}"></script>
@endsection