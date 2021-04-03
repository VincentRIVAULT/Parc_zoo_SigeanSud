<?php

// Appel du fichier config.php où sont déclarées
// les classes et les tables de données correspondantes
include 'Config/config.php';

// Appel des fichiers SecuriteModel.php et SecuriteView.php
include 'Model/' . $classSecurite . 'Model.php';
include 'View/' . $classSecurite . 'View.php';

// Définition de la classe SecuriteController
// la classe SecuriteController hérite des propriétés et méthodes
// de sa classe mère "Controller"
class SecuriteController extends Controller {

    public function __construct() {
        include 'Config/config.php';
        
        $classView = $classSecurite . 'View';
        $classModel = $classSecurite . 'Model';

        // instanciation des classes SecuriteView et SecuriteModel
        $this->view = new $classView();
        $this->model = new $classModel();
    }

    /**
     * Afficher le formulaire de connexion
     *
     * @return void
     ************************************************************/
    public function formLogin() {
        $this->view->addForm();
    }

    /**
     * Vérifie si l'utilisateur est connecté
     *
     * @return void
     ************************************************************/
    public function login() {
        include 'Config/config.php';

        $profil = $this->model->testlogin();

        if ($profil != false) {
            if ($_SESSION['profil']['role'] == 'entretien') {
                header('location:index.php?controller=' . $classEnclos . '&action=display');
                // header('location:index.php');
            }
            if ($_SESSION['profil']['role'] == 'soignant') {
                header('location:index.php?controller=' . $classAnimal . '&action=display');
                // header('location:index.php');
            }
            if ($_SESSION['profil']['role'] == 'administrateur') {
                header('location:index.php?controller=' . $classEspece . '&action=display');
                // header('location:index.php');
            }
        } else {
            header('location:index.php?controller=' . $classSecurite . '&action=formLogin');
        } 
    }

    /**
     * Fonction de déconnexion
     *
     * @return void
     ************************************************************/
    public function logout() {
        $this->model->logout();
        header('location:index.php');
    }
}
