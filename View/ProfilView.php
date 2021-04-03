<?php

// Définition de la classe ProfilView
// la mention "extends" signifie que la classe ProfilView
// hérite des propriétés et méthodes de sa classe mère "View"
class ProfilView extends View {


    /**
     * Affichage de la liste de tous les profils côté consultation
     *
     * @param [type] $listeProfils
     * @return void
     */
    public function displayListeProfils($listeProfils) {

        // Appel du fichier config.php où sont déclarées
        // les classes et les tables de données correspondantes
        include 'Config/config.php';
        
        $this->page .=
            '<h2>Profils du personnel du parc</h2>
            <table id="tableUser" class="table table-striped mb-0 text-center">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Identifiant</th>
                        <th scope="col">Nom</th>
                        <th scope="col">Prénom</th>
                        <th scope="col">Adresse</th>
                        <th scope="col">Téléphone</th>
                        <th scope="col">Rôle</th>
                        ';
            $this->page .=
                '</tr>
                    </thead>
                    <tbody>
                <tr>';
        foreach ($listeProfils as $key) {
            $this->page .='
                        <td>' . $key['id_profil'] . '</td>
                        <td>' . $key['identifiant'] . '</td>
                        <td>' . $key['nom'] . '</td>
                        <td>' . $key['prenom'] . '</td>
                        <td>' . $key['adresse'] . '</td>
                        <td>' . $key['telephone'] . '</td>
                        <td>' . $key['role'] . '</td>
                    </tr>';
        }
            $this->page .=
                '</tbody>
            </table>';
        // execution de la fonction displayPage() pour afficher la page dans le navigateur
        $this->displayPage();
    }


    public function displayGestionPersonnel($repartitionPersonnel) {
        include 'Config/config.php';
        
        $this->page .=
            '<h2>Liste du personnel selon leur rôle</h2>
            <table id="tableUser" class="table table-striped mb-0 text-center">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Rôle</th>
                        <th scope="col">Nom</th>
                        <th scope="col">Prénom</th>
                        <th scope="col">Espèces confiées aux soignants</th>
                        <th scope="col">Enclos affectés au personnel d\'entretien</th>
                        ';
            $this->page .=
                '</tr>
                    </thead>
                    <tbody>
                <tr>';
        foreach ($repartitionPersonnel as $key) {
            $this->page .='
                        <td>' . $key['role'] . '</td>
                        <td>' . $key['nom'] . '</td>
                        <td>' . $key['prenom'] . '</td>
                        <td><a href="index.php?controller=' . $classProfil . '&action=displayPersonnelSoignant&id=' . $key['role'] . '">Espèces confiées aux soignants</a></td>
                        <td><a href="index.php?controller=' . $classProfil . '&action=displayPersonnelEntretien&id=' . $key['role'] . '">Enclos affectés au personnel d\'entretien</a></td>
                    </tr>';
        }
            $this->page .=
                '</tbody>
            </table>';
        // execution de la fonction displayPage() pour afficher la page dans le navigateur
        $this->displayPage();
    }


    public function displayPersonnelSoignant($repartitionEspecesSoignant) {
        include 'Config/config.php';
        
        $this->page .=
            '<h2>Personnel soignant avec leurs espèces</h2>
            <table id="tableUser" class="table table-striped mb-0 text-center">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Nom</th>
                        <th scope="col">Prénom</th>
                        <th scope="col">Nom de l\'espèce</th>
                        ';
            $this->page .=
                '</tr>
                    </thead>
                    <tbody>
                <tr>';
        foreach ($repartitionEspecesSoignant as $key) {
            $this->page .='
                        <td>' . $key['nom'] . '</td>
                        <td>' . $key['prenom'] . '</td>
                        <td>' . $key['nom_espece'] . '</td>
                    </tr>';
        }
            $this->page .=
                '</tbody>
            </table>';
        // execution de la fonction displayPage() pour afficher la page dans le navigateur
        $this->displayPage();
    }


    public function displayPersonnelEntretien($repartitionEnclosEntretien) {
        include 'Config/config.php';
        
        $this->page .=
            '<h2>Personnel d\'entretien avec leurs enclos</h2>
            <table id="tableUser" class="table table-striped mb-0 text-center">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Nom</th>
                        <th scope="col">Prénom</th>
                        <th scope="col">Nom de l\'enclos</th>
                        ';
            $this->page .=
                '</tr>
                    </thead>
                    <tbody>
                <tr>';
        foreach ($repartitionEnclosEntretien as $key) {
            $this->page .='
                        <td>' . $key['nom'] . '</td>
                        <td>' . $key['prenom'] . '</td>
                        <td>' . $key['nom_enclos'] . '</td>
                    </tr>';
        }
            $this->page .=
                '</tbody>
            </table>';
        // execution de la fonction displayPage() pour afficher la page dans le navigateur
        $this->displayPage();
    }


    /**
     * Affichage de la liste de tous les profils coté mise à jour
     *
     * @param [type] $listeProfils
     * @return void
     ******************************************************/
    public function editListeProfils($listeProfils) {

        // Appel du fichier config.php où sont déclarées
        // les classes et les tables de données correspondantes
        include 'Config/config.php';
        
        $this->page .=
            '<h2>Profils du personnel du parc</h2>
            <table id="tableUser" class="table table-striped mb-0 text-center">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Identifiant</th>
                        <th scope="col">Nom</th>
                        <th scope="col">Prénom</th>
                        <th scope="col">Adresse</th>
                        <th scope="col">Téléphone</th>
                        <th scope="col">Rôle</th>
                        <th scope="col"><a href="index.php?controller=' . $classProfil . '&action=addForm">
                        <button class="btn btn-success"><i class="fas fa-plus"></i> Ajouter</button></a></th>
                        <th scope="col"><a href="index.php?controller=' . $classProfil . '&action=edit">
                        <button class="btn btn-info"><i class="fas fa-undo-alt"></i> Retour</button></a></th>
                        ';
            $this->page .=
                '</tr>
                    </thead>
                    <tbody>
                <tr>';
        foreach ($listeProfils as $key) {
            $this->page .='
                        <td>' . $key['id_profil'] . '</td>
                        <td>' . $key['identifiant'] . '</td>
                        <td>' . $key['nom'] . '</td>
                        <td>' . $key['prenom'] . '</td>
                        <td>' . $key['adresse'] . '</td>
                        <td>' . $key['telephone'] . '</td>
                        <td>' . $key['role'] . '</td>
                        <td><a href="index.php?controller=' . $classProfil . '&action=delDB&id=' . $key["id_profil"] . '">
                        <button class="btn btn-danger"><i class="fas fa-trash-alt"></i> Supprimer</button></a></td>
                        <td><a href="index.php?controller=' . $classProfil . '&action=editForm&id=' . $key["id_profil"] . '"">
                        <button class="btn btn-warning"><i class="fas fa-edit"></i> Modifier</button></a></td>
                    </tr>';
        }
            $this->page .=
                '</tbody>
            </table>';
        // execution de la fonction displayPage() pour afficher la page dans le navigateur
        $this->displayPage();
    }


    /**
     * Affichage de la liste des profils du personnel soignant côté mise à jour
     *
     * @param [type] $listeProfilsSoignant
     * @return void
     */
    public function editListeProfilsSoignant($listeProfilsSoignant) {
        include 'Config/config.php';
        
        $this->page .=
            '<h2>Profils du personnel soignant</h2>
            <table id="tableUser" class="table table-striped mb-0 text-center">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Identifiant</th>
                        <th scope="col">Nom</th>
                        <th scope="col">Prénom</th>
                        <th scope="col">Adresse</th>
                        <th scope="col">Téléphone</th>
                        <th scope="col">Rôle</th>
                        <th scope="col"><a href="index.php?controller=' . $classProfil . '&action=addForm">
                        <button class="btn btn-success"><i class="fas fa-plus"></i> Ajouter</button></a></th>
                        <th scope="col"><a href="index.php?controller=' . $classProfil . '&action=edit">
                        <button class="btn btn-info"><i class="fas fa-undo-alt"></i> Retour</button></a></th>
                        <th>Liste des espèces confiées</th>
                        ';
            $this->page .=
                '</tr>
                    </thead>
                    <tbody>
                <tr>';
        foreach ($listeProfilsSoignant as $key) {
            $this->page .='
                        <td>' . $key['id_profil'] . '</td>
                        <td>' . $key['identifiant'] . '</td>
                        <td>' . $key['nom'] . '</td>
                        <td>' . $key['prenom'] . '</td>
                        <td>' . $key['adresse'] . '</td>
                        <td>' . $key['telephone'] . '</td>
                        <td>' . $key['role'] . '</td>
                        <td><a href="index.php?controller=' . $classProfil . '&action=delDB&id=' . $key["id_profil"] . '">
                        <button class="btn btn-danger"><i class="fas fa-trash-alt"></i> Supprimer</button></a></td>
                        <td><a href="index.php?controller=' . $classProfil . '&action=editForm&id=' . $key["id_profil"] . '"">
                        <button class="btn btn-warning"><i class="fas fa-edit"></i> Modifier</button></a></td>
                        <td><a href="index.php?controller=' . $classProfil . '&action=editListeEspecesSoignant&id=' . $key['id_profil'] . '">' . $key['nom'] . ' ' . $key['prenom'] . '</a></td>
                    </tr>';
        }
            $this->page .=
                '</tbody>
            </table>';
        // execution de la fonction displayPage() pour afficher la page dans le navigateur
        $this->displayPage();
    }


    /**
     * Affichage de la liste des profils du personnel d'entretien côté mise à jour
     *
     * @param [type] $listeProfilsEntretien
     * @return void
     */
    public function editListeProfilsEntretien($listeProfilsEntretien) {
        include 'Config/config.php';
        
        $this->page .=
            '<h2>Profils du personnel d\'entretien</h2>
            <table id="tableUser" class="table table-striped mb-0 text-center">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Identifiant</th>
                        <th scope="col">Nom</th>
                        <th scope="col">Prénom</th>
                        <th scope="col">Adresse</th>
                        <th scope="col">Téléphone</th>
                        <th scope="col">Rôle</th>
                        <th scope="col"><a href="index.php?controller=' . $classProfil . '&action=addForm">
                        <button class="btn btn-success"><i class="fas fa-plus"></i> Ajouter</button></a></th>
                        <th scope="col"><a href="index.php?controller=' . $classProfil . '&action=edit">
                        <button class="btn btn-info"><i class="fas fa-undo-alt"></i> Retour</button></a></th>
                        <th>Liste des enclos affectés</th>
                        ';
            $this->page .=
                '</tr>
                    </thead>
                    <tbody>
                <tr>';
        foreach ($listeProfilsEntretien as $key) {
            $this->page .='
                        <td>' . $key['id_profil'] . '</td>
                        <td>' . $key['identifiant'] . '</td>
                        <td>' . $key['nom'] . '</td>
                        <td>' . $key['prenom'] . '</td>
                        <td>' . $key['adresse'] . '</td>
                        <td>' . $key['telephone'] . '</td>
                        <td>' . $key['role'] . '</td>
                        <td><a href="index.php?controller=' . $classProfil . '&action=delDB&id=' . $key["id_profil"] . '">
                        <button class="btn btn-danger"><i class="fas fa-trash-alt"></i> Supprimer</button></a></td>
                        <td><a href="index.php?controller=' . $classProfil . '&action=editForm&id=' . $key["id_profil"] . '"">
                        <button class="btn btn-warning"><i class="fas fa-edit"></i> Modifier</button></a></td>
                        <td><a href="index.php?controller=' . $classProfil . '&action=editListeEnclosEntretien&id=' . $key['id_profil'] . '">' . $key['nom'] . ' ' . $key['prenom'] . '</a></td>
                    </tr>';
        }
            $this->page .=
                '</tbody>
            </table>';
        // execution de la fonction displayPage() pour afficher la page dans le navigateur
        $this->displayPage();
    }


    /**
     * Affichage de la liste des espèces confiées au personnel soignant côté mise à jour
     *
     * @param [type] $listeEspecesSoignant
     * @return void
     */
    public function editListeEspecesSoignant($profil, $listeEspecesSoignant) {
        include 'Config/config.php';
        
        $this->page .=
            '<h2>Liste des espèces confiées à : ' . $profil['prenom'] . ' ' . $profil['nom'] . '</h2>
            <table id="tableUser" class="table table-striped mb-0 text-center">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Personnel soignant</th>
                        <th scope="col">Nom de l\'espèce</th>
                        <th scope="col"><a href="index.php?controller=' . $classProfil . '&action=addFormEspecesSoignant">
                        <button class="btn btn-success"><i class="fas fa-plus"></i> Ajouter</button></a></th>
                        <th scope="col"><a href="index.php?controller=' . $classProfil . '&action=edit">
                        <button class="btn btn-info"><i class="fas fa-undo-alt"></i> Retour</button></a></th>
                        ';
            $this->page .=
                '</tr>
                    </thead>
                    <tbody>
                <tr>';
        foreach ($listeEspecesSoignant as $key) {
            $this->page .='
                        <td>' . $key['id_profil_soignant'] . '</td>
                        <td>' . $key['nom_espece'] . '</td>
                        <td><a href="index.php?controller=' . $classProfil . '&action=delDBEspecesSoignant&id=' . $key["code_espece"] . '">
                        <button class="btn btn-danger"><i class="fas fa-trash-alt"></i> Supprimer</button></a></td>
                        <td><a href="index.php?controller=' . $classProfil . '&action=editFormEspecesSoignant&id=' . $key["code_espece"] . '"">
                        <button class="btn btn-warning"><i class="fas fa-edit"></i> Modifier</button></a></td>
                    </tr>';
        }
            $this->page .=
                '</tbody>
            </table>';
        // execution de la fonction displayPage() pour afficher la page dans le navigateur
        $this->displayPage();
    }


    /**
     * Affichage de la liste des enclos affectés au personnel d'entretien côté mise à jour
     *
     * @param [type] $listeEnclosEntretien
     * @return void
     */
    public function editListeEnclosEntretien($profil, $listeEnclosEntretien) {
        include 'Config/config.php';
        
        $this->page .=
            '<h2>Liste des enclos affectés à : ' . $profil['prenom'] . ' ' . $profil['nom'] . '</h2>
            <table id="tableUser" class="table table-striped mb-0 text-center">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Personnel entretien</th>
                        <th scope="col">Nom de l\'enclos</th>
                        <th scope="col"><a href="index.php?controller=' . $classProfil . '&action=addFormEnclosEntretien">
                        <button class="btn btn-success"><i class="fas fa-plus"></i> Ajouter</button></a></th>
                        <th scope="col"><a href="index.php?controller=' . $classProfil . '&action=edit">
                        <button class="btn btn-info"><i class="fas fa-undo-alt"></i> Retour</button></a></th>
                        ';
            $this->page .=
                '</tr>
                    </thead>
                    <tbody>
                <tr>';
        foreach ($listeEnclosEntretien as $key) {
            $this->page .='
                        <td>' . $key['id_profil_entretien'] . '</td>
                        <td>' . $key['nom_enclos'] . '</td>
                        <td><a href="index.php?controller=' . $classProfil . '&action=delDBEnclosEntretien&id=' . $key["code_enclos"] . '">
                        <button class="btn btn-danger"><i class="fas fa-trash-alt"></i> Supprimer</button></a></td>
                        <td><a href="index.php?controller=' . $classProfil . '&action=editFormEnclosEntretien&id=' . $key["code_enclos"] . '"">
                        <button class="btn btn-warning"><i class="fas fa-edit"></i> Modifier</button></a></td>
                    </tr>';
        }
            $this->page .=
                '</tbody>
            </table>';
        // execution de la fonction displayPage() pour afficher la page dans le navigateur
        $this->displayPage();
    }


    public function editGestionPersonnel($repartitionPersonnel) {
        include 'Config/config.php';
        
        $this->page .=
            '<h2>Liste du personnel selon leur rôle</h2>
            <table id="tableUser" class="table table-striped mb-0 text-center">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Rôle</th>
                        <th scope="col">Nom</th>
                        <th scope="col">Prénom</th>
                        <th scope="col">Espèces confiées aux soignants</th>
                        <th scope="col">Enclos affectés au personnel d\'entretien</th>
                        ';
            $this->page .=
                '</tr>
                    </thead>
                    <tbody>
                <tr>';
        foreach ($repartitionPersonnel as $key) {
            $this->page .='
                        <td>' . $key['role'] . '</td>
                        <td>' . $key['nom'] . '</td>
                        <td>' . $key['prenom'] . '</td>
                        <td><a href="index.php?controller=' . $classProfil . '&action=editPersonnelSoignant&id=' . $key['role'] . '">Espèces confiées aux soignants</a></td>
                        <td><a href="index.php?controller=' . $classProfil . '&action=editPersonnelEntretien&id=' . $key['role'] . '">Enclos affectés au personnel d\'entretien</a></td>
                    </tr>';
        }
            $this->page .=
                '</tbody>
            </table>';
        // execution de la fonction displayPage() pour afficher la page dans le navigateur
        $this->displayPage();
    }

    
    public function editPersonnelSoignant($repartitionEspecesSoignant) {
        include 'Config/config.php';
        
        $this->page .=
            '<h2>Personnel soignant avec leurs espèces</h2>
            <table id="tableUser" class="table table-striped mb-0 text-center">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Nom</th>
                        <th scope="col">Prénom</th>
                        <th scope="col">Nom de l\'espèce</th>
                        ';
            $this->page .=
                    '</tr>
                </thead>
                <tbody>
                    <tr>';
        foreach ($repartitionEspecesSoignant as $key) {
            $this->page .='
                        <td>' . $key['nom'] . '</td>
                        <td>' . $key['prenom'] . '</td>
                        <td>' . $key['nom_espece'] . '</td>
                    </tr>';
        }
            $this->page .=
                '</tbody>
            </table>';
        // execution de la fonction displayPage() pour afficher la page dans le navigateur
        $this->displayPage();
    }

    
    public function editPersonnelEntretien($repartitionEnclosEntretien) {
        include 'Config/config.php';
        
        $this->page .=
            '<h2>Personnel d\'entretien avec leurs enclos</h2>
            <table id="tableUser" class="table table-striped mb-0 text-center">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Nom</th>
                        <th scope="col">Prénom</th>
                        <th scope="col">Nom de l\'enclos</th>
                        ';
            $this->page .=
                '</tr>
                    </thead>
                    <tbody>
                <tr>';
        foreach ($repartitionEnclosEntretien as $key) {
            $this->page .='
                        <td>' . $key['nom'] . '</td>
                        <td>' . $key['prenom'] . '</td>
                        <td>' . $key['nom_enclos'] . '</td>
                    </tr>';
        }
            $this->page .=
                '</tbody>
            </table>';
        // execution de la fonction displayPage() pour afficher la page dans le navigateur
        $this->displayPage();
    }
    

    /**
     * Affichage du formulaire d'ajout
     *
     * @return void
     ******************************************************/
    public function addForm() {
        include 'Config/config.php';
        
        $this->page .= file_get_contents('View/template/forms/Profil/form' . $classProfil . '.php');
        $this->page = str_replace('{class}', $classProfil, $this->page);
        $this->page = str_replace('{action}', 'addDB', $this->page);
        $this->page = str_replace('{idPRO}', '', $this->page);
        $this->page = str_replace('{identifiant}', '', $this->page);
        $this->page = str_replace('{mdp}', '', $this->page);
        $this->page = str_replace('{nom}', '', $this->page);
        $this->page = str_replace('{prenom}', '', $this->page);
        $this->page = str_replace('{adresse}', '', $this->page);
        $this->page = str_replace('{telephone}', '', $this->page);
        $this->page = str_replace('{role}', '', $this->page);
        $this->displayPage();
    }
    

    /**
     * Affichage du formulaire d'edition
     *
     * @param [type] $profil
     * @return void
     ******************************************************/
    public function editForm($profil) {
        include 'Config/config.php';
        
        $this->page .= file_get_contents('View/template/forms/Profil/form' . $classProfil . '.php');
        $this->page = str_replace('{class}', $classProfil, $this->page);
        $this->page = str_replace('{action}', 'editDB', $this->page);
        $this->page = str_replace('{idPRO}', $profil['id_profil'], $this->page);
        $this->page = str_replace('{identifiant}', $profil['identifiant'], $this->page);
        $this->page = str_replace('{mdp}', $profil['mdp'], $this->page);
        $this->page = str_replace('{nom}', $profil['nom'], $this->page);
        $this->page = str_replace('{prenom}', $profil['prenom'], $this->page);
        $this->page = str_replace('{adresse}', $profil['adresse'], $this->page);
        $this->page = str_replace('{telephone}', $profil['telephone'], $this->page);
        $this->page = str_replace('{role}', $profil['role'], $this->page);
        $this->displayPage();
    }


    public function addFormEspecesSoignant() {
        include 'Config/config.php';
        
        $this->page .= file_get_contents('View/template/forms/Profil/form' . $classProfil . 'EspecesSoignant.php');
        $this->page = str_replace('{class}', $classProfil, $this->page);
        $this->page = str_replace('{action}', 'addDBEspecesSoignant', $this->page);
        $this->page = str_replace('{idPRO}', '', $this->page);
        $this->page = str_replace('{codESP}', '', $this->page);
        $this->displayPage();
    }


    public function editFormEspecesSoignant($profil) {
        include 'Config/config.php';
        
        $this->page .= file_get_contents('View/template/forms/Profil/form' . $classProfil . 'EspecesSoignant.php');
        $this->page = str_replace('{class}', $classProfil, $this->page);
        $this->page = str_replace('{action}', 'editDBEspecesSoignant', $this->page);
        $this->page = str_replace('{idPRO}', $profil['id_profil_soignant'], $this->page);
        $this->page = str_replace('{codESP}', $profil['code_espece'], $this->page);
        $this->displayPage();
    }


    public function addFormEnclosEntretien() {
        include 'Config/config.php';
        
        $this->page .= file_get_contents('View/template/forms/Profil/form' . $classProfil . 'EnclosEntretien.php');
        $this->page = str_replace('{class}', $classProfil, $this->page);
        $this->page = str_replace('{action}', 'addDBEnclosEntretien', $this->page);
        $this->page = str_replace('{idPRO}', '', $this->page);
        $this->page = str_replace('{codENC}', '', $this->page);
        $this->displayPage();
    }


    public function editFormEnclosEntretien($profil) {
        include 'Config/config.php';
        
        $this->page .= file_get_contents('View/template/forms/Profil/form' . $classProfil . 'EnclosEntretien.php');
        $this->page = str_replace('{class}', $classProfil, $this->page);
        $this->page = str_replace('{action}', 'editDBEnclosEntretien', $this->page);
        $this->page = str_replace('{idPRO}', $profil['id_profil_entretien'], $this->page);
        $this->page = str_replace('{codENC}', $profil['code_enclos'], $this->page);
        $this->displayPage();
    }


}
