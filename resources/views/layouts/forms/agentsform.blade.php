@csrf
<div class="row">
    <div class="input-field col s6 ">
        <input id="first_name" name="first_name" type="text" required/>
        <label for="first_name">Prénom</label>
    </div>
    <div class="input-field col s6">
        <input  id="last_name" name="last_name" type="text"/>
        <label for="last_name">Nom</label>
    </div>
    <div class="input-field col s6">
        <input  id="email" name="email" type="email"/>
        <label for="email">Email</label>
    </div>
</div>
<div class="row center-align">
    <button type="submit" class="btn waves-effect waves-light btn-flat white-text deep-orange accent3">Créer</button>
</div>