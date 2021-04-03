<div class="justify-content">
	<div class="col-md-10 offset-1 mb-5 mt-5">
        <form method="POST" action="index.php?controller={class}&action={action}">
            <!-- Input de l'ID en display none -->
            <div class="form-group">
                <label for="codOBJ" class="d-none">Code de l'objet :</label>
                <input type="text" id="codOBJ" name="codOBJ" value="{codOBJ}" class="form-control d-none" readonly>
            </div>
            
            <!-- Dupliquez cet élément selon vos besoins -->
            <div class="form-group">
                <label for="nomOBJ">Nom de l'objet :</label>
                <input type="text" id="nomOBJ" name="nomOBJ" value="{nomOBJ}" class="form-control" >
            </div>
            <div class="form-group">
                <!-- <label for="achOBJ">Objet acheté :</label> -->
                <!-- <input type="text" id="achOBJ" name="achOBJ" value="{achOBJ}" class="form-control" > -->
                <input type="radio" id="achOBJ" name="OBJ" value="A" class="form_check-input">
                <label for="achOBJ">Objet acheté</label>
            </div>
            <div class="form-group">
                <!-- <label for="preOBJ">Objet prêté :</label> -->
                <!-- <input type="text" id="preOBJ" name="preOBJ" value="{preOBJ}" class="form-control" > -->
                <input type="radio" id="preOBJ" name="OBJ" value="P" class="form_check-input">
                <label for="preOBJ">Objet prêté</label>
            </div>
            <!-- Dupliquez cet élément selon vos besoins -->

            <button type="submit" class="btn btn-success"><i class="fas fa-check"></i> Valider</button>
            <button type="submit" formaction="index.php?controller={class}&action=edit" class="btn btn-danger"><i class="fas fa-undo-alt"></i> Retour</button>
        </form>
    </div>
</div>
