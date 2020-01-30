@extends('layouts.mainLayout')
@section('mainContent')
    <div class="row z-depth-4 mt-p-1" style="padding-top: 12%">
        @if($message = Session::get('status'))
     

        <div class="alert" style="padding: 20px;
        background-color: #f44336;
        color: white;
        margin-bottom: 15px;">
            <span class="closebtn" style="margin-left: 15px;
            color: white;
            font-weight: bold;
            float: right;
            font-size: 22px;
            line-height: 20px;
            cursor: pointer;
            transition: 0.3s;" onclick="this.parentElement.style.display='none';">&times;</span>
            {{ $message }}
          </div>
            
        @endif
        <br>
        <span
            style="padding-left: 18%;padding-bottom: 5%; font-family: 'Raleway',sans-serif; font-size: 40px; font-weight: 800; line-height: 72px; margin: 0 0 24px; text-align: center; text-transform: uppercase; ">Ajout d'un nouveau niveau</span>
        <br><br><br>
        <!--Niveau-->
        <div id="niveau" class="col s12">

            <div style="display: flex; align-items: center;">

                <form id="niveau-form" method="post" action="{{route('mainParts.niveau.createNiveau.create')}}"
                      class="col s12">
                    @csrf

                    <div class="input-field col s6 ">
                        <input id="niveauIn" name="niveau" type="text"/>
                        <label for="niveauIn">Niveau</label>
                    </div>
                    <div class="input-field col s6">
                        <input id="typeIn" name="type" type="text"/>
                        <label for="typeIn">Type</label>
                    </div>
                    <div class="col s2 offset-s5">
                        <button id="niveauSubmit" type="submit"
                                value="{{route('mainParts.niveau.createNiveau.create')}}"
                                class="btn waves-effect waves-light btn-flat white-text deep-orange accent3">Créer
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
@endsection
@section('script')
    <script src="{{asset('js/createNiveau.js')}}"></script>
@endsection
