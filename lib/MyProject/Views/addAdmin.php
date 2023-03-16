<div class="article d-flex flex-column align-items-center">
        <h2 class="h2 mb-5">Ajouter un administrateur</h2>
        <form method="POST" action="/creer-administrateur">
        <div class="mb-3">
            <label for="surname" class="form-label required">Nom</label>
            <input required type="text" class="form-control" id="surname" name="data[surname]">
        </div>
        <div class="mb-3">
            <label for="firstname" class="form-label required">Prénom</label>
            <input required type="text" class="form-control" id="firstname" name="data[firstname]">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label required">Email</label>
            <input required type="email" class="form-control" id="email" name="data[email]">
        </div>
        <div class="mb-3">
            <label for="phoneNumber" class="form-label required">Numéro de téléphone</label>
            <input required type="phone" class="form-control" id="phoneNumber" name="data[phoneNumber]">
        </div>
        <div class="mb-3">
            <label for="password" class="form-label required">Mot de passe</label>
            <input required type="password" class="form-control" id="password" name="data[password]">
        </div>
            <input type="text" id="url" name="url" value="/creer-administrateur">
            <button type="submit" class="btn btn-secondary">Créer</button>
        </form>
    </div>
