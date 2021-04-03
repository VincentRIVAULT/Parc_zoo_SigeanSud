<?php

// Définition de la classe SecuriteModel
// la mention "extends" signifie que la classe SecuriteModel
// hérite des propriétés et méthodes de sa classe mère "Model"
class SecuriteModel extends Model {

    /**
     * Récupération du identifiant et du mdp à partir de la base de données
     * pour que l'utilisateur puisse se connecter
     *
     * @return $profil
     ************************************************************************/
    public function testLogin() {

        // Appel du fichier config.php où sont déclarées
        // les classes et les tables de données correspondantes
        include 'Config/config.php';

        $identifiant = $_POST['identifiant'];
        $mdp = $_POST['mdp'];

        $requete = $this->connexion->prepare("SELECT *
        FROM $tableProfil	
	    WHERE identifiant = :identifiant");
        $requete->bindParam(':identifiant', $identifiant);
        $resultat = $requete->execute();
        $profil = $requete->fetch(PDO::FETCH_ASSOC);

        // var_dump($_POST);
        // var_dump($requete);
        // var_dump($profil);
        // var_dump($requete->errorInfo());

        if (password_verify($mdp, $profil['mdp'])) {
            // si l'utilisateur est connecté
            // alors on démarre ou reprend sa session
            $_SESSION['profil'] = $profil;
        }
        else {
            header('location:index.php?controller=' . $classSecurite . '&action=formLogin');
        }
        // var_dump($profil);
        return $profil;
        
    }

    /**
     * Déconnexion de l'utilisateur
     *
     * @return void
     ************************************************************************/
    public function logout() {
        // fonction de destruction de la variable de session en cours
        unset($_SESSION['profil']);
    }
}
