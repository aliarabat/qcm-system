@extends('layouts.mainLayout')

@section('mainContent')
    <div class="row z-depth-4 mt-p-1">
        <form id="create-professor-form" method="POST" data-route="{{route('professors.create')}}">
            @csrf
            @include('layouts.forms.agentsform')
        </form>
        @include('layouts.forms.line')
        <form id="form-import" data-route="{{route('students.creation')}}" enctype="multipart/form-data" class="d-flex justify-content-center align-items-center">
            @include('layouts.forms.fileupload')
        </form>
    </div>
@endsection

@section('script')
    <script src="{{asset('js/professors.js')}}"></script>
@endsection