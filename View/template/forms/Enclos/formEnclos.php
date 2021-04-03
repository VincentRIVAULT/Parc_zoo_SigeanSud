<div class="justify-content">
	<div class="col-md-10 offset-1 mb-5 mt-5">
        <!-- <h3>enclos</h3> -->
        <form method="POST" action="index.php?controller={class}&action={action}">
            <!-- Input de l'ID en display none -->
            <div class="form-group">
                <label for="codENC" class="d-none">ID</label>
                <input type="text" id="codENC" name="codENC" value="{codENC}" class="form-control d-none" readonly>
            </div>
            
            <!-- Dupliquez cet élément selon vos besoins -->
            <div class="form-group">
                <label for="nomENC">Nom de l'enclos :</label>
                <input type="text" id="nomENC" name="nomENC" value="{nomENC}" class="form-control" autofocus>
                <!-- <textarea type="text" id="nomENC" name="nomENC" value="" class="form-control" cols="30" rows="10">{nomENC}</textarea> -->
            </div>
            <div class="form-group">
                <label for="supENC">Superficie de l'enclos en m² :</label>
                <input type="text" id="supENC" name="supENC" value="{supENC}" class="form-control">
                <!-- <textarea type="text" id="supENC" name="supENC" value="" class="form-control" cols="30" rows="30">{supENC}</textarea> -->
            </div>
            <!-- Dupliquez cet élément selon vos besoins -->

            <button type="submit" class="btn btn-success"><i class="fas fa-check"></i> Valider</button>
            <button type="submit" formaction="index.php?controller={class}&action=edit" class="btn btn-danger"><i class="fas fa-undo-alt"></i> Retour</button>
        </form>
    </div>
</div>
