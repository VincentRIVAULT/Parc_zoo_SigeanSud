<div class="justify-content">
	<div class="col-md-10 offset-1 mb-5 mt-5">
        <h2>Formulaire d'insertion d'une Espèce</h2>
        <form method="POST" action="index.php?controller={class}&action={action}">
            <!-- Input de l'ID en display none -->
            <div class="form-group">
                <label for="codESP">Code de l'Espèce</label>
                <input type="text" id="codESP" name="codESP" value="{codESP}" class="form-control" readonly>
            </div>
            
            <!-- Dupliquez cet élément selon vos besoins -->
            <div class="form-group">
                <label for="nomESP">Nom de l'Espèce :</label>
                <input type="text" id="nomESP" name="nomESP" value="{nomESP}" class="form-control" autofocus>
                <!-- <textarea type="text" id="nomESP" name="nomESP" value="" class="form-control" cols="30" rows="10">{nomESP}</textarea> -->
            </div>
        </br>
            <button type="submit" class="btn btn-success"><i class="fas fa-check"></i> Valider</button>
            <button type="submit" formaction="index.php?controller={class}&action=edit" class="btn btn-danger"><i class="fas fa-undo-alt"></i> Retour</button>
        </form>
    </div>
</div>