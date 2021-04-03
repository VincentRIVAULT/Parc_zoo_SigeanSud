<div class="justify-content">
    <!-- <h2>Formulaire d'ajout d'objets présents dans un enclos</h2> -->
    <div class="col-md-10 offset-1 mb-5 mt-5">
        <form method="POST" action="index.php?controller={class}&action={action}">
            <!-- Input de l'ID en display none -->
            <div class="form-group">
                <label for="codENC" >ID</label>
                <input type="text" id="codENC" name="codENC" value="{codENC}" class="form-control" readonly>
            </div>
            
            <!-- Dupliquez cet élément selon vos besoins -->
            <div class="form-group">
                <label for="codOBJ">Nom de l'objet :</label>
                <!-- <input type="text" id="codOBJ" name="codOBJ" value="{codOBJ}" class="form-control"> -->
                <!-- <textarea type="text" id="codOBJ" name="codOBJ" value="" class="form-control" cols="30" rows="30">{codOBJ}</textarea> -->
                <select id="codOBJ" name="codOBJ" class="form-control">
                    <option></option>
                    {objets}
                </select>
            </div>
            <div class="form-group">
                <label for="qteOBJ">Quantité de l'objet :</label>
                <input type="text" id="qteOBJ" name="qteOBJ" value="{qteOBJ}" class="form-control">
                <!-- <textarea type="text" id="qteOBJ" name="qteOBJ" value="" class="form-control" cols="30" rows="30">{qteOBJ}</textarea> -->
                <!-- <select id="qteOBJ" name="qteOBJ" class="form-control">
                    <option></option>
                    {objetsPresents}
                </select> -->
            <!-- </div> -->
            <!-- <div class="form-group">
                <label for="achOBJ">Quantité de l'objet acheté :</label>
                <input type="text" id="achOBJ" name="achOBJ" value="{achOBJ}" class="form-control">
            </div>
            <div class="form-group">
                <label for="preOBJ">Quantité de l'objet prêté :</label>
                <input type="text" id="preOBJ" name="preOBJ" value="{preOBJ}" class="form-control">
            </div> -->
            <!-- Dupliquez cet élément selon vos besoins -->

            <button type="submit" class="btn btn-success"><i class="fas fa-check"></i> Valider</button>
            <button type="submit" formaction="index.php?controller={class}&action=edit" class="btn btn-danger"><i class="fas fa-undo-alt"></i> Retour</button>
        </form>
    </div>
</div>
