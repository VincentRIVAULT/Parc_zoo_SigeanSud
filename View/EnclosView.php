<?php

// Définition de la classe EnclosView
// la mention "extends" signifie que la classe EnclosView
// hérite des propriétés et méthodes de sa classe mère "View"
class EnclosView extends View {

    /**
     * Affichage de la page Enclos côté consultation (liste des enclos)
     *
     * @param [type] $listeEnclos -> tableau contenant la liste des enclos
     * @return void
     ********************************************************************/
    public function displayListeEnclos($listeEnclos) {
        
        // Appel du fichier config.php où sont déclarées 
        // les classes et les tables de données correspondantes
        include 'Config/config.php';
        
        $this->page .=
            '<h2>Liste des enclos</h2>
            <table id="tableUser" class="table table-striped mb-0 text-center">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Code de l\'enclos</th>
                        <th scope="col">Détail de l\'enclos</th>
                        <th scope="col">Superficie de l\'enclos en m²</th>
                        <th scope="col">Liste des objets de l\'enclos</th>
                        <th scope="col">Liste des espèces de l\'enclos</th>
                        <th scope="col">Liste des animaux occupants l\'enclos</th>
                        ';
            $this->page .=
                    '</tr>
                        </thead>
                        <tbody>
                    <tr>';
        foreach ($listeEnclos as $key) {
            $this->page .= '
                        <td>' . $key['code_enclos'] . '</td>
                        <td><a href="index.php?controller=' . $classEnclos . '&action=displayEnclos&id=' . $key['code_enclos'] . '">' . $key['nom_enclos'] . '</a></td>
                        <td>' . $key['superficie_enclos'] . '</td>
                        <td><a href="index.php?controller=' . $classEnclos . '&action=displayListeObjetsPresents&id=' . $key['code_enclos'] . '">' . $key['nom_enclos'] . '</a></td>
                        <td><a href="index.php?controller=' . $classEnclos . '&action=displayListeEspecesVivant&id=' . $key['code_enclos'] . '">' . $key['nom_enclos'] . '</a></td>
                        <td><a href="index.php?controller=' . $classEnclos . '&action=displayListeAnimauxOccupant&id=' . $key['code_enclos'] . '">' . $key['nom_enclos'] . '</a></td>
                    </tr>';
        }
            $this->page .=
                        '</tbody>
            </table>';
        // execution de la fonction displayPage() pour afficher la page dans le navigateur    
        $this->displayPage();
    }


    /**
     * Affichage d'un enclos
     *
     * @param [type] $enclos
     * @return void
     */
    public function displayEnclos($enclos) {
        include 'Config/config.php';
        
        $this->page .=
            '<h2>Détail de l\'enclos : ' . $enclos['nom_enclos'] . '</h2>
            <table id="tableUser" class="table table-striped mb-0 text-center">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Code de l\'enclos</th>
                        <th scope="col">Nom de l\'enclos</th>
                        <th scope="col">Superficie de l\'enclos en m²</th>';
            $this->page .=
                    '</tr>
                        </thead>
                        <tbody>
                    <tr>';   
            $this->page .= '
                        <td>' . $enclos['code_enclos'] . '</td>
                        <td>' . $enclos['nom_enclos'] . '</td>
                        <td>' . $enclos['superficie_enclos'] . '</td>
                    </tr>';
            $this->page .=
                        '</tbody>
            </table>';
            
    $this->displayPage();
    }


    /**
     * Affichage de tous les objets par enclos
     *
     * @param [type] $enclos
     * @param [type] $listeObjetsPresents
     * @return void
     */
    public function displayListeObjetsPresents($enclos, $listeObjetsPresents) {
        include 'Config/config.php';
        
        $this->page .=
            '<h2>Objets présents dans l\'enclos : ' . $enclos['nom_enclos'] . '</h2>
            <table id="tableUser" class="table table-striped mb-0 text-center">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Nom de l\'objet</th>
                        <th scope="col">Quantité d\'objets achetés</th>
                        <th scope="col">Quantité d\'objets prêtés</th>
                        ';
            $this->page .=
                    '</tr>
                        </thead>
                        <tbody>
                    <tr>';
        foreach ($listeObjetsPresents as $key) {
            $this->page .= '
                        
                        <td>' . $key['nom_objet'] . '</td>
                        <td>' . $key['achete'] . '</td>
                        <td>' . $key['prete'] . '</td>
                    </tr>';
        }
            $this->page .=
                        '</tbody>
            </table>';
        
        $this->displayPage();
    }


    /**
     * Affichage de toutes les espèces vivant dans un enclos
     *
     * @param [type] $enclos
     * @param [type] $listeEspecesVivant
     * @return void
     */
    public function displayListeEspecesVivant($enclos, $listeEspecesVivant) {
        include 'Config/config.php';
        
        $this->page .=
            '<h2>Espèces vivant dans l\'enclos : ' . $enclos['nom_enclos'] . '</h2>
            <table id="tableUser" class="table table-striped mb-0 text-center">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Nom de l\'espèce</th>
                        ';
            $this->page .=
                    '</tr>
                        </thead>
                        <tbody>
                    <tr>';
        foreach ($listeEspecesVivant as $key) {
            $this->page .= '
                        
                        <td>' . $key['nom_espece'] . '</td>
                    </tr>';
        }
            $this->page .=
                        '</tbody>
            </table>';
        
        $this->displayPage();
    }


    /**
     * Affichage de tous les animaux occupant un enclos
     *
     * @param [type] $enclos
     * @param [type] $listeAnimauxOccupant
     * @return void
     */
    public function displayListeAnimauxOccupant($enclos, $listeAnimauxOccupant) {
        include 'Config/config.php';
        
        $this->page .=
            '<h2>Animaux occupant l\'enclos : ' . $enclos['nom_enclos'] . '</h2>
            <table id="tableUser" class="table table-striped mb-0 text-center">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Nom de l\'espèce</th>
                        <th scope="col">Nom de l\'animal</th>
                        <th scope="col">Occupe l\'enclos depuis le</th>
                        ';
            $this->page .=
                    '</tr>
                        </thead>
                        <tbody>
                    <tr>';
        foreach ($listeAnimauxOccupant as $key) {
            $this->page .= '
                        
                        <td>' . $key['nom_espece'] . '</td>
                        <td>' . $key['nomb_animal'] . '</td>
                        <td>' . $key['date_debut'] . '</td>
                    </tr>';
        }
            $this->page .=
                        '</tbody>
            </table>';
        
        $this->displayPage();
    }


    // public function displayOccupation($occupationEnclos, $listeEnclos) {
    //     include 'Config/config.php';
        
    //     $this->page .=
    //         '<h2>Occupation des différents enclos</h2>
    //         <table id="tableUser" class="table table-striped mb-0 text-center">
    //             <thead class="thead-dark">
    //                 <tr>
    //                     <th scope="col">Nom de l\'enclos</th>
    //                     <th scope="col">Nombre d\'animaux</th>
    //                     <th scope="col">Nom de l\'objet</th>
    //                     <th scope="col">Liste des animaux occupant</th>
    //                     <th scope="col">Liste des objets présents</th>
    //                     ';
    //         $this->page .=
    //                 '</tr>
    //                     </thead>
    //                     <tbody>
    //                 <tr>';
    //     foreach ($occupationEnclos as $key) {
    //         $this->page .= '
                        
    //                     <td>' . $key['nom_enclos'] . '</td>
    //                     <td>' . $key['nbAnimaux'] . '</td>
    //                     <td>' . $key['nom_objet'] . '</td>
    //                 </tr>';
    //     }
    //         $this->page .=
    //                 '<tr>';
    //     foreach ($listeEnclos as $key) {
    //         $this->page .= 
    //                     '
    //                     <td><a href="index.php?controller=' . $classEnclos . '&action=displayListeAnimauxOccupant&id=' . $key['code_enclos'] . '">' . $key['nom_enclos'] . '</a></td>
    //                     <td><a href="index.php?controller=' . $classEnclos . '&action=displayListeObjetsPresents&id=' . $key['code_enclos'] . '">' . $key['nom_enclos'] . '</a></td>
    //                 </tr>';
    //     }
    //         $this->page .=
    //                     '</tbody>
    //         </table>';
        
    //     $this->displayPage();
    // }


    public function displayOccupation($listeAnimauxEnclos, $listeEnclos, $listeAnimauxErrants) {
        include 'Config/config.php';
        
        $this->page .=
            '<h2>Occupation des différents enclos</h2>
            <table id="tableUser" class="table table-striped mb-0 text-center">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Nom de l\'enclos</th>
                        <th scope="col">Nombre d\'animaux</th>
                        ';
            $this->page .=
                    '</tr>
                        </thead>
                        <tbody>
                    <tr>';
        foreach ($listeAnimauxEnclos as $key) {
            $this->page .= '
                        
                        <td>' . $key['nom_enclos'] . '</td>
                        <td>' . $key['nbAnimaux'] . '</td>
                    </tr>';
        }
            $this->page .=
                '</tbody>
            </table>
            <br><br>
            ';

            $this->page .=
                '<table id="tableUser" class="table table-striped mb-0 text-center">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Liste des animaux occupant l\'enclos</th>
                        <th scope="col">Liste des objets présents dans l\'enclos</th>
                        ';
            $this->page .=
                    '</tr>
                        </thead>
                        <tbody>
                    <tr>';
        foreach ($listeEnclos as $key) {
            $this->page .= 
                        '
                        <td><a href="index.php?controller=' . $classEnclos . '&action=displayListeAnimauxOccupant&id=' . $key['code_enclos'] . '">' . $key['nom_enclos'] . '</a></td>
                        <td><a href="index.php?controller=' . $classEnclos . '&action=displayListeObjetsPresents&id=' . $key['code_enclos'] . '">' . $key['nom_enclos'] . '</a></td>
                    </tr>';
        }       
            $this->page .=
                '</tbody>
            </table>
            <br><br>
            ';

            $this->page .=
            '<h3>Liste des animaux errants</h3>
            <table id="tableUser" class="table table-striped mb-0 text-center">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Code de l\'espece</th>
                    <th scope="col">Nom de l\'animal</th>
                    <th scope="col">Sexe de l\'animal</th>
                    <th scope="col">Date de naissance</th>
                    ';
        $this->page .=
                '</tr>
                    </thead>
                    <tbody>
                <tr>';
    foreach ($listeAnimauxErrants as $key) {
        $this->page .= 
                    '
                    <td>' . $key['code_espece'] . '</td>
                    <td>' . $key['nomb_animal'] . '</td>
                    <td>' . $key['sexe_animal'] . '</td>
                    <td>' . $key['dn_animal'] . '</td>
                </tr>';
    }       
        $this->page .=
                '</tbody>
            </table>
            <br><br>
            ';
        
        $this->displayPage();
    }


    // public function displayOccupationEnclos($enclos, $listeAnimauxEspeceNom) {
    //     include 'Config/config.php';
        
    //     $this->page .=
    //         '<h2>Occupation de l\'enclos : ' . $enclos['nom_enclos'] . '</h2>
    //         <table id="tableUser" class="table table-striped mb-0 text-center">
    //             <thead class="thead-dark">
    //                 <tr>
    //                     <th scope="col">Nom de l\'espèce</th>
    //                     <th scope="col">Nom de l\'animal</th>
    //                     <th scope="col">Occupe l\'enclos depuis le</th>
    //                     ';
    //         $this->page .=
    //                 '</tr>
    //                     </thead>
    //                     <tbody>
    //                 <tr>';
    //     foreach ($listeAnimauxEspeceNom as $key) {
    //         $this->page .= '
                        
    //                     <td>' . $key['nom_espece'] . '</td>
    //                     <td>' . $key['nomb_animal'] . '</td>
    //                     <td>' . $key['date_debut'] . '</td>
    //                 </tr>';
    //     }
    //         $this->page .=
    //                     '</tbody>
    //         </table>';
        
    //     $this->displayPage();
    // }


    /**
     * Affichage de la liste des enclos côté mise à jour
     *
     * @param [array] $listeEnclos -> tableau contenant la liste des enclos
     * @return void
     *******************************************************************/
    public function editListeEnclos($listeEnclos) {
        
        // Appel du fichier config.php où sont déclarées 
        // les classes et les tables de données correspondantes
        include 'Config/config.php';
        
        $this->page .=
            '<h2>Liste des enclos</h2>
            <table id="tableUser" class="table table-striped mb-0 text-center">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Code de l\'enclos</th>
                        <th scope="col">Détail de l\'enclos</th>
                        <th scope="col">Superficie de l\'enclos en m²</th>
                        <th scope="col"><a href="index.php?controller=' . $classEnclos . '&action=addForm">
                        <button class="btn btn-success"><i class="fas fa-plus"></i> Ajouter</button></a></th>
                        <th scope="col"><a href="index.php?controller=' . $classEnclos . '&action=edit">
                        <button class="btn btn-info"><i class="fas fa-undo-alt"></i> Retour</button></a></th>
                        <th scope="col">Liste des objets de l\'enclos</th>
                        <th scope="col">Liste des espèces de l\'enclos</th>
                        <th scope="col">Liste des animaux occupants l\'enclos</th>
                        ';
            $this->page .=
                    '</tr>
                        </thead>
                        <tbody>
                    <tr>';
        foreach ($listeEnclos as $key) {
            $this->page .='
                        <td>' . $key['code_enclos'] . '</td>
                        <td><a href="index.php?controller=' . $classEnclos . '&action=editEnclos&id=' . $key['code_enclos'] . '">' . $key['nom_enclos'] . '</a></td>
                        <td>' . $key['superficie_enclos'] . '</td>
                        <td><a href="index.php?controller=' . $classEnclos . '&action=delDB&id=' . $key["code_enclos"] . '">
                        <button class="btn btn-danger"><i class="fas fa-trash-alt"></i> Supprimer</button></a></td>
                        <td><a href="index.php?controller=' . $classEnclos . '&action=editForm&id=' . $key["code_enclos"] . '"">
                        <button class="btn btn-warning"><i class="fas fa-edit"></i> Modifier</button></a></td>
                        <td><a href="index.php?controller=' . $classEnclos . '&action=editListeObjetsPresents&id=' . $key['code_enclos'] . '">' . $key['nom_enclos'] . '</a></td>
                        <td><a href="index.php?controller=' . $classEnclos . '&action=editListeEspecesVivant&id=' . $key['code_enclos'] . '">' . $key['nom_enclos'] . '</a></td>
                        <td><a href="index.php?controller=' . $classEnclos . '&action=editListeAnimauxOccupant&id=' . $key['code_enclos'] . '">' . $key['nom_enclos'] . '</a></td>
                    </tr>';
        }
            $this->page .=
                        '</tbody>
            </table>';
        // execution de la fonction displayPage() pour afficher la page dans le navigateur    
        $this->displayPage();
    }


    /**
     * Affichage d'un enclos côté mise à jour
     *
     * @param [type] $enclos
     * @return void
     */
    public function editEnclos($enclos) {
        include 'Config/config.php';
        
        $this->page .=
            '<h2>Détail de l\'enclos : ' . $enclos['nom_enclos'] . '</h2>
            <table id="tableUser" class="table table-striped mb-0 text-center">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Code de l\'enclos</th>
                        <th scope="col">Nom de l\'enclos</th>
                        <th scope="col">Superficie de l\'enclos en m²</th>
                        <th scope="col"><a href="index.php?controller=' . $classEnclos . '&action=addForm">
                        <button class="btn btn-success"><i class="fas fa-plus"></i> Ajouter</button></a></th>
                        <th scope="col"><a href="index.php?controller=' . $classEnclos . '&action=edit">
                        <button class="btn btn-info"><i class="fas fa-undo-alt"></i> Retour</button></a></th>
                        ';
            $this->page .=
                    '</tr>
                        </thead>
                        <tbody>
                    <tr>';   
            $this->page .= '
                        <td>' . $enclos['code_enclos'] . '</td>
                        <td>' . $enclos['nom_enclos'] . '</td>
                        <td>' . $enclos['superficie_enclos'] . '</td>
                        <td><a href="index.php?controller=' . $classEnclos . '&action=delDB&id=' . $enclos["code_enclos"] . '">
                        <button class="btn btn-danger"><i class="fas fa-trash-alt"></i> Supprimer</button></a></td>
                        <td><a href="index.php?controller=' . $classEnclos . '&action=editForm&id=' . $enclos["code_enclos"] . '"">
                        <button class="btn btn-warning"><i class="fas fa-edit"></i> Modifier</button></a></td>
                    </tr>';
            $this->page .=
                        '</tbody>
            </table>';
            
    $this->displayPage();
    }


    /**
     * Affichage de la liste des objets par enclos côté mise à jour
     *
     * @param [type] $enclos
     * @param [type] $listeObjetsPresents
     * @return void
     */
    public function editListeObjetsPresents($enclos, $listeObjetsPresents) {
        include 'Config/config.php';
        
        $this->page .=
            '<h2>Objets presents dans l\'enclos : ' . $enclos['nom_enclos'] . '</h2>
            <table id="tableUser" class="table table-striped mb-0 text-center">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Nom de l\'objet</th>
                        <th scope="col">Quantité d\'objets achetés</th>
                        <th scope="col">Quantité d\'objets prêtés</th>
                        <th scope="col"><a href="index.php?controller=' . $classEnclos . '&action=addFormObjetsPresents">
                        <button class="btn btn-success"><i class="fas fa-plus"></i> Ajouter</button></a></th>
                        <th scope="col"><a href="index.php?controller=' . $classEnclos . '&action=edit">
                        <button class="btn btn-info"><i class="fas fa-undo-alt"></i> Retour</button></a></th>
                        ';
            $this->page .=
                    '</tr>
                        </thead>
                        <tbody>
                    <tr>';
        foreach ($listeObjetsPresents as $key) {
            $this->page .= '
                        
                        <td>' . $key['nom_objet'] . '</td>
                        <td>' . $key['achete'] . '</td>
                        <td>' . $key['prete'] . '</td>
                        <td><a href="index.php?controller=' . $classEnclos . '&action=delDBObjetsPresents&id=' . $key["code_objet"] . '">
                        <button class="btn btn-danger"><i class="fas fa-trash-alt"></i> Supprimer</button></a></td>
                        <td><a href="index.php?controller=' . $classEnclos . '&action=editFormObjetsPresents&id=' . $key["code_objet"] . '"">
                        <button class="btn btn-warning"><i class="fas fa-edit"></i> Modifier</button></a></td>
                    </tr>';
        }
            $this->page .=
                        '</tbody>
            </table>';
        
        $this->displayPage();
    }


    /**
     * Affichage de la liste des espèces vivant dans un enclos côté mise à jour
     *
     * @param [type] $enclos
     * @param [type] $listeEspecesVivant
     * @return void
     */
    public function editListeEspecesVivant($enclos, $listeEspecesVivant) {
        include 'Config/config.php';
        
        $this->page .=
            '<h2>Espèces vivant dans l\'enclos : ' . $enclos['nom_enclos'] . '</h2>
            <table id="tableUser" class="table table-striped mb-0 text-center">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Nom de l\'espèce</th>
                        <th scope="col"><a href="index.php?controller=' . $classEnclos . '&action=addFormEspecesVivant">
                        <button class="btn btn-success"><i class="fas fa-plus"></i> Ajouter</button></a></th>
                        <th scope="col"><a href="index.php?controller=' . $classEnclos . '&action=edit">
                        <button class="btn btn-info"><i class="fas fa-undo-alt"></i> Retour</button></a></th>
                        ';
            $this->page .=
                    '</tr>
                        </thead>
                        <tbody>
                    <tr>';
        foreach ($listeEspecesVivant as $key) {
            $this->page .= '
                        
                        <td>' . $key['nom_espece'] . '</td>
                        <td><a href="index.php?controller=' . $classEnclos . '&action=delDBEspecesVivant&id=' . $key["nom_espece"] . '">
                        <button class="btn btn-danger"><i class="fas fa-trash-alt"></i> Supprimer</button></a></td>
                        <td><a href="index.php?controller=' . $classEnclos . '&action=editFormEspecesVivant&id=' . $key["nom_espece"] . '"">
                        <button class="btn btn-warning"><i class="fas fa-edit"></i> Modifier</button></a></td>
                    </tr>';
        }
            $this->page .=
                        '</tbody>
            </table>';
        
        $this->displayPage();
    }


    /**
     * Affichage de la liste des animaux habitant dans un enclos côté mise à jour
     *
     * @param [type] $enclos
     * @param [type] $listeAnimauxOccupant
     * @return void
     */
    public function editListeAnimauxOccupant($enclos, $listeAnimauxOccupant) {
        include 'Config/config.php';
        
        $this->page .=
            '<h2>Animaux occupant l\'enclos : ' . $enclos['nom_enclos'] . '</h2>
            <table id="tableUser" class="table table-striped mb-0 text-center">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Nom de l\'espèce</th>
                        <th scope="col">Nom de l\'animal</th>
                        <th scope="col">Occupe l\'enclos depuis le</th>
                        <th scope="col"><a href="index.php?controller=' . $classEnclos . '&action=addFormAnimauxOccupant">
                        <button class="btn btn-success"><i class="fas fa-plus"></i> Ajouter</button></a></th>
                        <th scope="col"><a href="index.php?controller=' . $classEnclos . '&action=edit">
                        <button class="btn btn-info"><i class="fas fa-undo-alt"></i> Retour</button></a></th>
                        ';
            $this->page .=
                    '</tr>
                        </thead>
                        <tbody>
                    <tr>';
        foreach ($listeAnimauxOccupant as $key) {
            $this->page .= '
                        
                        <td>' . $key['nom_espece'] . '</td>
                        <td>' . $key['nomb_animal'] . '</td>
                        <td>' . $key['date_debut'] . '</td>
                        <td><a href="index.php?controller=' . $classEnclos . '&action=delDBAnimauxOccupant&id=' . $key["nomb_animal"] . '">
                        <button class="btn btn-danger"><i class="fas fa-trash-alt"></i> Supprimer</button></a></td>
                        <td><a href="index.php?controller=' . $classEnclos . '&action=editFormAnimauxOccupant&id=' . $key["nomb_animal"] . '">
                        <button class="btn btn-warning"><i class="fas fa-edit"></i> Modifier</button></a></td>
                    </tr>';
        }
            $this->page .=
                        '</tbody>
            </table>';
        
        $this->displayPage();
    }


    public function editOccupation($listeAnimauxEnclos, $listeEnclos, $listeAnimauxErrants) {
        include 'Config/config.php';
        
        $this->page .=
            '<h2>Occupation des différents enclos</h2>
            <table id="tableUser" class="table table-striped mb-0 text-center">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Nom de l\'enclos</th>
                        <th scope="col">Nombre d\'animaux</th>
                        ';
            $this->page .=
                    '</tr>
                        </thead>
                        <tbody>
                    <tr>';
        foreach ($listeAnimauxEnclos as $key) {
            $this->page .= '
                        
                        <td>' . $key['nom_enclos'] . '</td>
                        <td>' . $key['nbAnimaux'] . '</td>
                    </tr>';
        }
            $this->page .=
                '</tbody>
            </table>
            <br><br>
            ';

            $this->page .=
                '<table id="tableUser" class="table table-striped mb-0 text-center">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Liste des animaux occupant l\'enclos</th>
                        <th scope="col">Liste des objets présents dans l\'enclos</th>
                        ';
            $this->page .=
                    '</tr>
                        </thead>
                        <tbody>
                    <tr>';
        foreach ($listeEnclos as $key) {
            $this->page .= 
                        '
                        <td><a href="index.php?controller=' . $classEnclos . '&action=editListeAnimauxOccupant&id=' . $key['code_enclos'] . '">' . $key['nom_enclos'] . '</a></td>
                        <td><a href="index.php?controller=' . $classEnclos . '&action=editListeObjetsPresents&id=' . $key['code_enclos'] . '">' . $key['nom_enclos'] . '</a></td>
                    </tr>';
        }       
            $this->page .=
                '</tbody>
            </table>
            <br><br>
            ';

            $this->page .=
                '<h3>Liste des animaux errants</h3>
                <table id="tableUser" class="table table-striped mb-0 text-center">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Code de l\'espece</th>
                        <th scope="col">Nom de l\'animal</th>
                        <th scope="col">Sexe de l\'animal</th>
                        <th scope="col">Date de naissance</th>
                        ';
            $this->page .=
                    '</tr>
                        </thead>
                        <tbody>
                    <tr>';
        foreach ($listeAnimauxErrants as $key) {
            $this->page .= 
                        '
                        <td>' . $key['code_espece'] . '</td>
                        <td>' . $key['nomb_animal'] . '</td>
                        <td>' . $key['sexe_animal'] . '</td>
                        <td>' . $key['dn_animal'] . '</td>
                    </tr>';
        }       
            $this->page .=
                    '</tbody>
                </table>
                <br><br>
                ';
        
        $this->displayPage();
    }


    // public function editOccupationEnclos($enclos, $listeAnimauxEspeceNom) {
    //     include 'Config/config.php';
        
    //     $this->page .=
    //         '<h2>Occupation de l\'enclos : ' . $enclos['nom_enclos'] . '</h2>
    //         <table id="tableUser" class="table table-striped mb-0 text-center">
    //             <thead class="thead-dark">
    //                 <tr>
    //                     <th scope="col">Nom de l\'espèce</th>
    //                     <th scope="col">Nom de l\'animal</th>
    //                     <th scope="col">Occupe l\'enclos depuis le</th>
    //                     <th scope="col"><a href="index.php?controller=' . $classEnclos . '&action=addFormOccupationEnclos">
    //                     <button class="btn btn-success"><i class="fas fa-plus"></i> Ajouter</button></a></th>
    //                     <th scope="col"><a href="index.php?controller=' . $classEnclos . '&action=edit">
    //                     <button class="btn btn-info"><i class="fas fa-undo-alt"></i> Retour</button></a></th>
    //                     ';
    //         $this->page .=
    //                 '</tr>
    //                     </thead>
    //                     <tbody>
    //                 <tr>';
    //     foreach ($listeAnimauxEspeceNom as $key) {
    //         $this->page .= '
                        
    //                     <td>' . $key['nom_espece'] . '</td>
    //                     <td>' . $key['nomb_animal'] . '</td>
    //                     <td>' . $key['date_debut'] . '</td>
    //                     <td><a href="index.php?controller=' . $classEnclos . '&action=delDBOccupationEnclos&id=' . $key["nomb_animal"] . '">
    //                     <button class="btn btn-danger"><i class="fas fa-trash-alt"></i> Supprimer</button></a></td>
    //                     <td><a href="index.php?controller=' . $classEnclos . '&action=editFormOccupationEnclos&id=' . $key["nomb_animal"] . '"">
    //                     <button class="btn btn-warning"><i class="fas fa-edit"></i> Modifier</button></a></td>
    //                 </tr>';
    //     }
    //         $this->page .=
    //                     '</tbody>
    //         </table>';
        
    //     $this->displayPage();
    // }


    /**
     * Affichage du formulaire d'ajout
     *
     * @return void
     ******************************************************/
    public function addForm() {
        include 'Config/config.php';
        
        $this->page .= "<h2>Formulaire d'ajout d'un enclos</h2>";
        $this->page .= file_get_contents('View/template/forms/Enclos/form' . $classEnclos . '.php');
        $this->page = str_replace('{class}', $classEnclos, $this->page);
        $this->page = str_replace('{action}', 'addDB', $this->page);
        $this->page = str_replace('{codENC}', '', $this->page);
        $this->page = str_replace('{nomENC}', '', $this->page);
        $this->page = str_replace('{supENC}', '', $this->page);
        $this->displayPage();
    }
    

    /**
     * Affichage du formulaire d'edition
     *
     * @param [type] $enclos
     * @return void
     ******************************************************/
    public function editForm($enclos) {
        include 'Config/config.php';
        
        $this->page .= "<h2>Formulaire de modification d'un enclos</h2>";
        $this->page .= file_get_contents('View/template/forms/Enclos/form' . $classEnclos . '.php');
        $this->page = str_replace('{class}', $classEnclos, $this->page);
        $this->page = str_replace('{action}', 'editDB', $this->page);
        $this->page = str_replace('{codENC}', $enclos['code_enclos'], $this->page);
        $this->page = str_replace('{nomENC}', $enclos['nom_enclos'], $this->page);
        $this->page = str_replace('{supENC}', $enclos['superficie_enclos'], $this->page);
        $this->displayPage();
    }


    /**
     * Affichage formulaire ajout objets dans un enclos
     *
     * @param [type] $listeObjets
     */
    public function addFormObjetsPresents($listeObjets) {
        include 'Config/config.php';
        
        $this->page .= "<h2>Formulaire d'ajout d'objets dans un enclos</h2>";
        $this->page .= file_get_contents('View/template/forms/Enclos/form' . $classEnclos . 'ObjetsPresents.php');
        $this->page = str_replace('{class}', $classEnclos, $this->page);
        $this->page = str_replace('{action}', 'addDBObjetsPresents', $this->page);
        $this->page = str_replace('{codENC}', '', $this->page);
        // $this->page = str_replace('{codOBJ}', '', $this->page);
        
        $objets = "";
        foreach ($listeObjets as $objet) {
            $objets .= "<option value='" . $objet['code_objet'] . "'>" . $objet['nom_objet'] . "</option>";
        }
        $this->page = str_replace('{objets}', $objets, $this->page);
        
        $this->page = str_replace('{qteOBJ}', '', $this->page);
        // $this->page = str_replace('{achOBJ}', '', $this->page);
        // $this->page = str_replace('{preOBJ}', '', $this->page);

        $this->displayPage();
    }

    /**
     * Affichage formulaire MAJ objets dans un enclos
     *
     * @param [type] $enclos
     * @param [type] $listeObjetsPresents
     * @return void
     */
    public function editFormObjetsPresents($enclos, $listeObjets) {
        include 'Config/config.php';
        
        $this->page .= "<h2>Formulaire de modification d'objets dans un enclos</h2>";
        $this->page .= file_get_contents('View/template/forms/Enclos/form' . $classEnclos . 'ObjetsPresents.php');
        $this->page = str_replace('{class}', $classEnclos, $this->page);
        $this->page = str_replace('{action}', 'editDBObjetsPresents', $this->page);
        $this->page = str_replace('{codENC}', $enclos['code_enclos'], $this->page);
        // $this->page = str_replace('{codOBJ}', $enclos['code_objet'], $this->page);
        
        $objets = "";
        foreach ($listeObjets as $objet) {
            $selected = "";
            if ($enclos['code_enclos'] == $objet['code_objet']) {
                $selected = "selected";
            }
            $objets .= "<option $selected value='" . $objet['code_objet'] . "'>" . $objet['nom_objet'] . "</option>";
        }
        $this->page = str_replace('{objets}', $objets, $this->page);
        
        $this->page = str_replace('{qteOBJ}', '', $this->page);
        // $this->page = str_replace('{achOBJ}', '', $this->page);
        // $this->page = str_replace('{preOBJ}', '', $this->page);

        $this->displayPage();
    }


    /**
     * Affichage formulaire ajout espèce vivant dans un enclos
     *
     * @param [type] $listeEspecesVivant
     */
    public function addFormEspecesVivant(/*$listeEspecesVivant*/) {
        include 'Config/config.php';
        
        $this->page .= "<h2>Formulaire d'ajout d'espèces dans un enclos</h2>";
        $this->page .= file_get_contents('View/template/forms/Enclos/form' . $classEnclos . 'EspecesVivant.php');
        $this->page = str_replace('{class}', $classEnclos, $this->page);
        $this->page = str_replace('{action}', 'addDBEspecesVivant', $this->page);
        $this->page = str_replace('{codENC}', '', $this->page);
        $this->page = str_replace('{codESP}', '', $this->page);
        /*
        $especesVivant = "";
        foreach ($listeEspecesVivant as $especeVivant) {
            $especesVivant .= "<option value='" . $especeVivant['code_espece'] . "'>" . $especeVivant['nom_espece'] . "</option>";
        }
        $this->page = str_replace('{especesVivant}', $especesVivant, $this->page);
        */
        $this->displayPage();
    }


    /**
     * Affichage formulaire MAJ especes vivant dans un enclos
     *
     * @param [type] $enclos
     * @param [type] $listeEspecesVivant
     * @return void
     */
    public function editFormEspecesVivant($enclos/*, $listeEspecesVivant*/) {
        include 'Config/config.php';
        
        $this->page .= "<h2>Formulaire de modification d'espèces dans un enclos</h2>";
        $this->page .= file_get_contents('View/template/forms/Enclos/form' . $classEnclos . 'EspecesVivant.php');
        $this->page = str_replace('{class}', $classEnclos, $this->page);
        $this->page = str_replace('{action}', 'editDBEspecesVivant', $this->page);
        $this->page = str_replace('{codENC}', $enclos['code_enclos'], $this->page);
        $this->page = str_replace('{codESP}', $enclos['code_espece'], $this->page);
        /*
        $especesVivant = "";
        foreach ($listeEspecesVivant as $especeVivant) {
            $selected = "";
            if ($enclos['nom_espece'] == $especeVivant['code_espece']) {
                $selected = "selected";
            }
            $especesVivant .= "<option $selected value='" . $especeVivant['code_espece'] . "'>" . $especeVivant['nom_espece'] . "</option>";
        }
        $this->page = str_replace('{especesVivant}', $especesVivant, $this->page);
        */
        $this->displayPage();
    }


    /**
     * Affichage formulaire ajout animaux occupant un enclos
     *
     * @param [type] $listeAnimauxOccupant
     */
    public function addFormAnimauxOccupant(/*$listeAnimauxOccupant*/) {
        include 'Config/config.php';
        
        $this->page .= "<h2>Formulaire d'ajout d'animaux dans un enclos</h2>";
        $this->page .= file_get_contents('View/template/forms/Enclos/form' . $classEnclos . 'AnimauxOccupant.php');
        $this->page = str_replace('{class}', $classEnclos, $this->page);
        $this->page = str_replace('{action}', 'addDBAnimauxOccupant', $this->page);
        $this->page = str_replace('{codENC}', '', $this->page);
        $this->page = str_replace('{codESP}', '', $this->page);
        $this->page = str_replace('{date_debut}', '', $this->page);
        $this->page = str_replace('{encours}', '', $this->page);
        $this->page = str_replace('{nomANI}', '', $this->page);
        /*
        $animauxOccupant = "";
        foreach ($listeAnimauxOccupant as $animalOccupant) {
            $animauxOccupant .= "<option value='" . $animalOccupant['code_espece'] . "'>" . $animalOccupant['nomb_animal'] . "</option>";
        }
        $this->page = str_replace('{animauxOccupant}', $animauxOccupant, $this->page);
        */
        $this->displayPage();
    }


    /**
     * Affichage formulaire MAJ animaux occupant un enclos
     *
     * @param [type] $enclos
     * @param [type] $listeAnimauxOccupant
     * @return void
     */
    public function editFormAnimauxOccupant($enclos/*, $listeAnimauxOccupant*/) {
        include 'Config/config.php';
        
        $this->page .= "<h2>Formulaire de modification d'animaux dans un enclos</h2>";
        $this->page .= file_get_contents('View/template/forms/Enclos/form' . $classEnclos . 'AnimauxOccupant.php');
        $this->page = str_replace('{class}', $classEnclos, $this->page);
        $this->page = str_replace('{action}', 'editDBAnimauxOccupant', $this->page);
        $this->page = str_replace('{codENC}', $enclos['code_enclos'], $this->page);
        $this->page = str_replace('{codESP}', $enclos['code_espece'], $this->page);
        $this->page = str_replace('{date_debut}', $enclos['date_debut'], $this->page);
        $this->page = str_replace('{encours}', $enclos['encours'], $this->page);
        $this->page = str_replace('{nomANI}', $enclos['nomb_animal'], $this->page);
        /*
        $animauxOccupant = "";
        foreach ($listeAnimauxOccupant as $animalOccupant) {
            $selected = "";
            if ($enclos['nomb_animal'] == $animalOccupant['code_espece']) {
                $selected = "selected";
            }
            $animauxOccupant .= "<option $selected value='" . $animalOccupant['code_espece'] . "'>" . $animalOccupant['nomb_animal'] . "</option>";
        }
        $this->page = str_replace('{animauxOccupant}', $animauxOccupant, $this->page);
        */
        $this->displayPage();
    }

}
