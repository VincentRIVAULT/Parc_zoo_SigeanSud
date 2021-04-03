<div class="justify-content">
    <div class="col-md-10 offset-1 mb-5 mt-5">
        <form method="POST" action="index.php?controller={class}&action={action}">
            <!-- Input de l'ID en display none -->
            <div class="form-group">
                <label for="codOBJ" class="d-none">ID</label>
                <input type="text" id="codOBJ" name="codOBJ" value="{codOBJ}" class="form-control d-none" readonly>
            </div>
            
            <!-- Dupliquez cet élément selon vos besoins -->
            <div class="form-group">
                <label for="codENC">Code de l'enclos :</label>
                <input type="text" id="codENC" name="codENC" value="{codENC}" class="form-control">
                <!-- <textarea type="text" id="codENC" name="codENC" value="" class="form-control" cols="30" rows="30">{codENC}</textarea> -->
            </div>
            <div class="form-group">
                <label for="qteOBJ">Quantité de l'objet :</label>
                <input type="text" id="qteOBJ" name="qteOBJ" value="{qteOBJ}" class="form-control">
                <!-- <textarea type="text" id="qteOBJ" name="qteOBJ" value="" class="form-control" cols="30" rows="30">{qteOBJ}</textarea> -->
            </div>
            <!-- Dupliquez cet élément selon vos besoins -->

            <button type="submit" class="btn btn-success"><i class="fas fa-check"></i> Valider</button>
            <button type="submit" formaction="index.php?controller={class}&action=edit" class="btn btn-danger"><i class="fas fa-undo-alt"></i> Retour</button>
        </form>
    </div>
</div>
