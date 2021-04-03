<?php

// Définition de la classe EspeceView
// la mention "extends" signifie que la classe EspeceView
// hérite des propriétés et méthodes de sa classe mère "View"
class EspeceView extends View {

    /**
     * Affichage de la page Espece côté consultation (liste des espèces)
     *
     * @param [type] $listeEspeces -> tableau contenant la liste des espèces
     * @return void
     ********************************************************************/
    public function displayListEspeces($listeEspeces) {       
        // Appel du fichier config.php où sont déclarées 
        // les classes et les tables de données correspondantes
        include 'Config/config.php';
        
        $this->page .=
            '<h2>Liste des espèces</h2>
            <table id="tableUser" class="table table-striped mb-0 text-center">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Code de l\'espèce</th>
                        <th scope="col">Nom de l\'espèce</th>
                        <th scope="col">Espèces cohabitables</th>';
        $this->page .=
                    '</tr>
                </thead>
                <tbody>
                    <tr>';
        foreach ($listeEspeces as $key) {
            $this->page .= '
                        <td>' . $key['code_espece'] . '</td>
                        <td>' . $key['nom_espece'] . '</td>
                        <td> <a href="index.php?controller=' . $classEspece 
                        . '&action=displayListEspecesCohabitables&id=' 
                        . $key["code_espece"] . '">' . $key["nom_espece"] . '</a></td>
                    </tr>';
        }
        $this->page .=
                '</tbody>
            </table>';        
        $this->displayPage();
    }

    public function displayListEspecesCohabitables($espece, $listeEspeceCohabitable) {
        include 'Config/config.php';

        $this->page .=
            '<h2>Liste des espèces cohabitables de l\'espèce : ' . $espece['nom_espece'] . '</h2>
            <table id="tableUser" class="table table-striped mb-0 text-center">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Code de l\'espèce</th>
                        <th scope="col">Nom de l\'Espèce</th>';
        $this->page .=
                    '</tr>
                </thead>
                <tbody>
                    <tr>';
        foreach ($listeEspeceCohabitable as $key) {
            $this->page .= '
                        <td>' . $key['code_espece'] . '</td>
                        <td>' . $key['nom_espece'] . '</td>
                    </tr>';
        }
        $this->page .=
                '</tbody>
            </table>';
        // execution de la fonction displayPage() pour afficher la page dans le navigateur
        $this->displayPage();
    }


    /**
     * Affichage de la liste des espèces côté mise à jour
     *
     * @param [array] $listeEspeces -> tableau contenant la liste des espèces
     * @return void
     *******************************************************************/
    public function editListEspeces($listeEspeces) {
        // Appel du fichier config.php où sont déclarées 
        // les classes et les tables de données correspondantes
        include 'Config/config.php';
        // On ajoute du contenu dans la page avec $this->page
        $this->page .=
            '<h2>Liste des espèces</h2>
            <table id="tableUser" class="table table-striped mb-0 text-center">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Code de l\'espèce</th>
                        <th scope="col">Nom de l\'espèce</th>                       
                        <th scope="col"><a href="index.php?controller=' . $classEspece . '&action=addForm">
                        <button class="btn btn-success"><i class="fas fa-plus"></i> Ajouter</button></a></th>
                        <th scope="col"><a href="index.php?controller=' . $classEspece . '&action=edit">
                        <button class="btn btn-info"><i class="fas fa-undo-alt"></i> Retour</button></a></th>
                        <th scope="col">Espèces cohabitables</th>';
        $this->page .=
                    '</tr>
                </thead>
                <tbody>
                    <tr>';
        foreach ($listeEspeces as $key) {
            $this->page .='
                        <td>' . $key['code_espece'] . '</td>
                        <td>' . $key['nom_espece'] . '</td>                        
                        <td><a href="index.php?controller=' . $classEspece . '&action=delDB&id=' 
                        . $key["code_espece"] . '">
                        <button class="btn btn-danger"><i class="fas fa-trash-alt"></i> Supprimer</button></a></td>
                        <td><a href="index.php?controller=' . $classEspece . '&action=editForm&id=' 
                        . $key["code_espece"] . '"">
                        <button class="btn btn-warning"><i class="fas fa-edit"></i> Modifier</button></a></td>
                        <td> <a href="index.php?controller=' . $classEspece . '&action=editListEspecesCohabitables&id=' 
                        . $key["code_espece"] . '">' . $key["nom_espece"] . '</a></td>
                    </tr>';
        }
        $this->page .=
                '</tbody>
            </table>';
        // execution de la fonction displayPage() pour afficher la page dans le navigateur    
        $this->displayPage();
    }

    public function editListEspecesCohabitables($espece, $listeEspeceCohabitable) {
        include 'Config/config.php';
        
        $this->page .=
        '<h2>Liste des espèces cohabitables de l\'espèce : ' . $espece['nom_espece'] . '</h2>
            <table id="tableUser" class="table table-striped mb-0 text-center">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Code de l\'espèce</th>
                        <th scope="col">Nom de l\'espèce</th>
                        <th scope="col"><a href="index.php?controller=' 
                        . $classEspece . '&action=addFormEspeceCohabitable">
                        <button class="btn btn-success"><i class="fas fa-plus"></i> Ajouter</button></a></th>
                        <th scope="col"><a href="index.php?controller=' . $classEspece . '&action=edit">
                        <button class="btn btn-info"><i class="fas fa-undo-alt"></i> Retour</button></a></th>';
        $this->page .=
                    '</tr>
                </thead>
                <tbody>
                    <tr>';      
        foreach ($listeEspeceCohabitable as $key) {
            $this->page .='
                        <td>' . $key['code_espece'] . '</td>
                        <td>' . $key['nom_espece'] . '</td>                        
                        <td><a href="index.php?controller=' . $classEspece . '&action=delDBEspeceCohabitable&id=' 
                        . $key["code_espece_1"].'">
                        <button class="btn btn-danger"><i class="fas fa-trash-alt"></i> Supprimer</button></a></td>
                        <td></td>
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
        
        $this->page .= file_get_contents('View/template/forms/Espece/form' . $classEspece . '.php');
        $this->page = str_replace('{class}', $classEspece, $this->page);
        $this->page = str_replace('{action}', 'addDB', $this->page);
        $this->page = str_replace('{codESP}', '', $this->page);
        $this->page = str_replace('{nomESP}', '', $this->page);
        $this->displayPage();
    }

    /**
     * Affichage du formulaire d'ajout pour les espèces cohabitables
     *
     * @return void
     */
    public function addFormEspeceCohabitable() {
        include 'Config/config.php';
        
        $this->page .= file_get_contents('View/template/forms/Espece/form' . $classEspece . 'Cohabitable.php');
        $this->page = str_replace('{class}', $classEspece, $this->page);
        $this->page = str_replace('{action}', 'addDBEspeceCohabitable', $this->page);
        $this->page = str_replace('{codESP}', '', $this->page);
        $this->page = str_replace('{codESP1}', '', $this->page);
        $this->displayPage();
    }

    /**
     * Affichage du formulaire d'edition
     *
     * @param [type] $espece
     * @return void
     ******************************************************/
    public function editForm($espece) {
        include 'Config/config.php';
        
        $this->page .= file_get_contents('View/template/forms/Espece/form' . $classEspece . '.php');
        $this->page = str_replace('{class}', $classEspece, $this->page);
        $this->page = str_replace('{action}', 'editDB', $this->page);
        $this->page = str_replace('{codESP}', $espece['code_espece'], $this->page);
        $this->page = str_replace('{nomESP}', $espece['nom_espece'], $this->page);
        $this->displayPage();
    }
}
