<div class="row">
    <div class="input-field col s6">
        <input  id="CIN" name="CIN" type="text" required/>
        <label for="CIN">CIN</label>
    </div>
    @yield('codemassar')
    <div class="input-field col s6 ">
        <input id="nom" name="nom" type="text" required/>
        <label for="nom">Nom</label>
    </div>
    <div class="input-field col s6">
        <input  id="prenom" name="prenom" type="text"/>
        <label for="prenom">Prénom</label>
    </div>
    <div class="input-field col s6">
        <input  id="emailAcadémique" name="emailAcadémique" type="email"/>
        <label for="emailAcadémique">Email académique</label>
    </div>
    <div class="input-field col s6">
        <input  id="email" name="email" type="email"/>
        <label for="email">Email</label>
    </div>
</div>
<div class="row center-align">
    <button type="submit" class="btn waves-effect waves-light btn-flat white-text deep-orange accent3">Créer</button>
</div>