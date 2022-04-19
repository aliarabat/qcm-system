<ul id="slide-out" class="side-nav collapsible" data-collapsible="accordion">
    @can('show-qcm')
    <li>
        <div class=" collapsible-header"><i class="material-icons">dashboard</i>QCM</div>
        @can('create', App\Question::class)
        {{-- <div class="collapsible-body"><a href="{{route('questions.index')}}">Mes questions</a></div> --}}
        <div class="collapsible-body {{Route::currentRouteName()==='questions.create'?'nav-link-active': ''}}"><a
                href="{{route('questions.create')}}">Création des questions</a></div>
        @endcan
        @can('create', App\Niveau::class)
        <div class="collapsible-body {{Route::currentRouteName()==='mainParts.create'?'nav-link-active': ''}}"><a
                href="{{route('mainParts.create')}}">Plan pédagogique</a></div>
        @endcan
        @can('validate', App\Question::class)
        <div class="collapsible-body"><a href="{{route('questions.validations')}}">Validations</a></div>
        @endcan
    </li>
    @endcan

    @can('show-eveluations')
    <li>
        <div class=" collapsible-header"><i class="material-icons">work</i>Evaluations</div>
        @can('create', App\Question::class)
        <div class="collapsible-body"><a href="{{route('evaluations.create')}}">Création</a></div>
        @endcan
        @can('passer', App\Question::class)
        <div class="collapsible-body"><a href="{{route('evaluations.index')}}">Commencer</a></div>
        @endcan
        @can('create', App\Question::class)
        <div class="collapsible-body"><a href="{{route('evaluations.results')}}">Résultats</a></div>
        @endcan
    </li>
    @endcan
    {{-- ------------------done-------------- --}}
    @can('create', App\Niveau::class)
    <li>
        <div class=" collapsible-header"><i class="material-icons">supervisor_account</i>Professeurs</div>
        <div class="collapsible-body"><a href="{{route('professors.index')}}">Création</a></div>
    </li>
    <li>
        <div class=" collapsible-header"><i class="material-icons">supervised_user_circle</i>Etudiants</div>
        <div class="collapsible-body"><a href="{{route('students.index')}}">Création</a>
    </li>
    </li>
    <li>
        <div class=" collapsible-header"><i class="material-icons">group_add</i>Affectations</div>
        <div class="collapsible-body"><a href="{{route('affectationProfessor.index')}}">Professeurs</a></div>
        <div class="collapsible-body"><a href="{{route('affectationStudent.index')}}">Etudiants</a></div>
    </li>
    @endcan
</ul>
