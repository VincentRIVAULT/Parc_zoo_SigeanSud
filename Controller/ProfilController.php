<?php

// Appel du fichier config.php où sont déclarées
// les classes et les tables de données correspondantes
include 'Config/config.php';

// Appel des fichiers ProfilModel.php et ProfilView.php
include 'Model/' . $classProfil . 'Model.php';
include 'View/' . $classProfil . 'View.php';

// Définition de la classe ProfilController
// la classe ProfilController hérite des propriétés et méthodes
// de sa classe mère "Controller"
class ProfilController extends Controller {
    
    public function __construct() {
        include 'Config/config.php';
        
        $classView = $classProfil . 'View';
        $classModel = $classProfil . 'Model';

        // instanciation des classes ProfilView et ProfilModel
        $this->view = new $classView();
        $this->model = new $classModel();
    }


    /**
     * Affichage de la page Profil
     *
     * @return void
     ******************************************************/
    public function display() {
        $listeProfils = $this->model->getListeProfils();
        $this->view->displayListeProfils($listeProfils);
    }


    public function displayGestionPersonnel() {
        $repartitionPersonnel = $this->model->getRepartitionPersonnel();
        $this->view->displayGestionPersonnel($repartitionPersonnel);
    }

    
    public function displayPersonnelSoignant() {
        $repartitionEspecesSoignant = $this->model->getRepartitionEspecesSoignant();
        $this->view->displayPersonnelSoignant($repartitionEspecesSoignant);
    }

    
    public function displayPersonnelEntretien() {
        $repartitionEnclosEntretien = $this->model->getRepartitionEnclosEntretien();
        $this->view->displayPersonnelEntretien($repartitionEnclosEntretien);
    }


    /**
     * Construction de la page des profils
     * (affichage de la page d'administration)
     * 
     * Liste des profils
     * @return void
     ******************************************************/
    public function edit() {
        $listeProfils = $this->model->getListeProfils();
        $this->view->editListeProfils($listeProfils);
    }


    public function editListeProfilsSoignant() {
        $listeProfilsSoignant = $this->model->getListeProfilsSoignant();
        $this->view->editListeProfilsSoignant($listeProfilsSoignant);
    }


    public function editListeProfilsEntretien() {
        $listeProfilsEntretien = $this->model->getListeProfilsEntretien();
        $this->view->editListeProfilsEntretien($listeProfilsEntretien);
    }


    /**
     * Liste des espèces par personnel soignant
     *
     * @return void
     */
    public function editListeEspecesSoignant() {
        $profil = $this->model->getProfil();
        $listeEspecesSoignant = $this->model->getListeEspecesSoignant();
        $this->view->editListeEspecesSoignant($profil, $listeEspecesSoignant);
    }


    /**
     * Liste des enclos par personnel d'entretien
     *
     * @return void
     */
    public function editListeEnclosEntretien() {
        $profil = $this->model->getProfil();
        $listeEnclosEntretien = $this->model->getListeEnclosEntretien();
        $this->view->editListeEnclosEntretien($profil, $listeEnclosEntretien);
    }


    public function editGestionPersonnel() {
        $repartitionPersonnel = $this->model->getRepartitionPersonnel();
        $this->view->editGestionPersonnel($repartitionPersonnel);
    }

    
    public function editPersonnelSoignant() {
        $repartitionEspecesSoignant = $this->model->getRepartitionEspecesSoignant();
        $this->view->editPersonnelSoignant($repartitionEspecesSoignant);
    }

    
    public function editPersonnelEntretien() {
        $repartitionEnclosEntretien = $this->model->getRepartitionEnclosEntretien();
        $this->view->editPersonnelEntretien($repartitionEnclosEntretien);
    }

    
    /**
     * Ajout d'un profil en base de données (BDD)
     *
     * @return void
     ******************************************************/
    public function addDB() {
        include 'Config/config.php';
        
        $this->model->addDB();
        header('location:index.php?controller=' . $classProfil . '&action=edit');
    }


    public function addDBEspecesSoignant() {
        include 'Config/config.php';
        
        $this->model->addDBEspecesSoignant();
        header('location:index.php?controller=' . $classProfil . '&action=edit');
    }


    public function addDBEnclosEntretien() {
        include 'Config/config.php';
        
        $this->model->addDBEnclosEntretien();
        header('location:index.php?controller=' . $classProfil . '&action=edit');
    }

    
    /**
     * Gestion de l'affichage du formulaire d'ajout
     *
     * @return void
     ******************************************************/
    public function addForm() {
        $this->view->addForm();
    }


    public function addFormEspecesSoignant() {
        $this->view->addFormEspecesSoignant();
    }


    public function addFormEnclosEntretien() {
        $this->view->addFormEnclosEntretien();
    }

    
    /**
     * Suppression d'un profil en BDD
     *
     * @return void
     ******************************************************/
    public function delDB() {
        include 'Config/config.php';
        
        $this->model->delDB();
        header('location:index.php?controller=' . $classProfil . '&action=edit');
    }


    public function delDBEspecesSoignant() {
        include 'Config/config.php';
        
        $this->model->delDBEspecesSoignant();
        header('location:index.php?controller=' . $classProfil . '&action=edit');
    }


    public function delDBEnclosEntretien() {
        include 'Config/config.php';
        
        $this->model->delDBEnclosEntretien();
        header('location:index.php?controller=' . $classProfil . '&action=edit');
    }

    
    /**
     * Gestion de l'affichage du formulaire de mise à jour
     *
     * @return void
     ******************************************************/
    public function editForm() {
        $profil = $this->model->getProfil();
        $this->view->editForm($profil);
    }


    public function editFormEspecesSoignant() {
        $profil = $this->model->getProfil();
        $this->view->editFormEspecesSoignant($profil);
    }


    public function editFormEnclosEntretien() {
        $profil = $this->model->getProfil();
        $this->view->editFormEnclosEntretien($profil);
    }

    
    /**
     * Moddification d'un profil en BDD
     *
     * @return void
     ******************************************************/
    public function editDB() {
        include 'Config/config.php';
        
        $this->model->editDB();
        header('location:index.php?controller=' . $classProfil . '&action=edit');
    }


    public function editDBEspecesSoignant() {
        include 'Config/config.php';
        
        $this->model->editDBEspecesSoignant();
        header('location:index.php?controller=' . $classProfil . '&action=edit');
    }


    public function editDBEnclosEntretien() {
        include 'Config/config.php';
        
        $this->model->editDBEnclosEntretien();
        header('location:index.php?controller=' . $classProfil . '&action=edit');
    }

}