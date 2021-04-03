<?php

// Appel du fichier config.php où sont déclarées
// les classes et les tables de données correspondantes
include 'Config/config.php';

// Appel des fichiers EnclosModel.php et EnclosView.php
include 'Model/' . $classEnclos . 'Model.php';
include 'View/' . $classEnclos . 'View.php';

// Définition de la classe EnclosController
// la classe EnclosController hérite des propriétés et méthodes
// de sa classe mère "Controller"
class EnclosController extends Controller {
    
    public function __construct() {
        include 'Config/config.php';
        
        // stockage des classes EnclosView et EnclosModel
        // dans les variables $classView et $classModel
        $classView = $classEnclos . 'View';
        $classModel = $classEnclos . 'Model';

        // instanciation des classes EnclosView et EnclosModel
        // à l'aide des variables $classView et $classModel
        $this->view = new $classView();
        $this->model = new $classModel();
    }


    /**
     * Affichage de la page Enclos
     *
     * @return void
     ******************************************************/
    public function display() {
        $listeEnclos = $this->model->getListeEnclos();
        $this->view->displayListeEnclos($listeEnclos);
    }


    /**
     * Affichage de la page d'un enclos
     *
     * @return void
     ******************************************************/
    public function displayEnclos() {
        $enclos = $this->model->getEnclos();
        $this->view->displayEnclos($enclos);
    }


    /**
     * Affichage de TOUS les objets par enclos
     *
     * @return void
     */
    public function displayListeObjetsPresents() {
        $enclos = $this->model->getEnclos();
        $listeObjetsPresents = $this->model->getListeObjetsPresents();
        $this->view->displayListeObjetsPresents($enclos, $listeObjetsPresents);
    }


    /**
     * Affichage de la liste des espèces vivant dans un enclos
     *
     * @return void
     */
    public function displayListeEspecesVivant() {
        $enclos = $this->model->getEnclos();
        $listeEspecesVivant = $this->model->getListeEspecesVivant();
        $this->view->displayListeEspecesVivant($enclos, $listeEspecesVivant);
    }


    /**
     * Affichage de la liste des animaux occupant un enclos
     *
     * @return void
     */
    public function displayListeAnimauxOccupant() {
        $enclos = $this->model->getEnclos();
        $listeAnimauxOccupant = $this->model->getListeAnimauxOccupant();
        $this->view->displayListeAnimauxOccupant($enclos, $listeAnimauxOccupant);
    }


    public function displayOccupation() {
        $listeAnimauxEnclos = $this->model->getListeAnimauxEnclos();
        $listeEnclos = $this->model->getListeEnclos();
        $listeAnimauxErrants = $this->model->getListeAnimauxErrants();
        $this->view->displayOccupation($listeAnimauxEnclos, $listeEnclos, $listeAnimauxErrants);
    }


    // public function displayOccupation() {
    //     $occupationEnclos = $this->model->getOccupationEnclos();
    //     $listeEnclos = $this->model->getListeEnclos();
    //     $this->view->displayOccupation($occupationEnclos, $listeEnclos);
    // }


    // public function displayOccupationEnclos() {
    //     $enclos = $this->model->getEnclos();
    //     $listeAnimauxEspeceNom = $this->model->getListeAnimauxEspeceNom();
    //     $this->view->displayOccupationEnclos($enclos, $listeAnimauxEspeceNom);
    // }
    

    /**
     * Construction de la page Enclos
     * (affichage de la page d'administration)
     * 
     * Liste des informations
     * @return void
     ******************************************************/
    public function edit() {
        $listeEnclos = $this->model->getListeEnclos();
        $this->view->editListeEnclos($listeEnclos);
    }


    /**
     * Edition de la page d'un enclos
     *
     * @return void
     ******************************************************/
    public function editEnclos() {
        $enclos = $this->model->getEnclos();
        $this->view->editEnclos($enclos);
    }


    /**
     * Edition de TOUS les objets par enclos
     *
     * @return void
     */
    public function editListeObjetsPresents() {
        $enclos = $this->model->getEnclos();
        $listeObjetsPresents = $this->model->getListeObjetsPresents();
        $this->view->editListeObjetsPresents($enclos, $listeObjetsPresents);
    }


    /**
     * Edition de la liste des espèces vivant dans un enclos
     *
     * @return void
     */
    public function editListeEspecesVivant() {
        $enclos = $this->model->getEnclos();
        $listeEspecesVivant = $this->model->getListeEspecesVivant();
        $this->view->editListeEspecesVivant($enclos, $listeEspecesVivant);
    }


    /**
     * Edition de la liste des animaux occupant un enclos
     *
     * @return void
     */
    public function editListeAnimauxOccupant() {
        $enclos = $this->model->getEnclos();
        $listeAnimauxOccupant = $this->model->getListeAnimauxOccupant();
        $this->view->editListeAnimauxOccupant($enclos, $listeAnimauxOccupant);
    }


    public function editOccupation() {
        $listeAnimauxEnclos = $this->model->getListeAnimauxEnclos();
        $listeEnclos = $this->model->getListeEnclos();
        $listeAnimauxErrants = $this->model->getListeAnimauxErrants();
        $this->view->editOccupation($listeAnimauxEnclos, $listeEnclos, $listeAnimauxErrants);
    }


    // public function editOccupation() {
    //     $occupationEnclos = $this->model->getOccupationEnclos();
    //     $listeEnclos = $this->model->getListeEnclos();
    //     $this->view->editOccupation($occupationEnclos, $listeEnclos);
    // }


    // public function editOccupationEnclos() {
    //     $enclos = $this->model->getEnclos();
    //     $listeAnimauxEspeceNom = $this->model->getListeAnimauxEspeceNom();
    //     $this->view->editOccupationEnclos($enclos, $listeAnimauxEspeceNom);
    // }

    
    /**
     * Ajout d'une info en base de données (BDD)
     *
     * @return void
     ******************************************************/
    public function addDB() {
        include 'Config/config.php';
        
        $this->model->addDB();
        header('location:index.php?controller=' . $classEnclos . '&action=edit');
    }


    public function addDBObjetsPresents() {
        include 'Config/config.php';
        
        $this->model->addDBObjetsPresents();
        header('location:index.php?controller=' . $classEnclos . '&action=edit');
    }


    public function addDBEspecesVivant() {
        include 'Config/config.php';
        
        $this->model->addDBEspecesVivant();
        header('location:index.php?controller=' . $classEnclos . '&action=edit');
    }


    public function addDBAnimauxOccupant() {
        include 'Config/config.php';
        
        $this->model->addDBAnimauxOccupant();
        header('location:index.php?controller=' . $classEnclos . '&action=edit');
    }

    
    /**
     * Gestion de l'affichage du formulaire d'ajout
     *
     * @return void
     ******************************************************/
    public function addForm() {
        $this->view->addForm();
    }


    public function addFormObjetsPresents() {
        $listeObjets = $this->model->getListeObjets();
    $this->view->addFormObjetsPresents($listeObjets);
    }


    public function addFormEspecesVivant() {
        // $listeEspecesVivant = $this->model->getListeEspecesVivant();
        $this->view->addFormEspecesVivant(/*$listeEspecesVivant*/);
    }

    public function addFormAnimauxOccupant() {
        // $listeAnimauxOccupant = $this->model->getListeAnimauxOccupant();
        $this->view->addFormAnimauxOccupant(/*$listeAnimauxOccupant*/);
    }

    
    /**
     * Suppression d'une info en BDD
     *
     * @return void
     ******************************************************/
    public function delDB() {
        include 'Config/config.php';
        
        $this->model->delDB();
        header('location:index.php?controller=' . $classEnclos . '&action=edit');
    }


    public function delDBObjetsPresents() {
        include 'Config/config.php';
        
        $this->model->delDBObjetsPresents();
        header('location:index.php?controller=' . $classEnclos . '&action=edit');
    }


    public function delDBEspecesVivant() {
        include 'Config/config.php';
        
        $this->model->delDBEspecesVivant();
        header('location:index.php?controller=' . $classEnclos . '&action=edit');
    }


    public function delDBAnimauxOccupant() {
        include 'Config/config.php';
        
        $this->model->delDBAnimauxOccupant();
        header('location:index.php?controller=' . $classEnclos . '&action=edit');
    }

    
    /**
     * Récupération d'une info en BDD
     *
     * @return void
     ******************************************************/
    public function editForm() {    
        $enclos = $this->model->getEnclos();
        $this->view->editForm($enclos);
    }

    
    public function editFormObjetsPresents() {
        $enclos = $this->model->getEnclos();
        $listeObjets = $this->model->getListeObjets();
        $this->view->editFormObjetsPresents($enclos, $listeObjets);
    }


    public function editFormEspecesVivant() {
        $enclos = $this->model->getEnclos();
        // $listeEspecesVivant = $this->model->getListeEspecesVivant();
        $this->view->editFormEspecesVivant($enclos/*, $listeEspecesVivant*/);
    }


    public function editFormAnimauxOccupant() {
        $enclos = $this->model->getEnclos();
        // $listeAnimauxOccupant = $this->model->getListeAnimauxOccupant();
        $this->view->editFormAnimauxOccupant($enclos/*, $listeAnimauxOccupant*/);
    }

    
    /**
     * Moddification d'une info en BDD
     *
     * @return void
     ******************************************************/
    public function editDB() {
        include 'Config/config.php';
        
        $this->model->editDB();
        header('location:index.php?controller=' . $classEnclos . '&action=edit');
    }


    public function editDBObjetsPresents() {
        include 'Config/config.php';
        
        $this->model->editDBObjetsPresents();
        header('location:index.php?controller=' . $classEnclos . '&action=edit');
    }


    public function editDBEspecesVivant() {
        include 'Config/config.php';
        
        $this->model->editDBEspecesVivant();
        header('location:index.php?controller=' . $classEnclos . '&action=edit');
    }


    public function editDBAnimauxOccupant() {
        include 'Config/config.php';
        
        $this->model->editDBAnimauxOccupant();
        header('location:index.php?controller=' . $classEnclos . '&action=edit');
    }

}
