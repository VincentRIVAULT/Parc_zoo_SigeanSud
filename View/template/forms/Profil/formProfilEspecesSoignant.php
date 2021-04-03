<div class="justify-content">
	<div class="col-md-4 offset-4 mb-5 mt-5">
        <form method="POST" action="index.php?controller={class}&action={action}">
            <!-- Input de l'ID en display none -->
            <div class="form-group">
                <label for="idPRO" class="">ID</label>
                <input type="text" id="idPRO" name="idPRO" value="{idPRO}" class="form-control" readonly>
            </div>
            
            <!-- Dupliquez cet élément selon vos besoins -->
            <div class="form-group">
                <label for='codESP'>Espèce confiée :</label>
                <input type="text" id='codESP' name="codESP" value="{codESP}" class="form-control" autofocus>
            </div>
            
            <!-- Dupliquez cet élément selon vos besoins -->

            <button type="submit" class="btn btn-success"><i class="fas fa-check"></i> Valider</button>
            <button type="submit" formaction="index.php?controller={class}&action=edit" class="btn btn-danger"><i class="fas fa-undo-alt"></i> Retour</button>
        </form>
    </div>
</div>
