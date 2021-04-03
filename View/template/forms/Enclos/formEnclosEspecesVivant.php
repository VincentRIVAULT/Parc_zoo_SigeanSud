<div class="justify-content">
    <!-- <h2>Formulaire d'ajout d'especes dans un enclos</h2> -->
    <div class="col-md-10 offset-1 mb-5 mt-5">
        <form method="POST" action="index.php?controller={class}&action={action}">
            <!-- Input de l'ID en display none -->
            <div class="form-group">
                <label for="codENC" >ID</label>
                <input type="text" id="codENC" name="codENC" value="{codENC}" class="form-control" readonly>
            </div>
            
            <!-- Dupliquez cet élément selon vos besoins -->
            <div class="form-group">
                <label for="codESP">Code de l'espece :</label>
                <input type="text" id="codESP" name="codESP" value="{codESP}" class="form-control">
                <!-- <textarea type="text" id="codESP" name="codESP" value="" class="form-control" cols="30" rows="30">{codESP}</textarea> -->
                <!-- <select id="codESP" name="codESP" class="form-control">
                    <option></option>
                    {especesVivant}
                </select> -->
            </div>
            <!-- Dupliquez cet élément selon vos besoins -->

            <button type="submit" class="btn btn-success"><i class="fas fa-check"></i> Valider</button>
            <button type="submit" formaction="index.php?controller={class}&action=edit" class="btn btn-danger"><i class="fas fa-undo-alt"></i> Retour</button>
        </form>
    </div>
</div>
