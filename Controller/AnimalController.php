<?php

// Appel du fichier config.php où sont déclarées
// les classes et les tables de données correspondantes
include 'Config/config.php';


// Appel des fichiers PagesModel.php et PagesView.php
include 'Model/' . $classAnimal . 'Model.php';
include 'View/' . $classAnimal . 'View.php';

// Définition de la classe AnimalController
// la classe PagesController hérite des propriétés et méthodes
// de sa classe mère "Controller"
class AnimalController extends Controller {
    
    public function __construct() {
        include 'Config/config.php';
        
        // stockage des classes AnimalView et AnimalModel
        // dans les variables $classView et $classModel
        $classView = $classAnimal . 'View';
        $classModel = $classAnimal . 'Model';

        // instanciation des classes AnimalView et AnimalModel
        // à l'aide des variables $classView et $classModel
        $this->view = new $classView();
        $this->model = new $classModel();
    }


    /**
     * Affichage de la page Animal côté consultation
     *
     * @return void
     ******************************************************/
    public function display() {
        $listeAnimaux = $this->model->getAnimaux();
        $this->view->displayListAnimaux($listeAnimaux);
    }

    public function displayAnimalParents() {
        $animal = $this->model->getAnimal();
        $animalParents = $this->model->getAnimalParents();
        $this->view->displayAnimalParents($animal, $animalParents);
    }


    public function displayEtatParc() {
        $listeAnimauxParc = $this->model->getAnimauxParc();
        $listeAnimauxEspecesParc = $this->model->getAnimauxEspecesParc();
        $this->view->displayEtatParc($listeAnimauxParc, $listeAnimauxEspecesParc);
    }


    public function displayListeAnimauxEspece() {
        $listeAnimalEspeceParc = $this->model->getAnimalEspeceParc();
        $this->view->displayListeAnimauxEspece($listeAnimalEspeceParc);
    }    
    

    /**
     * Construction de la page Animal
     * (affichage de la page de mise à jour)
     * 
     * Liste des animaux
     * @return void
     ******************************************************/
    public function edit() {
        $listeAnimaux = $this->model->getAnimaux();
        $this->view->editListAnimaux($listeAnimaux);
    }

   public function editAnimalParents() {
        $animal = $this->model->getAnimal();
        $animalParents = $this->model->getAnimalParents();
        $this->view->editAnimalParents($animal, $animalParents);
    }


    public function editEtatParc() {
        $listeAnimauxParc = $this->model->getAnimauxParc();
        $listeAnimauxEspecesParc = $this->model->getAnimauxEspecesParc();
        $this->view->editEtatParc($listeAnimauxParc, $listeAnimauxEspecesParc);
    }


    public function editListeAnimauxEspece() {
        $listeAnimalEspeceParc = $this->model->getAnimalEspeceParc();
        $this->view->editListeAnimauxEspece($listeAnimalEspeceParc);
    }

    
    /**
     * Ajout d'une info en base de données (BDD)
     *
     * @return void
     ******************************************************/
    public function addDB() {
        include 'Config/config.php';
        
        $this->model->addDB();
        header('location:index.php?controller=' . $classAnimal . '&action=edit');
    }

    public function addDBAnimalParent() {
        include 'Config/config.php';
        
        $this->model->addDBAnimalParent();
        header('location:index.php?controller=' . $classAnimal . '&action=edit');
    }

    
    /**
     * Gestion de l'affichage du formulaire d'ajout
     *
     * @return void
     ******************************************************/
    public function addForm() {
        $listeEspeces = $this->model->getListEspeces();
    $this->view->addForm(/*$listeEspeces*/);

    }

    public function addFormAnimalParent() {
        $this->view->addFormAnimalParent();
    }

    
    /**
     * Suppression d'une info en BDD
     *
     * @return void
     ******************************************************/
    public function delDB() {
        include 'Config/config.php';
        
        $this->model->delDB();
        header('location:index.php?controller=' . $classAnimal . '&action=edit');
    }

    
    /**
     * Récupération d'une info en BDD
     *
     * @return void
     ******************************************************/
    public function editForm() {     
        $animal = $this->model->getAnimal();
        $listeEspeces = $this->model->getListEspeces();
        $this->view->editForm($animal, $listeEspeces);
    }

    public function editFormAnimalParent() {       
        $animalParents = $this->model->getAnimalParents();
        $this->view->editFormAnimalParent($animalParents);
    }

    
    /**
     * Moddification d'une info en BDD
     *
     * @return void
     ******************************************************/
    public function editDB() {
        include 'Config/config.php';
        
        $this->model->editDB();
        header('location:index.php?controller=' . $classAnimal . '&action=edit');
    }

}
