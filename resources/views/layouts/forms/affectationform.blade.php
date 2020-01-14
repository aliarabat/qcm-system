@csrf
<div class="input-field col s6">
    <input type="hidden" id="routeNiveau" value="{{route('affectationProfessor.filieresNiveau')}}">
    <select name="niveau" id="niveau">
        <option  value="Niveau" selected disabled>Niveau</option>
                                    @forelse ($niveaux as $niveau)
                                    <option  value="{{$niveau->id}}">{{$niveau->niveau}}-{{$niveau->type}}</option>
                                    @empty
                                    @endforelse
    </select>
    <label for="niveau">Niveau</label>
</div>
<div class="input-field col s6">
    <input type="hidden" id="routeFiliere" value="{{route('affectationProfessor.semestresFiliere')}}">
    <select name="filiere" id="filiere">

    </select>
    <label for="filiere">Filière</label>
</div>
<div class="input-field col s6">
    <input type="hidden" id="routeSemestre" value="{{route('affectationProfessor.modulesSemestre')}}">
    <select name="semestre" id="semestre">

    </select>
    <label for="semestre">Semestre</label>
</div>