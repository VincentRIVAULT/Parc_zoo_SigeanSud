<div class="justify-content">
	<div class="col-md-4 offset-4 mb-5 mt-5">
        <form method="POST" action="index.php?controller={class}&action={action}">
            <!-- Input de l'ID en display none -->
            <div class="form-group">
                <label for="idPRO" class="d-none">ID</label>
                <input type="text" id="idPRO" name="idPRO" value="{idPRO}" class="form-control d-none" readonly>
            </div>
            
            <!-- Dupliquez cet élément selon vos besoins -->
            <div class="form-group">
                <label for='identifiant'>Identifiant :</label>
                <input type="text" id='identifiant' name="identifiant" value="{identifiant}" class="form-control" autofocus>
            </div>
            <div class="form-group">
                <label for='mdp'>Mot de passe :</label>
                <input type="text" id='mdp' name="mdp" value="{mdp}" class="form-control">
            </div>
            <div class="form-group">
                <label for='nom'>Nom :</label>
                <input type="text" id='nom' name="nom" value="{nom}" class="form-control">
            </div>
            <div class="form-group">
                <label for='prenom'>Prénom :</label>
                <input type="text" id="prenom" name="prenom" value="{prenom}" class="form-control">
            </div>
            <div class="form-group">
                <label for='adresse'>Adresse :</label>
                <input type="text" id='adresse' name="adresse" value="{adresse}" class="form-control">
            </div>
            <div class="form-group">
                <label for='telephone'>Téléphone :</label>
                <input type="text" id="telephone" name="telephone" value="{telephone}" class="form-control">
            </div>
            <div class="form-group">
                <label for='role'>Rôle :</label>
                <input type="text" id="role" name="role" value="{role}" class="form-control">
            </div>
            <!-- Dupliquez cet élément selon vos besoins -->

            <button type="submit" class="btn btn-success"><i class="fas fa-check"></i> Valider</button>
            <button type="submit" formaction="index.php?controller={class}&action=edit" class="btn btn-danger"><i class="fas fa-undo-alt"></i> Retour</button>
        </form>
    </div>
</div>
