<?php

// Appel du fichier config.php où sont déclarées
// les classes et les tables de données correspondantes
include 'Config/config.php';

// Appel des fichiers PagesModel.php et PagesView.php
include 'Model/' . $classEspece . 'Model.php';
include 'View/' . $classEspece . 'View.php';

// Définition de la classe EspeceController
// la classe PagesController hérite des propriétés et méthodes
// de sa classe mère "Controller"
class EspeceController extends Controller {
    
    public function __construct() {
        include 'Config/config.php';
        
        // stockage des classes EspeceView et EspeceModel
        // dans les variables $classView et $classModel
        $classView = $classEspece . 'View';
        $classModel = $classEspece . 'Model';

        // instanciation des classes EspeceView et EspeceModel
        // à l'aide des variables $classView et $classModel
        $this->view = new $classView();
        $this->model = new $classModel();
    }


    /**
     * Affichage de la page Espece
     *
     * @return void
     ******************************************************/
    public function display() {
        $listeEspeces = $this->model->getEspeces();
        $this->view->displayListEspeces($listeEspeces);
    }

    public function displayListEspecesCohabitables() {
        $espece = $this->model->getEspece();
        $listeEspeceCohabitable = $this->model->getEspeceCohabitable();
        $this->view->displayListEspecesCohabitables($espece, $listeEspeceCohabitable);
    }
    

    /**
     * Construction de la page Espece
     * (affichage de la page d'administration)
     * 
     * Liste des informations
     * @return void
     ******************************************************/
    public function edit() {
        $listeEspeces = $this->model->getEspeces();
        $this->view->editListEspeces($listeEspeces);
    }

    public function editListEspecesCohabitables() {
        $espece = $this->model->getEspece();
        $listeEspeceCohabitable = $this->model->getEspeceCohabitable();
        $this->view->editListEspecesCohabitables($espece, $listeEspeceCohabitable);
    }

    
    /**
     * Ajout d'une info en base de données (BDD)
     *
     * @return void
     ******************************************************/
    public function addDB() {
        include 'Config/config.php';
        
        $this->model->addDB();
        header('location:index.php?controller=' . $classEspece . '&action=edit');
    }

    public function addDBEspeceCohabitable() {
        include 'Config/config.php';
        
        $this->model->addDBEspeceCohabitable();
        header('location:index.php?controller=' . $classEspece . '&action=edit');
    }

    
    /**
     * Gestion de l'affichage du formulaire d'ajout
     *
     * @return void
     ******************************************************/
    public function addForm() {
        $this->view->addForm();
    }

    public function addFormEspeceCohabitable() {
        $this->view->addFormEspeceCohabitable();
    }

    
    /**
     * Suppression d'une info en BDD
     *
     * @return void
     ******************************************************/
    public function delDB() {
        include 'Config/config.php';
        
        $this->model->delDB();
        header('location:index.php?controller=' . $classEspece . '&action=edit');
    }

    public function delDBEspeceCohabitable() {
        include 'Config/config.php';
        
        $this->model->delDBEspeceCohabitable();
        header('location:index.php?controller=' . $classEspece . '&action=edit');
    }

    
    /**
     * Récupération d'une info en BDD
     *
     * @return void
     ******************************************************/
    public function editForm() {        
        $espece = $this->model->getEspece();
        $this->view->editForm($espece);
    }

    public function editFormEspeceCohabitable() {        
        $listeEspecesCohabitables = $this->model->getEspecesCohabitables();
        $this->view->editFormEspeceCohabitable($listeEspecesCohabitables);
    }



    
    /**
     * Moddification d'une info en BDD
     *
     * @return void
     ******************************************************/
    public function editDB() {
        include 'Config/config.php';
        
        $this->model->editDB();
        header('location:index.php?controller=' . $classEspece . '&action=edit');
    }

    public function editDBEspeceCohabitable() {
        include 'Config/config.php';
        
        $this->model->editDBEspeceCohabitable();
        header('location:index.php?controller=' . $classEspece . '&action=edit');
    }


}
