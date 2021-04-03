<div class="justify-content">
	<div class="col-md-10 offset-1 mb-5 mt-5">
        <h2>Formulaire d'insertion des Parents</h2>
        <form method="POST" action="index.php?controller={class}&action={action}">
            <div class="form-group">
                <label for="parANI">Code de l'Espèce Parent</label>
                <input type="text" id="parANI" name="parANI" value="{parANI}" class="form-control" autofocus >
            </div>
            <!-- Dupliquez cet élément selon vos besoins -->
            <div>
                <label for="nomPANI">Nom de l'animal Parent :</label>
                <input type="text" id="nomPANI" name="nomPANI" value="{nomPANI}" class="form-control" autofocus>
            </div>
            <div class="form-group">
                <label for="enfANI">Code de l'Espèce Enfant</label>
                <input type="text" id="enfANI" name="enfANI" value="{enfANI}" class="form-control" autofocus>
            </div>
            <div>
                <label for="nomEANI">Nom de l'animal Enfant :</label>
                <input type="text" id="nomEANI" name="nomEANI" value="{nomEANI}" class="form-control" autofocus>
            </div>
            </br>           
            <button type="submit" class="btn btn-success"><i class="fas fa-check"></i> Valider</button>
            <button type="submit" formaction="index.php?controller={class}&action=edit" class="btn btn-danger"><i class="fas fa-undo-alt"></i> Retour</button>
        </form>
    </div>
</div>
