<div class="justify-content">
	<div class="col-md-10 offset-1 mb-5 mt-5">
        <!-- <h2>animal</h2> -->
        <form method="POST" action="index.php?controller={class}&action={action}">
            <!-- Input de l'ID en display none -->
            <div class="form-group">
                <label for="codESP">Espèce de l'animal :</label>
                <input type="text" id="codESP" name="codESP" value="{codESP}" class="form-control" autofocus>
                <!-- <select id="codESP" name="codESP" class="form-control">
                    <option></option>
                    {especesID}
                </select> -->
            </div>
            
            <!-- Dupliquez cet élément selon vos besoins -->
            <div class="form-group">
                <label for="nomANI">Nom de l'animal :</label>
                <input type="text" id="nomANI" name="nomANI" value="{nomANI}" class="form-control" >
            </div>
            <!-- <div class="form-group">
                <label for="sexeANI">Sexe de l'animal :</label>
                <input type="text" id="sexeANI" name="sexeANI" value="{sexeANI}" class="form-control">
            </div> -->
            
            <div class="form-check">
                <input type="radio" name="sexeANI" id="sexeMANI" value="M" class="form_check-input">
                <label for="sexeMANI"> Mâle </label>
            </div>
            <div class="form-check">
                <input type="radio" name="sexeANI" id="sexeFANI" value="F" class="form_check-input">
                <label for="sexeFANI"> Femelle </label>
            </div>
            
           
            <div class="form-group">
                <label for="dnANI">Date de naissance :</label>
                <input type="date" id="dnANI" name="dnANI" value="{dnANI}" class="form-control"/>
            </div>
            <div class="form-group">
                <label for="ddANI">Date de décès :</label>
                <input type="date" id="ddANI" name="ddANI" value="{ddANI}" class="form-control"/>
            </div>
        </br>
            <button type="submit" class="btn btn-success"><i class="fas fa-check"></i> Valider</button>
            <button type="submit" formaction="index.php?controller={class}&action=edit" class="btn btn-danger"><i class="fas fa-undo-alt"></i> Retour</button>
        </form>
    </div>
</div>
