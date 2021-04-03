<div class="justify-content">
	<div class="col-md-10 offset-1 mb-5 mt-5">
        <h2>Formulaire d'insertion/modification d'un Menu</h2>
        <form method="POST" action="index.php?controller={class}&action={action}">
            <!-- Input de l'ID en display none -->
            <div class="form-group">
                <label for="codMEN">Menu</label>
                <input type="text" id="codMEN" name="codMEN" value="{codMEN}" class="form-control" readonly>
            </div>
            <!-- Dupliquez cet élément selon vos besoins -->
            <div class="form-group">
                <label for="libMEN">Libellé du Menu :</label>
                <input type="text" id="libMEN" name="libMEN" value="{libMEN}" class="form-control" autofocus>
                <!-- <textarea type="text" id="nomESP" name="nomESP" value="" class="form-control" cols="30" rows="10">{nomESP}</textarea> -->
            </div>
            <div class="form-group">
                <label for="qteRMEN">Quantité recommandée du Menu :</label>
                <input type="text" id="qteRMEN" name="qteRMEN" value="{qteRMEN}" class="form-control" autofocus>
                <!-- <textarea type="text" id="nomESP" name="nomESP" value="" class="form-control" cols="30" rows="10">{nomESP}</textarea> -->
            </div>
            <div class="form-group">
                <label for="codESP">Code de l'espèce</label>
                <input type="text" id="codESP" name="codESP" value="{codESP}" class="form-control" autofocus>
            </div>
        </br>
        <button type="submit" class="btn btn-success"><i class="fas fa-check"></i> Valider</button>
        <button type="submit" formaction="index.php?controller={class}&action=edit" class="btn btn-danger"><i class="fas fa-undo-alt"></i> Retour</button>
        </form>
    </div>
</div>