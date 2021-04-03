<?php

// Appel du fichier config.php où sont déclarées
// les classes et les tables de données correspondantes
include 'Config/config.php';

// Appel des fichiers AccueilModel.php et AccueilView.php
include 'Model/' . $classAccueil . 'Model.php';
include 'View/' . $classAccueil . 'View.php';

// Définition de la classe AccueilController
// la classe AccueilController hérite des propriétés et méthodes
// de sa classe mère "Controller"
class AccueilController extends Controller {
    
    public function __construct() {
        include 'Config/config.php';
        
        // stockage des classes AccueilView et AccueilModel
        // dans les variables $classView et $classModel
        $classView = $classAccueil . 'View';
        $classModel = $classAccueil . 'Model';

        // instanciation des classes AccueilView et AccueilModel
        // à l'aide des variables $classView et $classModel
        $this->view = new $classView();
        $this->model = new $classModel();
    }


    /**
     * Affichage de la page Accueil
     *
     * @return void
     ******************************************************/
    public function displayAccueil() {
        // $item = $this->model->getItem();
        // $this->view->displayPageItem($item);
        $this->view->displayAccueil();
    }
    

    /**
     * Construction de la page Accueil
     * (affichage de la page d'administration)
     * 
     * Liste des informations
     * @return void
     ******************************************************/
    public function edit() {
        // $listeItems = $this->model->getItems();
        // $this->view->editListPages($listeItems);
    }

    
    /**
     * Ajout d'une info en base de données (BDD)
     *
     * @return void
     ******************************************************/
    public function addDB() {
        include 'Config/config.php';
        
        $this->model->addDB();
        header('location:index.php?controller=' . $classAccueil . '&action=edit');
    }

    
    /**
     * Gestion de l'affichage du formulaire d'ajout
     *
     * @return void
     ******************************************************/
    public function addForm() {
        $this->view->addForm();
    }

    
    /**
     * Suppression d'une info en BDD
     *
     * @return void
     ******************************************************/
    public function delDB() {
        include 'Config/config.php';
        
        $this->model->delDB();
        header('location:index.php?controller=' . $classAccueil . '&action=edit');
    }

    
    /**
     * Récupération d'une info en BDD
     *
     * @return void
     ******************************************************/
    public function editForm() {        
        $item = $this->model->getItem();
        $this->view->editForm($item);
    }

    
    /**
     * Moddification d'une info en BDD
     *
     * @return void
     ******************************************************/
    public function editDB() {
        include 'Config/config.php';
        
        $this->model->editDB();
        header('location:index.php?controller=' . $classAccueil . '&action=edit');
    }

}
