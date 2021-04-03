<?php

// Appel du fichier config.php où sont déclarées
// les classes et les tables de données correspondantes
include 'Config/config.php';

// Appel des fichiers PagesModel.php et PagesView.php
include 'Model/' . $classMenus . 'Model.php';
include 'View/' . $classMenus . 'View.php';

// Définition de la classe MenusController
// la classe PagesController hérite des propriétés et méthodes
// de sa classe mère "Controller"
class MenusController extends Controller {
    
    public function __construct() {
        include 'Config/config.php';
        
        // stockage des classes MenusView et MenusModel
        // dans les variables $classView et $classModel
        $classView = $classMenus . 'View';
        $classModel = $classMenus . 'Model';

        // instanciation des classes MenusView et MenusModel
        // à l'aide des variables $classView et $classModel
        $this->view = new $classView();
        $this->model = new $classModel();
    }


    /**
     * Affichage de la page Menus côté consultation
     *
     * @return void
     ******************************************************/
    public function display() {
        $listeMenus = $this->model->getMenus();
        $this->view->displayListMenus($listeMenus);
    }

    public function displayListRepas() {
        $menu = $this->model->getMenu();
        $listeRepas = $this->model->getListRepas();
        $this->view->displayListRepas($menu, $listeRepas);
    }

    public function displayPlanningRepasJour() {
        $listeRepasJour = $this->model->getRepasJour();
        $this->view->displayPlanningRepasJour($listeRepasJour);
    }
    

    /**
     * Construction de la page Menus
     * (affichage de la page de mise à jour)
     * 
     * Liste des informations
     * @return void
     ******************************************************/
    public function edit() {
        $listeMenus = $this->model->getMenus();
        $this->view->editListMenus($listeMenus);
    }

    public function editListRepas() {
        $menu = $this->model->getMenu();
        $listeRepas = $this->model->getListRepas();
        $this->view->editListRepas($menu, $listeRepas);
    }

    public function editPlanningRepasJour() {
        $listeRepasJour = $this->model->getRepasJour();
        $this->view->editPlanningRepasJour($listeRepasJour);
    }

    
    /**
     * Ajout d'une info en base de données (BDD)
     *
     * @return void
     ******************************************************/
    public function addDB() {
        include 'Config/config.php';
        
        $this->model->addDB();
        header('location:index.php?controller=' . $classMenus . '&action=edit');
    }

    public function addDBRepas() {
        include 'Config/config.php';
        
        $this->model->addDBRepas();
        header('location:index.php?controller=' . $classMenus . '&action=edit');
    }

    
    /**
     * Gestion de l'affichage du formulaire d'ajout
     *
     * @return void
     ******************************************************/
    public function addForm() {
        $this->view->addForm();
    }

    public function addFormListRepas() {
        $this->view->addFormListRepas();
    }

    
    /**
     * Suppression d'une info en BDD
     *
     * @return void
     ******************************************************/
    public function delDB() {
        include 'Config/config.php';
        
        $this->model->delDB();
        header('location:index.php?controller=' . $classMenus . '&action=edit');
    }

    public function delDBRepas() {
        include 'Config/config.php';
        
        $this->model->delDBRepas();
        header('location:index.php?controller=' . $classMenus . '&action=edit');
    }

    
    /**
     * Récupération d'une info en BDD
     *
     * @return void
     ******************************************************/
    public function editForm() {        
        $menu = $this->model->getMenu();
        $this->view->editForm($menu);
    }

    public function editFormListRepas() {        
        $repas = $this->model->getRepas();
        $listeRepas = $this->model->getListRepas();
        $this->view->editFormListRepas($repas, $listeRepas);
    }

    
    /**
     * Moddification d'une info en BDD
     *
     * @return void
     ******************************************************/
    public function editDB() {
        include 'Config/config.php';
        
        $this->model->editDB();
        header('location:index.php?controller=' . $classMenus . '&action=edit');
    }

    public function editDBRepas() {
        include 'Config/config.php';
        
        $this->model->editDBRepas();
        header('location:index.php?controller=' . $classMenus . '&action=edit');
    }
}