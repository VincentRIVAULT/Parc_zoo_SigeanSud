<?php

// Définition de la classe mère "View"
abstract class View {

    protected $page;

    /**
     * Ajout de l'entête de la page
     ******************************************************/
    public function __construct() {
        // Appel du fichier config.php où sont déclarées
        // les classes et les tables de données correspondantes
        include 'Config/config.php';

        // récupération du fichier head.php
        $this->page = file_get_contents('View/template/head.php');
        // récupération du fichier nav.php
        $this->page .= file_get_contents('View/template/nav.php');
        
        // var_dump($_SESSION);

        // définition de la variable $logoSigeanSud pour l'affichage du titre de l'application
        // dans le bandeau d'en-tête (header)
        $logoSigeanSud = '<img src="bibliotheques/img/LogoSigeanSud.png" alt="Logo SigeanSud" width="100" height="" > Parc zoologique de SigeanSud';
        
        // Si l'utilisateur n'est pas connecté, il n'a accès qu'à la page d'accueil (page qui s'affiche par défaut)
                
        // si l'utilisateur n'est pas connecté, et qu'il clique sur un bouton du menu, on affiche la page de connexion
        if (!isset($_SESSION['profil'])) {
            $optionConnect = '<li>
                                <a href="index.php?controller=' . $classSecurite 
                                . '&action=formLogin" id="connect" title="Connexion">
                                <i class="fas fa-sign-in-alt"></i> connexion</a>
                            </li>';   
        } else {
            // Liste des actions renvoyant vers l'application côté consultation quand l'utilisateur est connecté
            $actionConsult = [
                'display', 
                'displayListEspecesCohabitables', 'displayAnimalParents','displayListRepas',
                'displayEnclos', 'displayListeObjetsPresents', 'displayListeEspecesVivant', 'displayListeAnimauxOccupant',
                'displayObjet', 'displayListeEnclosObjet',
                'displayEtatParc', 'displayListeAnimauxEspece', 
                'displayOccupation', 
                'displayGestionPersonnel', 'displayPersonnelSoignant', 'displayPersonnelEntretien', 
                'displayPlanningRepasJour'
            ];
            // Liste des actions renvoyant vers l'application côté mise à jour quand l'utilisateur est connecté
            $actionMaj = [
                'edit', 'addForm', 'editForm',
                'editListEspecesCohabitables', 'addFormEspeceCohabitable', 'editFormEspeceCohabitable',
                'editAnimalParents', 'addFormAnimalParent', 'editFormAnimalParent',
                'editListRepas', 'addFormListRepas', 'editFormListRepas',
                'editEnclos', 'editListeObjetsPresents', 'addFormObjetsPresents', 'editFormObjetsPresents',
                'editListeEspecesVivant', 'addFormEspecesVivant', 'editFormEspecesVivant',
                'editListeAnimauxOccupant', 'addFormAnimauxOccupant', 'editFormAnimauxOccupant',
                'editObjet', 'editListeEnclosObjet', 'addFormListeEnclosObjet', 'editFormListeEnclosObjet',
                'editListeProfilsSoignant', 'addFormProfilsSoignant', 'editFormProfilsSoignant', 
                'editListeProfilsEntretien', 'addFormProfilsEntretien', 'editFormProfilsEntretien',
                'editListeEspecesSoignant', 'addFormEspecesSoignant', 'editFormEspecesSoignant',
                'editListeEnclosEntretien', 'addFormEnclosEntretien', 'editFormEnclosEntretien',
                'editEtatParc', 'editListeAnimauxEspece', 
                'editOccupation', 
                'editGestionPersonnel', 'editPersonnelSoignant', 'editPersonnelEntretien',
                'editPlanningRepasJour'
            ];
            // si l'utilisateur est connecté et si l'action est égale à nulle,
            // on lui propose un retour vers l'interface de mise à jour
            if (!isset($_GET['action']) || in_array($_GET['action'], $actionConsult)) {
                $optionConnect = '';
                if ($_SESSION['profil']['role'] == 'entretien') {
                    $optionConnect .= '<li>
                                        <a href="index.php?controller=' . $classEnclos . '&action=edit" id="retourMAJ" title="Mise à jour">mise à jour</a>
                                    </li>';
                }
                if ($_SESSION['profil']['role'] == 'soignant') {
                    $optionConnect .= '<li>
                                        <a href="index.php?controller=' . $classAnimal . '&action=edit" id="retourMAJ" title="Mise à jour">mise à jour</a>
                                    </li>';
                }
                if ($_SESSION['profil']['role'] == 'administrateur') {
                    $optionConnect .= '<li>
                                        <a href="index.php?controller=' . $classEspece . '&action=edit" id="retourMAJ" title="Mise à jour">mise à jour</a>
                                    </li>';
                }
            } else {
                $optionConnect = '';
                // sinon on propose à l'utilisateur un retour vers le l'interface de consultation
                // $optionConnect = '<li>
                //                     <a href="index.php" id="retourConsultation" title="consultation">consultation</a>
                //                 </li>';
                if ($_SESSION['profil']['role'] == 'entretien') {
                    $optionConnect .= '<li>
                                        <a href="index.php?controller=' . $classEnclos . '&action=display" id="retourConsultation" title="consultation">consultation</a>
                                    </li>';
                }
                if ($_SESSION['profil']['role'] == 'soignant') {
                    $optionConnect .= '<li>
                                        <a href="index.php?controller=' . $classAnimal . '&action=display" id="retourConsultation" title="consultation">consultation</a>
                                    </li>';
                }
                if ($_SESSION['profil']['role'] == 'administrateur') {
                    $optionConnect .= '<li>
                                        <a href="index.php?controller=' . $classEspece . '&action=display" id="retourConsultation" title="consultation">consultation</a>
                                    </li>';
                }
            }
            $optionConnect .= '<li>
                                <a href="index.php?controller=' . $classSecurite . '&action=logout" id="deconnect" title="Déconnexion"><i class="fas fa-user-circle"></i> se deconnecter</a>
                            </li>';
        }
        // Côté mise à jour, si l'utilisateur est connecté, il peut accéder aux différentes pages suivantes
        // les pages sont définies par les variables $class et stockées dans les 4 variables listées ci-dessous
        if (isset($_SESSION['profil']) && isset($_GET['action']) && in_array($_GET['action'], $actionMaj)) {

            // variables dans lesquelles sont stockées les différentes pages selon le rôle de l'utilisateur
            $optionConsult = '';
            $optionMaj = '';
            $optionConsultParc = '';
            $optionMajParc = '';
            
            // Côté mise à jour, si l'utilisateur est connecté, 
            // il peut accéder et modifier les pages suivantes selon son rôle
            
            // si l'utilisateur est connecté en tant que personnel d'entretien, 
            // alors il peut accéder et modifier les pages suivantes : Enclos / Objet
            if ($_SESSION['profil']['role'] == 'entretien') {
                $optionMaj .=   '<li>
                                    <a href="index.php?controller=' . $classEnclos 
                                    . '&action=edit" id="encMenu" title="Page Enclos"><i class=""></i> Enclos</a>
                                </li>
                                <li>
                                    <a href="index.php?controller=' . $classObjet 
                                    . '&action=edit" id="objMenu" title="Page Objet"><i class=""></i> Objet</a>
                                </li>';
            }
            // si l'utilisateur est connecté en tant que soignant, 
            // alors il peut accéder et modifier les pages suivantes : Espece / Animal / Menus
            if ($_SESSION['profil']['role'] == 'soignant') {
                $optionMaj .=   '
                                <li>
                                    <a href="index.php?controller=' . $classEspece . '&action=edit" id="espMenu" title="Page Espèce"><i class=""></i> Espèce</a>
                                </li>
                                <li>
                                    <a href="index.php?controller=' . $classAnimal . '&action=edit" id="aniMenu" title="Page Animal"><i class=""></i> Animal</a>
                                </li>
                                <li>
                                    <a href="index.php?controller=' . $classMenus . '&action=edit" id="menMenu" title="Page Menus"><i class=""></i> Menus</a>
                                </li>';
                $optionMajParc .= '
                                <li>
                                    <a href="index.php?controller=' . $classMenus . '&action=editPlanningRepasJour" id="plaMenu" title="Page Planning des repas"><i class=""></i> Planning des repas</a>
                                </li>
                                ';
            }
            // si l'utilisateur est connecté en tant qu'administrateur, 
            // alors il peut accéder et modifier les pages suivantes : Espece / Animal / Menus / Enclos / Objet / Profil
            if ($_SESSION['profil']['role'] == 'administrateur') {
                $optionMaj .=   '
                                <li>
                                    <a href="index.php?controller=' . $classEspece . '&action=edit" id="espMenu" title="Page Espèce"><i class=""></i> Espèce</a>
                                </li>
                                <li>
                                    <a href="index.php?controller=' . $classAnimal . '&action=edit" id="aniMenu" title="Page Animal"><i class=""></i> Animal</a>
                                </li>
                                <li>
                                    <a href="index.php?controller=' . $classMenus . '&action=edit" id="menMenu" title="Page Menus"><i class=""></i> Menus</a>
                                </li>
                                <li>
                                    <a href="index.php?controller=' . $classEnclos . '&action=edit" id="encMenu" title="Page Enclos"><i class=""></i> Enclos</a>
                                </li>
                                <li>
                                    <a href="index.php?controller=' . $classObjet . '&action=edit" id="objMenu" title="Page Objet"><i class=""></i> Objet</a>
                                </li>
                                <li>
                                    <a href="index.php?controller=' . $classProfil . '&action=edit" id="proMenu" title="Page Profil"><i class=""></i> Profil</a>
                                    <ul id="sousMenuMajProfil">    
                                        <li>
                                            <a href="index.php?controller=' . $classProfil . '&action=editListeProfilsSoignant" title="Page Profil"><i class=""></i> Soignant</a>
                                        </li>
                                        <li>
                                            <a href="index.php?controller=' . $classProfil . '&action=editListeProfilsEntretien" title="Page Profil"><i class=""></i> Entretien</a>
                                        </li>
                                    </ul>
                                </li>';
                $optionMajParc .= '
                                <li>
                                    <a href="index.php?controller=' . $classAnimal . '&action=editEtatParc" id="popMenu" title="Page Population"><i class=""></i> Population</a>
                                </li>
                                <li>
                                    <a href="index.php?controller=' . $classEnclos . '&action=editOccupation" id="occMenu" title="Page Occupation"><i class=""></i> Occupation</a>
                                </li>
                                <li>
                                    <a href="index.php?controller=' . $classProfil . '&action=editGestionPersonnel" id="gesMenu" title="Page Gestion du personnel"><i class=""></i> Gestion du personnel</a>
                                </li>
                                <li>
                                    <a href="index.php?controller=' . $classMenus . '&action=editPlanningRepasJour" id="plaMenu" title="Page Planning des repas"><i class=""></i> Planning des repas</a>
                                </li>
                                ';
            }
        // Côté consultation, si l'utilisateur est authentifié, il peut accéder aux différentes pages suivantes selon son rôle
        // comme aucune condition liée à un rôle spécifique n'est définie, tous les utilisateurs authentifiés auront accès aux mêmes pages
        } else {
                $optionMaj = '';
                $optionMajParc = '';
                // affichage du menu principal de navigation
                $optionConsult =
                            '
                            <li>
                                <a href="index.php?controller=' . $classEspece . '&action=display" id="espMenu" title="Page Espèce"><i class=""></i> Espèce</a>
                            </li>
                            <li>
                                <a href="index.php?controller=' . $classAnimal . '&action=display" id="aniMenu" title="Page Animal"><i class=""></i> Animal</a>
                            </li>
                            <li>
                                <a href="index.php?controller=' . $classMenus . '&action=display" id="menMenu" title="Page Menus"><i class=""></i> Menus</a>
                            </li>
                            <li>
                                <a href="index.php?controller=' . $classEnclos . '&action=display" id="encMenu" title="Page Enclos"><i class=""></i> Enclos</a>
                            </li>
                            <li>
                                <a href="index.php?controller=' . $classObjet . '&action=display" id="objMenu" title="Page Objet"><i class=""></i> Objet</a>
                            </li>
                            ';
                // affichage du menu gestion du parc
                $optionConsultParc = '
                            <li>
                                <a href="index.php?controller=' . $classAnimal . '&action=displayEtatParc" id="popMenu" title="Page Population"><i class=""></i> Population</a>
                            </li>
                            <li>
                                <a href="index.php?controller=' . $classEnclos . '&action=displayOccupation" id="occMenu" title="Page Occupation"><i class=""></i> Occupation</a>
                            </li>
                            <li>
                                <a href="index.php?controller=' . $classProfil . '&action=displayGestionPersonnel" id="gesMenu" title="Page Gestion du personnel"><i class=""></i> Gestion du personnel</a>
                            </li>
                            <li>
                                <a href="index.php?controller=' . $classMenus . '&action=displayPlanningRepasJour" id="plaMenu" title="Page Planning des repas"><i class=""></i> Planning des repas</a>
                            </li>';
            
        }        

        // remplacement de l'item {} présent dans le fichier nav.php par sa valeur
        // pour qu'elle s'affiche dans le navigateur grâce à la fonction php "str_replace()"
        $this->page = str_replace('{logoSigeanSud}', $logoSigeanSud, $this->page);
        $this->page = str_replace('{optionConnect}', $optionConnect, $this->page);
        $this->page = str_replace('{optionConsult}', $optionConsult, $this->page);       
        $this->page = str_replace('{optionMaj}', $optionMaj, $this->page);
        $this->page = str_replace('{optionConsultParc}', $optionConsultParc, $this->page);
        $this->page = str_replace('{optionMajParc}', $optionMajParc, $this->page);
    }
    

    /**
     * Affichage de la page avec le pied de page
     *
     * @return void
     ******************************************************/
    protected function displayPage() {
        // récupération du fichier footer.php
        $this->page .= file_get_contents('View/template/footer.php');
        // affichage de la vue dans le navigateur
        echo $this->page;
    }
}
