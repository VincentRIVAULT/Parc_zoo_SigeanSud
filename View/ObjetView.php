<?php

// Définition de la classe ObjetView
// la mention "extends" signifie que la classe ObjetView
// hérite des propriétés et méthodes de sa classe mère "View"
class ObjetView extends View {

    /**
     * Affichage de la page Objet côté consultation (liste des objets)
     *
     * @param [type] $listeObjets -> tableau contenant la liste des objets
     * @return void
     ********************************************************************/
    public function displayListeObjets($listeObjets) {
        
        // Appel du fichier config.php où sont déclarées 
        // les classes et les tables de données correspondantes
        include 'Config/config.php';
        
        $this->page .=
            '<h2>Liste des objets</h2>
            <table id="tableUser" class="table table-striped mb-0 text-center">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Code de l\'objet</th>
                        <th scope="col">Détail de l\'objet</th>
                        <th scope="col">Objet acheté</th>
                        <th scope="col">Objet prêté</th>
                        <th>Liste des enclos où se situe l\'objet</th>
                        ';
            $this->page .=
                    '</tr>
                        </thead>
                        <tbody>
                    <tr>';
        foreach ($listeObjets as $key) {
            $this->page .=
                        '<td>' . $key['code_objet'] . '</td>
                        <td><a href="index.php?controller=' . $classObjet . '&action=displayObjet&id=' . $key['code_objet'] . '">' . $key['nom_objet'] . '</a></td>
                        <td>' . $key['achete'] . '</td>
                        <td>' . $key['prete'] . '</td>
                        <td><a href="index.php?controller=' . $classObjet . '&action=displayListeEnclosObjet&id=' . $key['code_objet'] . '">' . $key['nom_objet'] . '</a></td>
                    </tr>';
        }
            $this->page .=
                        '</tbody>
            </table>';
        // execution de la fonction displayPage() pour afficher la page dans le navigateur        
        $this->displayPage();
    }


    /**
     * Affichage du détail d'un objet
     *
     * @param [type] $objet
     * @return void
     */
    public function displayObjet($objet) {
        include 'Config/config.php';
        
        $this->page .=
            '<h2>Détail de l\'objet : ' . $objet['nom_objet'] . '</h2>
            <table id="tableUser" class="table table-striped mb-0 text-center">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Code de l\'objet</th>
                        <th scope="col">Nom de l\'objet</th>
                        <th scope="col">Objet acheté</th>
                        <th scope="col">Objet prêté</th>
                        ';
            $this->page .=
                    '</tr>
                        </thead>
                        <tbody>
                    <tr>';
            $this->page .=
                        '<td>' . $objet['code_objet'] . '</td>
                        <td>' . $objet['nom_objet'] . '</td>
                        <td>' . $objet['achete'] . '</td>
                        <td>' . $objet['prete'] . '</td>
                    </tr>';
            $this->page .=
                        '</tbody>
            </table>';
        
        $this->displayPage();
    }

    
    /**
     * Affichage de la liste des enclos où se situe l'objet
     *
     * @param [type] $objet
     * @param [type] $listeEnclosObjet
     * @return void
     */
    public function displayListeEnclosObjet($objet, $listeEnclosObjet) {
        include 'Config/config.php';
        
        $this->page .=
            '<h2>Enclos où se situe l\'objet : ' . $objet['nom_objet'] . ' </h2>
            <table id="tableUser" class="table table-striped mb-0 text-center">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Nom de l\'enclos</th>
                        <th scope="col">Objet acheté</th>
                        <th scope="col">Objet prêté</th>
                        <th scope="col">Quantité de l\'objet</th>
                        ';
            $this->page .=
                    '</tr>
                        </thead>
                        <tbody>
                    <tr>';
        foreach ($listeEnclosObjet as $key) {
            $this->page .=
                        '
                        <td>' . $key['nom_enclos'] . '</td>
                        <td>' . $key['achete'] . '</td>
                        <td>' . $key['prete'] . '</td>
                        <td>' . $key['qte_objet'] . '</td>
                    </tr>';
        }
            $this->page .=
                        '</tbody>
            </table>';
        
        $this->displayPage();
    }
    

    /**
     * Affichage de la liste des objets côté mise à jour
     *
     * @param [array] $listeObjets -> tableau contenant la liste des objets
     * @return void
     *******************************************************************/
    public function editListeObjets($listeObjets) {
        
        // Appel du fichier config.php où sont déclarées 
        // les classes et les tables de données correspondantes
        include 'Config/config.php';
        
        $this->page .=
            '<h2>Liste des objets</h2>
            <table id="tableUser" class="table table-striped mb-0 text-center">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Code de l\'objet</th>
                        <th scope="col">Détail de l\'objet</th>
                        <th scope="col">Objet acheté</th>
                        <th scope="col">Objet prêté</th>
                        <th scope="col"><a href="index.php?controller=' . $classObjet . '&action=addForm">
                        <button class="btn btn-success"><i class="fas fa-plus"></i> Ajouter</button></a></th>
                        <th scope="col"><a href="index.php?controller=' . $classObjet . '&action=edit">
                        <button class="btn btn-info"><i class="fas fa-undo-alt"></i> Retour</button></a></th>
                        <th>Liste des enclos où se situe l\'objet</th>
                        ';
            $this->page .=
                    '</tr>
                </thead>
                <tbody>
                    <tr>';
        foreach ($listeObjets as $key) {
            $this->page .='
                        <td>' . $key['code_objet'] . '</td>
                        <td><a href="index.php?controller=' . $classObjet . '&action=editObjet&id=' . $key['code_objet'] . '">' . $key['nom_objet'] . '</a></td>
                        <td>' . $key['achete'] . '</td>
                        <td>' . $key['prete'] . '</td>
                        <td><a href="index.php?controller=' . $classObjet . '&action=delDB&id=' . $key["code_objet"] . '">
                        <button class="btn btn-danger"><i class="fas fa-trash-alt"></i> Supprimer</button></a></td>
                        <td><a href="index.php?controller=' . $classObjet . '&action=editForm&id=' . $key["code_objet"] . '"">
                        <button class="btn btn-warning"><i class="fas fa-edit"></i> Modifier</button></a></td>
                        <td><a href="index.php?controller=' . $classObjet . '&action=editListeEnclosObjet&id=' . $key['code_objet'] . '">' . $key['nom_objet'] . '</a></td>
                    </tr>';
        }
            $this->page .=
                '</tbody>
            </table>';
        // execution de la fonction displayPage() pour afficher la page dans le navigateur        
        $this->displayPage();
    }


    /**
     * Affichage du détail d'un objet côté mise à jour
     *
     * @param [type] $objet
     * @return void
     */
    public function editObjet($objet) {
        include 'Config/config.php';
        
        $this->page .=
            '<h2>Détail de l\'objet : ' . $objet['nom_objet'] . '</h2>
            <table id="tableUser" class="table table-striped mb-0 text-center">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Code de l\'objet</th>
                        <th scope="col">Détail de l\'objet</th>
                        <th scope="col">Objet acheté</th>
                        <th scope="col">Objet prêté</th>
                        <th scope="col"><a href="index.php?controller=' . $classObjet . '&action=addForm">
                        <button class="btn btn-success"><i class="fas fa-plus"></i> Ajouter</button></a></th>
                        <th scope="col"><a href="index.php?controller=' . $classObjet . '&action=edit">
                        <button class="btn btn-info"><i class="fas fa-undo-alt"></i> Retour</button></a></th>
                        ';
            $this->page .=
                    '</tr>
                        </thead>
                        <tbody>
                    <tr>';
            $this->page .=
                        '<td>' . $objet['code_objet'] . '</td>
                        <td>' . $objet['nom_objet'] . '</td>
                        <td>' . $objet['achete'] . '</td>
                        <td>' . $objet['prete'] . '</td>
                        <td><a href="index.php?controller=' . $classObjet . '&action=delDB&id=' . $objet["code_objet"] . '">
                        <button class="btn btn-danger"><i class="fas fa-trash-alt"></i> Supprimer</button></a></td>
                        <td><a href="index.php?controller=' . $classObjet . '&action=editForm&id=' . $objet["code_objet"] . '"">
                        <button class="btn btn-warning"><i class="fas fa-edit"></i> Modifier</button></a></td>
                    </tr>';
            $this->page .=
                        '</tbody>
            </table>';
        
        $this->displayPage();
    }


    /**
     * Affichage de la liste des enclos où se situe l'objet côté mise à jour
     *
     * @param [type] $objet
     * @param [type] $listeEnclosObjet
     * @return void
     */
    public function editListeEnclosObjet($objet, $listeEnclosObjet) {
        include 'Config/config.php';
        
        $this->page .=
            '<h2>Enclos où se situe l\'objet : ' . $objet['nom_objet'] . ' </h2>
            <table id="tableUser" class="table table-striped mb-0 text-center">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Nom de l\'enclos</th>
                        <th scope="col">Objet acheté</th>
                        <th scope="col">Objet prêté</th>
                        <th scope="col">Quantité de l\'objet</th>
                        <th scope="col"><a href="index.php?controller=' . $classObjet . '&action=addFormListeEnclosObjet">
                        <button class="btn btn-success"><i class="fas fa-plus"></i> Ajouter</button></a></th>
                        <th scope="col"><a href="index.php?controller=' . $classObjet . '&action=edit">
                        <button class="btn btn-info"><i class="fas fa-undo-alt"></i> Retour</button></a></th>
                        ';
            $this->page .=
                    '</tr>
                        </thead>
                        <tbody>
                    <tr>';
        foreach ($listeEnclosObjet as $key) {
            $this->page .=
                        '
                        <td>' . $key['nom_enclos'] . '</td>
                        <td>' . $key['achete'] . '</td>
                        <td>' . $key['prete'] . '</td>
                        <td>' . $key['qte_objet'] . '</td>
                        <td><a href="index.php?controller=' . $classObjet . '&action=delDBListeEnclosObjet&id=' . $key["code_objet"] . '">
                        <button class="btn btn-danger"><i class="fas fa-trash-alt"></i> Supprimer</button></a></td>
                        <td><a href="index.php?controller=' . $classObjet . '&action=editFormListeEnclosObjet&id=' . $key["code_objet"] . '">
                        <button class="btn btn-warning"><i class="fas fa-edit"></i> Modifier</button></a></td>
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
        
        $this->page .= "<h2>Formulaire d'ajout d'un objet</h2>";
        $this->page .= file_get_contents('View/template/forms/Objet/form' . $classObjet . '.php');
        $this->page = str_replace('{class}', $classObjet, $this->page);
        $this->page = str_replace('{action}', 'addDB', $this->page);
        $this->page = str_replace('{codOBJ}', '', $this->page);
        $this->page = str_replace('{nomOBJ}', '', $this->page);
        $this->page = str_replace('{achOBJ}', '', $this->page);
        $this->page = str_replace('{preOBJ}', '', $this->page);
        $this->displayPage();
    }
    

    /**
     * Affichage du formulaire d'edition
     *
     * @param [type] $objet
     * @return void
     ******************************************************/
    public function editForm($objet) {
        include 'Config/config.php';
        
        $this->page .= "<h2>Formulaire de modification d'un objet</h2>";
        $this->page .= file_get_contents('View/template/forms/Objet/form' . $classObjet . '.php');
        $this->page = str_replace('{class}', $classObjet, $this->page);
        $this->page = str_replace('{action}', 'editDB', $this->page);
        $this->page = str_replace('{codOBJ}', $objet['code_objet'], $this->page);
        $this->page = str_replace('{nomOBJ}', $objet['nom_objet'], $this->page);
        $this->page = str_replace('{achOBJ}', $objet['achete'], $this->page);
        $this->page = str_replace('{preOBJ}', $objet['prete'], $this->page);
        $this->displayPage();
    }


    /**
     * Affichage du formulaire d'ajout d'un enclos où se situe l'objet
     *
     * @return void
     ******************************************************/
    public function addFormListeEnclosObjet() {
        include 'Config/config.php';
        
        $this->page .= "<h2>Formulaire d'ajout d'un enclos où l'objet est présent</h2>";
        $this->page .= file_get_contents('View/template/forms/Objet/form' . $classObjet . 'ListeEnclosObjet.php');
        $this->page = str_replace('{class}', $classObjet, $this->page);
        $this->page = str_replace('{action}', 'addDBListeEnclosObjet', $this->page);
        $this->page = str_replace('{codOBJ}', '', $this->page);
        $this->page = str_replace('{codENC}', '', $this->page);
        $this->page = str_replace('{qteOBJ}', '', $this->page);
        $this->displayPage();
    }
    

    /**
     * Affichage du formulaire d'edition d'un enclos où se situe l'objet
     *
     * @param [type] $objet
     * @return void
     ******************************************************/
    public function editFormListeEnclosObjet($objet) {
        include 'Config/config.php';
        
        $this->page .= "<h2>Formulaire de modification d'un enclos où l'objet est présent</h2>";
        $this->page .= file_get_contents('View/template/forms/Objet/form' . $classObjet . 'ListeEnclosObjet.php');
        $this->page = str_replace('{class}', $classObjet, $this->page);
        $this->page = str_replace('{action}', 'editDBListeEnclosObjet', $this->page);
        $this->page = str_replace('{codOBJ}', $objet['code_objet'], $this->page);
        $this->page = str_replace('{codENC}', $objet['code_enclos'], $this->page);
        $this->page = str_replace('{qteOBJ}', $objet['qte_objet'], $this->page);
        $this->displayPage();
    }
    
    
}
