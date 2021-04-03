<div class="justify-content">
    <!-- <h2>Formulaire d'ajout d'animaux habitant dans un enclos</h2> -->
    <div class="col-md-10 offset-1 mb-5 mt-5">
        <form method="POST" action="index.php?controller={class}&action={action}">
            <!-- Input de l'ID en display none -->
            <div class="form-group">
                <label for="codENC" >ID</label>
                <input type="text" id="codENC" name="codENC" value="{codENC}" class="form-control" readonly>
            </div>
            
            <!-- Dupliquez cet élément selon vos besoins -->
            <div class="form-group">
                <label for="codESP">Code de l'espèce :</label>
                <input type="text" id="codESP" name="codESP" value="{codESP}" class="form-control">
                <!-- <textarea type="text" id="codESP" name="codESP" value="" class="form-control" cols="30" rows="30">{codESP}</textarea> -->
            </div>
            <div class="form-group">
                <label for="nomANI">Nom de l'animal :</label>
                <input type="text" id="nomANI" name="nomANI" value="{nomANI}" class="form-control">
                <!-- <textarea type="text" id="nomANI" name="nomANI" value="" class="form-control" cols="30" rows="30">{nomANI}</textarea> -->
                <!-- <select id="nomANI" name="nomANI" class="form-control">
                    <option></option>
                    {animauxOccupant}
                </select> -->
            </div>
            <div class="form-group">
                <label for="date_debut">Date de début :</label>
                <input type="date" id="date_debut" name="date_debut" value="{date_debut}" class="form-control">
                <!-- <textarea type="date" id="date_debut" name="date_debut" value="" class="form-control" cols="30" rows="30">{date_debut}</textarea> -->
            </div>
            <div class="form-group">
                <label for="encours">Encours :</label>
                <input type="text" id="encours" name="encours" value="{encours}" class="form-control">
                <!-- <textarea type="text" id="encours" name="encours" value="" class="form-control" cols="30" rows="30">{encours}</textarea> -->
            </div>
            <!-- Dupliquez cet élément selon vos besoins -->

            <button type="submit" class="btn btn-success"><i class="fas fa-check"></i> Valider</button>
            <button type="submit" formaction="index.php?controller={class}&action=edit" class="btn btn-danger"><i class="fas fa-undo-alt"></i> Retour</button>
        </form>
    </div>
</div>
