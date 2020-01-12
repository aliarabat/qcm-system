@component('mail::message')
# Introduction

Chers étudiant {{$user->last_name}} {{$user->first_name}},<br>

Vous trouverez ci-joint les coordonnées pour accéder à la plateforme UCA E-Learning & Testing:<br>
Votre email: {{$user->email}}<br>
Votre mot de passe: <strong>{{$password}}</strong><br>

@component('mail::button', ['url' => $url])
Activer mon compte
@endcomponent

Merci,<br>
{{ config('app.name') }}
@endcomponent
