<?php

// Définition de la classe SecuriteView
// la mention "extends" signifie que la classe SecuriteView
// hérite des propriétés et méthodes de sa classe mère "View"
class SecuriteView extends View {

    /**
     * Affichage du formulaire d'authentification
     *
     * @return void
     ***************************************************************/
    public function addForm() {
        // récupération du fichier formLogin.php
        $this->page .= file_get_contents('View/template/forms/formLogin.php');  
        
        // execution de la fonction displayPage() pour afficher la page connexion dans le navigateur
        $this->displayPage();
    }

}
