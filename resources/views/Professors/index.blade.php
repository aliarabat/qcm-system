@extends('layouts.mainLayout')

@section('mainContent')

    <div class="row z-depth-4 mt-p-1">
        <form id="create-professor-form" data-route="{{route('professors.store')}}">
            @include('layouts.forms.agentsform')
        </form>
        @include('layouts.forms.line')
        <form id="form-import" data-route="{{route('professors.store')}}" enctype="multipart/form-data" class="d-flex justify-content-center align-items-center">
            @include('layouts.forms.fileupload')
        </form>
    </div>

@endsection

@section('script')
    <script src="{{asset('js/professors.js')}}"></script>
@endsection