<?php

// fonctions PHP pour identifier les erreurs
// lorsque l'on met l'application en ligne sur un serveur distant
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

// crée une session ou restaure celle trouvée sur le serveur,
// via l'identifiant de session passé dans une requête GET, POST ou par un cookie
session_start();

// conversion date au format français
setlocale(LC_TIME, "fr_FR");

// Appel du fichier config.php où sont déclarées
// les classes et les tables de données correspondantes
include 'Config/config.php';

// Appel des différents modules du MVC
include 'Model/Model.php';
include 'View/View.php';
include 'Controller/Controller.php';

// Appel des différents contrôleurs
include 'Controller/' . $classProfil . 'Controller.php'; // classe Profil
include 'Controller/' . $classSecurite . 'Controller.php'; // classe Securite
include 'Controller/' . $classAccueil . 'Controller.php'; // classe Accueil
include 'Controller/' . $classEspece . 'Controller.php'; // classe Espece
include 'Controller/' . $classAnimal . 'Controller.php'; // classe Animal
include 'Controller/' . $classMenus . 'Controller.php'; // classe Menus
include 'Controller/' . $classEnclos . 'Controller.php'; // classe Enclos
include 'Controller/' . $classObjet . 'Controller.php'; // classe Objet
// include 'Controller/' . $classN . 'Controller.php'; // On inclut la Nième classe ici


/**
 * Cette fonction permet d'extraire le contrôleur et l'action à lancer
 * à partir des informations reçues via l'URL et en tenant comptes des 
 * restrictions selon l'authentification de l'utilisateur
 *
 * @return array tableau contenant le contrôleur et l'action 
 *********************************************************************/
function extractParameters() {
    include 'Config/config.php';
    // Liste des contrôleurs accessibles par un utilisateur non authentifié
    $controllerNotAuth = [
        '' . $classSecurite . 'Controller',
        '' . $classAccueil . 'Controller'
    ];

    // Liste des contrôleurs réservés à l'utilisateur authentifié
    $controllerAuth = [
        '' . $classProfil . 'Controller',
        '' . $classEspece . 'Controller',
        '' . $classAnimal . 'Controller',
        '' . $classMenus . 'Controller',
        '' . $classEnclos . 'Controller',
        '' . $classObjet . 'Controller'
    ];
    
    // Liste des actions accessibles par un utilisateur non authentifié
    $actionNotAuth = ['displayAccueil', 'login'];
    
    // Liste des actions réservées à l'utilisateur authentifié
    // les droits d'accès des utilisateurs sont définis dans le fichier View.php
    $actionAuth = [];

    // récupération des données de l'URL : récupération du controller
    if (isset($_GET['controller'])) {
        $controller = ucfirst($_GET['controller']) . "Controller";
    } else {
        // si l'URL est vide, c'est le contrôleur ci-dessous qui est appelé
        $controller = '' . $classAccueil . 'Controller';
    }

    // récupération des données de l'URL : récupération de l'action
    if (isset($_GET['action'])) {
        $action = $_GET['action'];
    } else {
        // si aucune action n'est précisée dans l'URL,
        // c'est l'action ci-dessous qui s'effectue
        $action = 'displayAccueil';
    }

    // validation des accès aux pages de l'application si l'utilisateur n'est pas authentifié
    if (!isset($_SESSION['profil'])) {
        // si l'utilisateur n'est pas connecté, il a seulement accès aux contrôleurs et actions
        // listés dans les variables $controllerNotAuth et $actionNotAuth
        if (!in_array($controller, $controllerNotAuth) || !in_array($action, $actionNotAuth)) {
            // sinon, il est renvoyé vers la page de connexion pour s'authentifier
            $controller = '' . $classSecurite . 'Controller';
            $action = "formLogin";
        }
    } 

    return (['controller' => $controller, 'action' => $action]);
}

// récupération des valeurs du Contrôleur et de l'action
$paramGet = extractParameters();
$controller = $paramGet['controller'];
$action = $paramGet['action'];

// instanciation de la classe Contrôleur
$controller = new $controller();

// $action définit la valeur contenue dans la méthode "$action()"
$controller->$action();

