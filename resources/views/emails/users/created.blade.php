@component('mail::message')

Chers {{$role}} {{$user->last_name}} {{$user->first_name}},<br>

Vous trouverez ci-joint les coordonnées pour accéder à la plateforme UCA E-Learning & Testing:<br>
Votre email: {{$user->email}}<br>
Votre mot de passe: <strong>{{$password}}</strong><br>

@component('mail::button', ['url' => $url])
Se connecter
@endcomponent

Merci,<br>
{{ config('app.name') }}
@endcomponent
