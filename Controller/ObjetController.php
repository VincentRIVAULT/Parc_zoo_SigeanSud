<?php

// Appel du fichier config.php où sont déclarées
// les classes et les tables de données correspondantes
include 'Config/config.php';

// Appel des fichiers ObjetModel.php et ObjetView.php
include 'Model/' . $classObjet . 'Model.php';
include 'View/' . $classObjet . 'View.php';

// Définition de la classe ObjetController
// la classe ObjetController hérite des propriétés et méthodes
// de sa classe mère "Controller"
class ObjetController extends Controller {
    
    public function __construct() {
        include 'Config/config.php';
        
        // stockage des classes ObjetView et ObjetModel
        // dans les variables $classView et $classModel
        $classView = $classObjet . 'View';
        $classModel = $classObjet . 'Model';

        // instanciation des classes ObjetView et ObjetModel
        // à l'aide des variables $classView et $classModel
        $this->view = new $classView();
        $this->model = new $classModel();
    }


    /**
     * Affichage de la page Objet
     *
     * @return void
     ******************************************************/
    public function display() {
        $listeObjets = $this->model->getListeObjets();
        $this->view->displayListeObjets($listeObjets);
    }


    public function displayObjet() {
        $objet = $this->model->getObjet();
        $this->view->displayObjet($objet);
    }


    /**
     * Affichage de la page enclos de l'objet
     *
     * @return void
     */
    public function displayListeEnclosObjet() {
        $objet = $this->model->getObjet();
        $listeEnclosObjet = $this->model->getListeEnclosObjet();
        $this->view->displayListeEnclosObjet($objet, $listeEnclosObjet);
    }
    

    /**
     * Construction de la page Objet
     * (affichage de la page d'administration)
     * 
     * Liste des informations
     * @return void
     ******************************************************/
    public function edit() {
        $listeObjets = $this->model->getListeObjets();
        $this->view->editListeObjets($listeObjets);
    }


    public function editObjet() {
        $objet = $this->model->getObjet();
        $this->view->editObjet($objet);
    }


    /**
     * Affichage de liste des enclos où se situe l'objet
     *
     * @return void
     */
    public function editListeEnclosObjet() {
        $objet = $this->model->getObjet();
        $listeEnclosObjet = $this->model->getListeEnclosObjet();
        $this->view->editListeEnclosObjet($objet, $listeEnclosObjet);
    }

    
    /**
     * Ajout d'une info en base de données (BDD)
     *
     * @return void
     ******************************************************/
    public function addDB() {
        include 'Config/config.php';
        
        $this->model->addDB();
        header('location:index.php?controller=' . $classObjet . '&action=edit');
    }


    public function addDBListeEnclosObjet() {
        include 'Config/config.php';
        
        $this->model->addDBListeEnclosObjet();
        header('location:index.php?controller=' . $classObjet . '&action=edit');
    }

    
    /**
     * Gestion de l'affichage du formulaire d'ajout
     *
     * @return void
     ******************************************************/
    public function addForm() {
        $this->view->addForm();
    }


    public function addFormListeEnclosObjet() {
        $this->view->addFormListeEnclosObjet();
    }

    
    /**
     * Suppression d'une info en BDD
     *
     * @return void
     ******************************************************/
    public function delDB() {
        include 'Config/config.php';
        
        $this->model->delDB();
        header('location:index.php?controller=' . $classObjet . '&action=edit');
    }


    public function delDBListeEnclosObjet() {
        include 'Config/config.php';
        
        $this->model->delDBListeEnclosObjet();
        header('location:index.php?controller=' . $classObjet . '&action=edit');
    }
    
    /**
     * Récupération d'une info en BDD
     *
     * @return void
     ******************************************************/
    public function editForm() {        
        $objet = $this->model->getObjet();
        $this->view->editForm($objet);
    }


    public function editFormListeEnclosObjet() {        
        $objet = $this->model->getObjet();
        $this->view->editFormListeEnclosObjet($objet);
    }

    
    /**
     * Moddification d'une info en BDD
     *
     * @return void
     ******************************************************/
    public function editDB() {
        include 'Config/config.php';
        
        $this->model->editDB();
        header('location:index.php?controller=' . $classObjet . '&action=edit');
    }


    public function editDBListeEnclosObjet() {
        include 'Config/config.php';
        
        $this->model->editDBListeEnclosObjet();
        header('location:index.php?controller=' . $classObjet . '&action=edit');
    }

}
