<?php
// Définition de la classe AnimalView
// la mention "extends" signifie que la classe AnimalView
// hérite des propriétés et méthodes de sa classe mère "View"
class AnimalView extends View {

    /**
     * Affichage de la page Animal côté consultation (liste des animaux)
     *
     * @param [type] $listeAnimaux -> tableau contenant la liste des animaux
     * @return void
     ********************************************************************/
    public function displayListAnimaux($listeAnimaux) {
        
        // Appel du fichier config.php où sont déclarées 
        // les classes et les tables de données correspondantes
        include 'Config/config.php';
        
        $this->page .=
            '<h2>Liste des animaux</h2>
            <table id="tableUser" class="table table-striped mb-0 text-center">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Espèce de l\'animal</th>
                        <th scope="col">Nom de l\'animal</th>
                        <th scope="col">Sexe de l\'animal</th>
                        <th scope="col">Date de naissance de l\'animal</th>
                        <th scope="col">Date de décès de l\'animal</th>
                        <th scope="col">Parents de l\'animal</th>
                        ';
            $this->page .=
                    '</tr>
                        </thead>
                        <tbody>
                    <tr>';
        foreach ($listeAnimaux as $key) {
            $this->page .= '
                        <td>' . $key['nom_espece'] . '</td>
                        <td>' . $key['nomb_animal'] . '</td>
                        <td>' . $key['sexe_animal'] . '</td>
                        <td>' . $key['dn_animal'] . '</td>
                        <td>' . $key['dd_animal'] . '</td>

                        <td> <a href="index.php?controller=' . $classAnimal . '&action=displayAnimalParents&id=' . $key["nomb_animal"] . '">' . $key["nomb_animal"] . '</a></td>
                    </tr>';
        }
            $this->page .=
                        '</tbody>
            </table>';
        // execution de la fonction displayPage() pour afficher la page dans le navigateur    
        $this->displayPage();
    }

    public function displayAnimalParents($animal, $animalParents) {
        include 'Config/config.php';
        
        $this->page .=
            '<h2>Parent de l\'animal : ' . $animal['nomb_animal'] . '</h2>
            <table id="tableUser" class="table table-striped mb-0 text-center">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Espèce de l\'animal parent</th>
                        <th scope="col">Nom de l\'animal parent</th>
                    ';
            $this->page .=
                    '</tr>
                        </thead>
                        <tbody>
                    <tr>';
        foreach ($animalParents as $key) {
            $this->page .= '
                        <td>' . $key['code_espece'] . '</td>
                        <td>' . $key['nomb_animal'] . '</td>
                    </tr>';
        }
            $this->page .=
                        '</tbody>
            </table>';
        
    $this->displayPage();
    }


    public function displayEtatParc($listeAnimauxParc, $listeAnimauxEspecesParc) {
        include 'Config/config.php';
        
        $this->page .=
            '<h2>Population des animaux sur le parc</h2>
            <table id="tableUser" class="table table-striped mb-0 text-center">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Nombre d\'animaux vivants</th>
                        ';
            $this->page .=
                    '</tr>
                        </thead>
                        <tbody>
                    <tr>';
        foreach ($listeAnimauxParc as $key) {
            $this->page .= '
                        
                        <td>' . $key['nbAnimaux'] . '</td>
                    </tr>';
        }
            $this->page .=
                '</tbody>
            </table>
            <br><br>
            ';

            $this->page .=
                '<h3>Population par espèce</h3>
                <table id="tableUser" class="table table-striped mb-0 text-center">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Nom de l\'espèce</th>
                        <th scope="col">Nombre d\'animaux vivants</th>
                        ';
            $this->page .=
                    '</tr>
                        </thead>
                        <tbody>
                    <tr>';
        foreach ($listeAnimauxEspecesParc as $key) {
            $this->page .= 
                        '
                        <td>' . $key['nom_espece'] . '</td>
                        <td>' . $key['nbAnimaux'] . '</td>
                    </tr>';
        }       
            $this->page .=
                '</tbody>
            </table>
            <br><br>
            ';

            $this->displayPage();
    }

    /* <td><a href="index.php?controller=' . $classAnimal . '&action=displayListeAnimauxEspece&id=' . $key["code_espece"] . '">' . $key['nbAnimaux'] . '</td>
    */


    public function displayListeAnimauxEspece($listeAnimalEspeceParc) {
        include 'Config/config.php';
        
            $this->page .=
                '<h2>Liste des animaux par espèce</h2>
                <table id="tableUser" class="table table-striped mb-0 text-center">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Nom de l\'animal</th>
                        ';
            $this->page .=
                    '</tr>
                        </thead>
                        <tbody>
                    <tr>';
        foreach ($listeAnimalEspeceParc as $key) {
            $this->page .= 
                        '
                        <td>' . $key['nomb_animal'] . '</td>
                    </tr>';
        }       
            $this->page .=
                    '</tbody>
                </table>
                <br><br>
                ';
        
        $this->displayPage();
    }


    /**
     * Affichage de la liste des animaux côté mise à jour
     *
     * @param [array] $listeAnimaux -> tableau contenant la liste des animaux
     * @return void
     *******************************************************************/
    public function editListAnimaux($listeAnimaux) {
        include 'Config/config.php';
        
        $this->page .=
            '<h2>Liste des animaux</h2>
            <table id="tableUser" class="table table-striped mb-0 text-center">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Espèce de l\'animal</th>
                        <th scope="col">Nom de l\'animal</th>
                        <th scope="col">Sexe de l\'animal</th>
                        <th scope="col">Date de naissance de l\'animal</th>
                        <th scope="col">Date de décès de l\'animal</th>
                        
                        <th scope="col"><a href="index.php?controller=' . $classAnimal . '&action=addForm">
                        <button class="btn btn-success"><i class="fas fa-plus"></i> Ajouter</button></a></th>
                        <th scope="col"><a href="index.php?controller=' . $classAnimal . '&action=edit">
                        <button class="btn btn-info"><i class="fas fa-undo-alt"></i> Retour</button></a></th>
                        <th scope="col">Parents de l\'animal</th>
                        ';
            $this->page .=
                    '</tr>
                        </thead>
                        <tbody>
                    <tr>';
        foreach ($listeAnimaux as $key) {
            $this->page .='
                        <td>' . $key['nom_espece'] . '</td>
                        <td>' . $key['nomb_animal'] . '</td>
                        <td>' . $key['sexe_animal'] . '</td>
                        <td>' . $key['dn_animal'] . '</td>
                        <td>' . $key['dd_animal'] . '</td>

                        <td><a href="index.php?controller=' . $classAnimal . '&action=delDB&id=' . $key["nomb_animal"] . '">
                        <button class="btn btn-danger"><i class="fas fa-trash-alt"></i> Supprimer</button></a></td>
                        <td><a href="index.php?controller=' . $classAnimal . '&action=editForm&id=' . $key["nomb_animal"] . '"">
                        <button class="btn btn-warning"><i class="fas fa-edit"></i> Modifier</button></a></td>
                        
                        <td> <a href="index.php?controller=' . $classAnimal . '&action=editAnimalParents&id=' . $key["nomb_animal"] . '">' . $key["nomb_animal"] . '</a></td>
                    </tr>';
        }
            $this->page .=
                        '</tbody>
            </table>';
        // execution de la fonction displayPage() pour afficher la page dans le navigateur    
        $this->displayPage();
    }

    public function editAnimalParents($animal, $animalParents) {
        include 'Config/config.php';
        
        $this->page .=
            '<h2>Liste des parents de l\'animal : ' . $animal['nomb_animal'] . '</h2>
            <table id="tableUser" class="table table-striped mb-0 text-center">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Espèce de l\'animal </th>
                        <th scope="col">Nom de l\'animal</th>

                        <th scope="col"><a href="index.php?controller=' . $classAnimal . '&action=addFormAnimalParent">
                        <button class="btn btn-success"><i class="fas fa-plus"></i> Ajouter</button></a></th>
                        <th scope="col"><a href="index.php?controller=' . $classAnimal . '&action=edit">
                        <button class="btn btn-info"><i class="fas fa-undo-alt"></i> Retour</button></a></th>';
            $this->page .=
                    '</tr>
                        </thead>
                        <tbody>
                    <tr>';
        foreach ($animalParents as $key) {
            $this->page .='
                        <td>' . $key['nom_espece'] . '</td>
                        <td>' . $key['nomb_animal'] . '</td>

                        <td><a href="index.php?controller=' . $classAnimal . '&action=delDB&id=' . $key["nomb_animal"] . '">
                        <button class="btn btn-danger"><i class="fas fa-trash-alt"></i> Supprimer</button></a></td>
                        <td><a href="index.php?controller=' . $classAnimal . '&action=editForm&id=' . $key["nomb_animal"] . '"">
                        <button class="btn btn-warning"><i class="fas fa-edit"></i> Modifier</button></a></td>
                    </tr>';
        }
            $this->page .=
                        '</tbody>
            </table>';
        
    $this->displayPage();
    }


    public function editEtatParc($listeAnimauxParc, $listeAnimauxEspecesParc) {
        include 'Config/config.php';
        
        $this->page .=
            '<h2>Population des animaux sur le parc</h2>
            <table id="tableUser" class="table table-striped mb-0 text-center">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Nombre d\'animaux vivants</th>
                        ';
            $this->page .=
                    '</tr>
                        </thead>
                        <tbody>
                    <tr>';
        foreach ($listeAnimauxParc as $key) {
            $this->page .= '
                        
                        <td>' . $key['nbAnimaux'] . '</td>
                    </tr>';
        }
            $this->page .=
                '</tbody>
            </table>
            <br><br>
            ';

            $this->page .=
                '<h3>Population par espèce</h3>
                <table id="tableUser" class="table table-striped mb-0 text-center">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Nom de l\'espèce</th>
                        <th scope="col">Nombre d\'animaux</th>
                        ';
            $this->page .=
                    '</tr>
                        </thead>
                        <tbody>
                    <tr>';
        foreach ($listeAnimauxEspecesParc as $key) {
            $this->page .= 
                        '
                        <td>' . $key['nom_espece'] . '</td>
                        <td>' . $key['nbAnimaux'] . '</td>
                    </tr>';
        }       
            $this->page .=
                '</tbody>
            </table>
            <br><br>
            ';

            $this->displayPage();
    }

    /* <td><a href="index.php?controller=' . $classAnimal . '&action=editListeAnimauxEspece&id=' . $key["code_espece"] . '">' . $key['nbAnimaux'] . '</td>
    */


    public function editListeAnimauxEspece($listeAnimalEspeceParc) {
        include 'Config/config.php';
        
            $this->page .=
                '<h2>Liste des animaux par espèce</h2>
                <table id="tableUser" class="table table-striped mb-0 text-center">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Nom de l\'animal</th>
                        ';
            $this->page .=
                    '</tr>
                        </thead>
                        <tbody>
                    <tr>';
        foreach ($listeAnimalEspeceParc as $key) {
            $this->page .= 
                        '
                        <td>' . $key['nomb_animal'] . '</td>
                    </tr>';
        }       
            $this->page .=
                    '</tbody>
                </table>
                <br><br>
                ';
        
        $this->displayPage();
    }

    

    /**
     * Affichage du formulaire d'ajout
     *
     * @return void
     ******************************************************/
    public function addForm(/*$listeEspeces*/) {
        include 'Config/config.php';
        
        $this->page .= "<h2>Formulaire d'ajout d'un animal</h2>";
        $this->page .= file_get_contents('View/template/forms/Animal/form' . $classAnimal . '.php');
        $this->page = str_replace('{class}', $classAnimal, $this->page);
        $this->page = str_replace('{action}', 'addDB', $this->page);
        $this->page = str_replace('{codESP}', '',$this->page);
        // $especesID = "";
        // foreach ($listeEspeces as $especeID ){
        //     $especesID .= "<option value='" . $especeID['code_espece'] . "'>" . $especeID['nom_espece'] . "</option>";
        // }
        // $this->page = str_replace('{especesID}', $especesID, $this->page);
        $this->page = str_replace('{nomANI}', '', $this->page);
        $this->page = str_replace('{sexeANI}', '', $this->page);
        // $this->page = str_replace('{sexeMANI}', '', $this->page);
        // $this->page = str_replace('{sexeFANI}', '', $this->page);
        $this->page = str_replace('{dnANI}', '', $this->page);
        $this->page = str_replace('{ddANI}', '', $this->page);
        $this->displayPage();
    }

    public function addFormAnimalParent() {
        include 'Config/config.php';
        
        $this->page .= file_get_contents('View/template/forms/Animal/form' . $classAnimal . 'Parent.php');
        $this->page = str_replace('{class}', $classAnimal, $this->page);
        $this->page = str_replace('{action}', 'addDBAnimalParent', $this->page);
        $this->page = str_replace('{parANI}', '', $this->page);
        $this->page = str_replace('{nomPANI}', '', $this->page);
        $this->page = str_replace('{enfANI}', '', $this->page);
        $this->page = str_replace('{nomEANI}', '', $this->page);
        $this->displayPage();
    }
    

    /**
     * Affichage du formulaire d'edition
     *
     * @param [type] $animal
     * @return void
     ******************************************************/
    public function editForm($animal, $listeEspeces) {
        include 'Config/config.php';
        
        $this->page .= "<h2>Formulaire de modification d'un animal</h2>";
        $this->page .= file_get_contents('View/template/forms/Animal/form' . $classAnimal . '.php');
        $this->page = str_replace('{class}', $classAnimal, $this->page);
        $this->page = str_replace('{action}', 'editDB', $this->page);
        $this->page = str_replace('{codESP}', $animal['code_espece'], $this->page);
        // $especesID = "";
        // foreach ($listeEspeces as $especeID) {
        //     $selected = "";
        //     if ($animal['code_espece'] == $especeID['code_espece']) {
        //         $selected = "selected";
        //     }
        //     $especesID .= "<option $selected value='" . $especeID['code_espece'] . "'>" . $especeID['nom_espece'] . "</option>";
        // }
        // $this->page = str_replace('{especesID}', $especesID, $this->page);

        $this->page = str_replace('{nomANI}', $animal['nomb_animal'], $this->page);
        $this->page = str_replace('{sexeANI}', $animal['sexe_animal'], $this->page);
        // $this->page = str_replace('{sexeMANI}', $animal['sexe_animal'], $this->page);
        // $this->page = str_replace('{sexeFANI}', $animal['sexe_animal'], $this->page);
        $this->page = str_replace('{dnANI}', $animal['dn_animal'], $this->page);
        $this->page = str_replace('{ddANI}', $animal['dd_animal'], $this->page);

        $this->displayPage();
    }

    public function editFormAnimalParent($animalParents) {
        include 'Config/config.php';
        
        $this->page .= file_get_contents('View/template/forms/Animal/form' . $classAnimal . '.php');
        $this->page = str_replace('{class}', $classAnimal, $this->page);
        $this->page = str_replace('{action}', 'editDBAnimalParent', $this->page);
        $this->page = str_replace('{parANI}', $animalParents['a_pour_parent'], $this->page);
        $this->page = str_replace('{nomPANI}', $animalParents['nomb_animal_a_pour_parent'], $this->page);
        $this->page = str_replace('{enfANI}', $animalParents['a_pour_enfant'], $this->page);
        $this->page = str_replace('{nomEANI}', $animalParents['nomb_animal_a_pour_enfant'], $this->page);

        $this->displayPage();
    }
}
