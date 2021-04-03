<div class="justify-content">
	<div class="col-md-10 offset-1 mb-5 mt-5">
        <h2>Formulaire d'insertion/modification d'un Repas distribuée</h2>
        <form method="POST" action="index.php?controller={class}&action={action}">
            <!-- Input de l'ID en display none -->
            <div class="form-group">
                <label for="codESP">Code de l'Espèce</label>
                <input type="text" id="codESP" name="codESP" value="{codESP}" class="form-control" autofocus>
            </div>
            <!-- Dupliquez cet élément selon vos besoins -->
            <div class="form-group">
                <label for="nomANI">nom de l'Animal</label>
                <input type="text" id="nomANI" name="nomANI" value="{nomANI}" class="form-control" autofocus>
                <!-- <textarea type="text" id="nomESP" name="nomESP" value="" class="form-control" cols="30" rows="10">{nomESP}</textarea> -->
            </div>
            <div class="form-group">
                <label for="dhREPMEN">Date et Heure du Repas :</label>
                <input type="datetime-local" pattern="[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1]) ([0-1][0-9]):([0-5][0-9]):([0-5][0-9])" class="form-control" name="dhREPMEN" id="dhREPMEN"  placeholder="aaaa-mm-jj hh:mm" value="{dhREPMEN}">
                <!-- <textarea type="text" id="nomESP" name="nomESP" value="" class="form-control" cols="30" rows="10">{nomESP}</textarea> -->
            </div>
            <div class="form-group">
                <label for="qteDMEN">Quantité distribuée du Menu :</label>
                <input type="text" id="qteDMEN" name="qteDMEN" value="{qteDMEN}" class="form-control" autofocus>
                <!-- <textarea type="text" id="nomESP" name="nomESP" value="" class="form-control" cols="30" rows="10">{nomESP}</textarea> -->
            </div>
            <div class="form-group">
                <label for="codMEN">Code du Menu :</label>
                <input type="text" id="codMEN" name="codMEN" value="{codMEN}" class="form-control" autofocus>
                <!-- <textarea type="text" id="nomESP" name="nomESP" value="" class="form-control" cols="30" rows="10">{nomESP}</textarea> -->
            </div>
        </br>
        <button type="submit" class="btn btn-success"><i class="fas fa-check"></i> Valider</button>
        <button type="submit" formaction="index.php?controller={class}&action=edit" class="btn btn-danger"><i class="fas fa-undo-alt"></i> Retour</button>
        </form>
    </div>
</div>