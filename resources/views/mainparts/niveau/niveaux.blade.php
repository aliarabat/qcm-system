@extends('layouts.mainlayout')
@section('mainContent')
    <meta name="csrf-token" content="{!! csrf_token() !!}">
    <div class="row z-depth-4 mt-p-1" style="padding-top: 10%">
        @if($message = Session::get('status'))


        <div class="alert" style="padding: 20px;
        background-color: green;
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
            style="padding-left: 40%;padding-bottom: 5%; font-family: 'Raleway',sans-serif; font-size: 40px; font-weight: 800; line-height: 72px; margin: 0 0 24px; text-align: center; text-transform: uppercase; ">Niveaux</span>
        <br><br><br>
        <div class="row" >
<div class="col s12">
    <div class="col s6">
        <a class="btn-flat waves-effect waves-light deep-orange accent-3 btn-small white-text"
        href="{{route('mainParts.niveau.createNiveau')}}"> <i class="material-icons right">add</i>
         Ajout d'un nouveau Niveau</a>
    </div>
    <div class="col s6">
        <nav style="background-color: orangered;height:40px">
        <div class="nav-wrapper">
            <form>
              <div class="input-field">
                <input id="search" type="search" required>
                <label class="label-icon" for="search"><i class="material-icons">search</i></label>
                <i class="material-icons">close</i>
              </div>
            </form>
          </div>
        </nav>
    </div>




</div>


        </div>
        <br>
        <div id="niveau" class="col s12">
            <!-- list des Niveaux-->
            <div class="row">
                <table class="centered" id="tableNiveaux">
                    <thead>
                    <tr>
                        <th>Niveau</th>
                        <th>Type</th>
                        <th>Date de création</th>
                        <th>Actions</th>
                    </tr>
                    </thead>

                    <tbody>
                    @forelse ($niveaux as $niveau)
                        <tr>
                            <td>{{$niveau->niveau}}</td>
                            <td>{{$niveau->type}}</td>
                            <td>{{$niveau->updated_at}}</td>

                            <td>
                                <a href="#modal1"
                                   onclick='return onUpdateNiveau({{$niveau->id}}, "{{$niveau->niveau}}", "{{$niveau->type}}",false)'
                                   class="light-blue-text text-darken-4 tooltipped modal-trigger" data-position="top"
                                   data-tooltip="Mettre à jour">
                                    <div class="material-icons">edit</div>
                                </a>
                                <a href="#delete1" onclick="return onDeleteNiveau({{$niveau->id}},false)"
                                   class="red-text text-accent-4 tooltipped modal-trigger" data-position="top"
                                   data-tooltip="Supprimer">
                                    <div class="material-icons">delete</div>
                                </a>
                            </td>
                        </tr>
                    @empty
                    @endforelse


                    </tbody>
                </table>
            </div>
            <!-- END - list des Niveaux-->
        </div>
    </div>
@endsection

<!-- Modals-->
<!-- Update niveau -->
<div id="modal1" class="modal">
    <div class="modal-content">
        <h4>Mise à jour</h4>
        <div class="row">
            <input type="hidden" name="id" value=" ">
            <div class="input-field col s12">
                <input type="text" name="updatedNiveau" value=" "/>
                <label for="Niveau">Niveau</label>
            </div>
            <div class="input-field col s12">
                <input type="text" name="updatedTypeNiveau" value=" "/>
                <label for="Niveau">Type</label>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <a class="modal-close waves-effect waves-light btn-flat">Annuler</a>
        <a onclick="return onUpdateNiveau(null, null, null, true)"
           class="waves-effect waves-light btn-flat deep-orange accent-4 white-text">Mettre à jour</a>
    </div>
</div>

<!-- Delete niveau -->
<div id="delete1" class="modal">
    <div class="modal-content">
        <h4>Suppression</h4>
        <p>Voulez-vous vraiment supprimer ce Niveau?</p>
        <input type="hidden"/>
    </div>
    <div class="modal-footer">
        <a class="modal-close waves-effect waves-light btn-flat">Annuler</a>
        <a onclick="return onDeleteNiveau(null, true)"
           class="waves-effect waves-light btn-flat materialize-red white-text">Supprimer</a>
    </div>
</div>
@section('script')
    <script src="{{asset('js/niveau.js')}}"></script>
@endsection
