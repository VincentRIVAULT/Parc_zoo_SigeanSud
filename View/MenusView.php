<?php

// Définition de la classe MenusView
// la mention "extends" signifie que la classe MenusView
// hérite des propriétés et méthodes de sa classe mère "View"
class MenusView extends View {

    /**
     * Affichage de la page Menus côté consultation (liste des menus)
     *
     * @param [type] $listeMenus -> tableau contenant la liste des menus
     * @return void
     ********************************************************************/
    public function displayListMenus($listeMenus) {
        
        // Appel du fichier config.php où sont déclarées 
        // les classes et les tables de données correspondantes
        include 'Config/config.php';
        
        $this->page .=
            '<h2>Liste des menus</h2>
            <table id="tableUser" class="table table-striped mb-0 text-center">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Code du menu</th>
                        <th scope="col">Nom du menu</th>
                        <th scope="col">Quantité recommandée</th>
                        <th scope="col">Code de l\'espèce</th>
                        <th scope="col">Menus des animaux</th>';
            $this->page .=
                    '</tr>
                        </thead>
                        <tbody>
                    <tr>';
        foreach ($listeMenus as $key) {
            $this->page .= '
                        <td>' . $key['code_menu'] . '</td>
                        <td>' . $key['libelle_menus'] . '</td>
                        <td>' . $key['qte_recommandee_menus'] . '</td>
                        <td>' . $key['code_espece'] . '</td>

                        <td> <a href="index.php?controller=' . $classMenus . '&action=displayListRepas&id=' . $key["code_menu"] . '">' . $key["libelle_menus"] . '</a></td>
                    </tr>';
        }
            $this->page .=
                        '</tbody>
            </table>';
        // execution de la fonction displayPage() pour afficher la page dans le navigateur        
        $this->displayPage();
    }

    public function displayListRepas($menu, $listeRepas) {
        include 'Config/config.php';
        
        $this->page .=
            '<h2>Liste des repas donnés pour le menu : ' . $menu['libelle_menus'] . '</h2>
            <table id="tableUser" class="table table-striped mb-0 text-center">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Code de l\'espèce</th>
                        <th scope="col">Nom de l\'animal</th>
                        <th scope="col">Date et heure du repas</th>
                        <th scope="col">Quantitée distribuée</th>
                        <th scope="col">Quantitée recommandée</th>';
            $this->page .=
                    '</tr>
                        </thead>
                        <tbody>
                    <tr>';
        foreach ($listeRepas as $key) {
            $this->page .= '
                        <td>' . $key['code_espece'] . '</td>
                        <td>' . $key['nomb_animal'] . '</td>
                        <td>' . $key['dh_repas'] . '</td>
                        <td>' . $key['qte_distribuee'] . '</td>
                        <td>' . $key['qte_recommandee_menus'] . '</td>
                    </tr>';
        }
            $this->page .=
                        '</tbody>
            </table>';
        
    $this->displayPage();
    }

   
    public function displayPlanningRepasJour($listeMenus) {
        include 'Config/config.php';
        
        $this->page .=
            '<h2>Planning des repas</h2>
            <form method="GET" action="index.php?controller={class}&action={action}">
                <div>
                    <label for="dhREPMEN">Veuillez choisir une date pour obtenir tous les repas de cette journée :</label>
                    <input type="date" class="form-control" name="dhREPMEN" id="dhREPMEN" placeholder="aaaa-mm-jj" value="{dhREPMEN}">
                </div>
                <button type="submit" class="btn btn-success"><i class="fas fa-check"></i> Valider</button>    
            </form>
            </br>
            </br>
            <table id="tableUser" class="table table-striped mb-0 text-center">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Code de l\'espèce</th>
                        <th scope="col">Nom de l\'animal</th>
                        <th scope="col">Date et heure du repas</th>
                        <th scope="col">Quantitée distribuée</th>
                        <th scope="col">Code Menu</th>';
        $this->page .=
                    '</tr>
                </thead>
                <tbody>
                    <tr>';
        foreach ($listeMenus as $key) {
            $this->page .= '
                        <td>' . $key['code_espece'] . '</td>
                        <td>' . $key['nomb_animal'] . '</td>
                        <td>' . $key['dh_repas'] . '</td>
                        <td>' . $key['qte_distribuee'] . '</td>
                        <td>' . $key['code_menu'] . '</td>
                    </tr>';
        }
        $this->page .=
                '</tbody>
            </table>';
        $this->displayPage();
    }


    /**
     * Affichage de la liste des menus côté mise à jour
     *
     * @param [array] $listeMenus -> tableau contenant la liste des menus
     * @return void
     *******************************************************************/
    public function editListMenus($listeMenus) {
        include 'Config/config.php';
        
        $this->page .=
            '<h2>Liste des menus</h2>
            <table id="tableUser" class="table table-striped mb-0 text-center">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Code du menu</th>
                        <th scope="col">Nom du menu</th>
                        <th scope="col">Quantité recommandée</th>
                        <th scope="col">Code de l\'espèce</th>

                        <th scope="col"><a href="index.php?controller=' . $classMenus . '&action=addForm">
                        <button class="btn btn-success"><i class="fas fa-plus"></i> Ajouter</button></a></th>
                        <th scope="col"><a href="index.php?controller=' . $classMenus . '&action=edit">
                        <button class="btn btn-info"><i class="fas fa-undo-alt"></i> Retour</button></a></th>
                        <th scope="col">Menus des animaux</th>
                        ';
            $this->page .=
                    '</tr>
                        </thead>
                        <tbody>
                    <tr>';
        foreach ($listeMenus as $key) {
            $this->page .='
                        <td>' . $key['code_menu'] . '</td>
                        <td>' . $key['libelle_menus'] . '</td>
                        <td>' . $key['qte_recommandee_menus'] . '</td>
                        <td>' . $key['code_espece'] . '</td>

                        <td><a href="index.php?controller=' . $classMenus . '&action=delDB&id=' . $key["code_menu"] . '">
                        <button class="btn btn-danger"><i class="fas fa-trash-alt"></i> Supprimer</button></a></td>
                        <td><a href="index.php?controller=' . $classMenus . '&action=editForm&id=' . $key["code_menu"] . '"">
                        <button class="btn btn-warning"><i class="fas fa-edit"></i> Modifier</button></a></td>

                        <td> <a href="index.php?controller=' . $classMenus . '&action=editListRepas&id=' . $key["code_menu"] . '">' . $key["libelle_menus"] . '</a></td>
                    </tr>';
        }
            $this->page .=
                        '</tbody>
            </table>
            <br>
            <h5>Attention veuillez supprimer d\'abord les repas qui appartient à ce menu avant de le supprimer</h5>';
        
    $this->displayPage();
    }

    /**
     * Affichage de la liste des repas côté mise à jour
     *
     * @param [array] $listeRepas -> tableau contenant la liste des repas
     * @return void
     *******************************************************************/
    public function editListRepas($menu, $listeRepas) {
        include 'Config/config.php';
        
        $this->page .=
            '<h2>Liste des repas donnés pour le menu : ' . $menu['libelle_menus'] . '</h2>
            <table id="tableUser" class="table table-striped mb-0 text-center">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Code de l\'espèce</th>
                        <th scope="col">Nom de l\'animal</th>
                        <th scope="col">Date et heure du repas</th>
                        <th scope="col">Quantitée distribuée</th>

                        <th scope="col"><a href="index.php?controller=' . $classMenus . '&action=addFormListRepas">
                        <button class="btn btn-success"><i class="fas fa-plus"></i> Ajouter</button></a></th>
                        <th scope="col"><a href="index.php?controller=' . $classMenus . '&action=edit">
                        <button class="btn btn-info"><i class="fas fa-undo-alt"></i> Retour</button></a></th>';
            $this->page .=
                    '</tr>
                        </thead>
                        <tbody>
                    <tr>';
        foreach ($listeRepas as $key) {
            $this->page .='
                        <td>' . $key['code_espece'] . '</td>
                        <td>' . $key['nomb_animal'] . '</td>
                        <td>' . $key['dh_repas'] . '</td>
                        <td>' . $key['qte_distribuee'] . '</td>

                        <td><a href="index.php?controller=' . $classMenus . '&action=delDBRepas&id=' . $key["code_espece"] . '">
                        <button class="btn btn-danger"><i class="fas fa-trash-alt"></i> Supprimer</button></a></td>
                        <td><a href="index.php?controller=' . $classMenus . '&action=editFormListRepas&id=' . $key["code_espece"] . '"">
                        <button class="btn btn-warning"><i class="fas fa-edit"></i> Modifier</button></a></td>
                    </tr>';
        }
            $this->page .=
                        '</tbody>
            </table>';
        
    $this->displayPage();
    }


    public function editPlanningRepasJour($listeMenus) {
        include 'Config/config.php';
        
        $this->page .=
            '<h2>Planning des repas</h2>
            <form method="GET" action="index.php?controller={class}&action={action}">
                <div>
                    <label for="dhREPMEN">Veuillez choisir une date pour obtenir tous les repas de cette journée :</label>
                    <input type="date" class="form-control" name="dhREPMEN" id="dhREPMEN" placeholder="aaaa-mm-jj" value="{dhREPMEN}">
                </div>
                <button type="submit" class="btn btn-success"><i class="fas fa-check"></i> Valider</button>    
            </form>
            </br>
            </br>
            <table id="tableUser" class="table table-striped mb-0 text-center">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Code de l\'espèce</th>
                        <th scope="col">Nom de l\'animal</th>
                        <th scope="col">Date et heure du repas</th>
                        <th scope="col">Quantitée distribuée</th>
                        <th scope="col">Code Menu</th>';
        $this->page .=
                    '</tr>
                </thead>
                <tbody>
                    <tr>';
        foreach ($listeMenus as $key) {
            $this->page .= '
                        <td>' . $key['code_espece'] . '</td>
                        <td>' . $key['nomb_animal'] . '</td>
                        <td>' . $key['dh_repas'] . '</td>
                        <td>' . $key['qte_distribuee'] . '</td>
                        <td>' . $key['code_menu'] . '</td>
                    </tr>';
        }
        $this->page .=
                '</tbody>
            </table>';
        $this->displayPage();
    }
    

    /**
     * Affichage du formulaire d'ajout
     *
     * @return void
     ******************************************************/
    public function addForm() {
        include 'Config/config.php';
        
        $this->page .= file_get_contents('View/template/forms/Menu/form' . $classMenus . '.php');
        $this->page = str_replace('{class}', $classMenus, $this->page);
        $this->page = str_replace('{action}', 'addDB', $this->page);
        $this->page = str_replace('{codMEN}', '', $this->page);
        $this->page = str_replace('{libMEN}', '', $this->page);
        $this->page = str_replace('{qteRMEN}', '', $this->page);
        $this->page = str_replace('{codESP}', '', $this->page);
        $this->displayPage();
    }

    public function addFormListRepas() {
        include 'Config/config.php';
        
        $this->page .= file_get_contents('View/template/forms/Menu/form' . $classMenus . 'Repas.php');
        $this->page = str_replace('{class}', $classMenus, $this->page);
        $this->page = str_replace('{action}', 'addDBRepas', $this->page);
        $this->page = str_replace('{codESP}', '', $this->page);
        $this->page = str_replace('{nomANI}', '', $this->page);
        $this->page = str_replace('{dhREPMEN}', '', $this->page);
        $this->page = str_replace('{qteDMEN}', '', $this->page);
        $this->page = str_replace('{codMEN}', '', $this->page); 
        $this->displayPage();
    }
    

    /**
     * Affichage du formulaire d'edition
     *
     * @param [type] $menu
     * @return void
     ******************************************************/
    public function editForm($menu) {
        include 'Config/config.php';
        
        $this->page .= file_get_contents('View/template/forms/Menu/form' . $classMenus . '.php');
        $this->page = str_replace('{class}', $classMenus, $this->page);
        $this->page = str_replace('{action}', 'editDB', $this->page);
        $this->page = str_replace('{codMEN}', $menu['code_menu'], $this->page);
        $this->page = str_replace('{libMEN}', $menu['libelle_menus'], $this->page);
        $this->page = str_replace('{qteRMEN}', $menu['qte_recommandee_menus'], $this->page);
        $this->page = str_replace('{codESP}', $menu['code_espece'], $this->page);
        $this->displayPage();
    }

    public function editFormListRepas($repas, $listeRepas) {
        include 'Config/config.php';
        
        $this->page .= file_get_contents('View/template/forms/Menu/form' . $classMenus . 'Repas.php');
        $this->page = str_replace('{class}', $classMenus, $this->page);
        $this->page = str_replace('{action}', 'editDBRepas', $this->page);
        $this->page = str_replace('{codESP}', $repas['code_espece'], $this->page);
        $this->page = str_replace('{nomANI}', $repas['nomb_animal'], $this->page);
        $this->page = str_replace('{dhREPMEN}', $repas['dh_repas'], $this->page);
        $this->page = str_replace('{qteDMEN}', $repas['qte_distribuee'], $this->page);
        $this->page = str_replace('{codMEN}', $repas['code_menu'], $this->page);
        $this->displayPage();
    }
}