<?php
//#####################################################################################################
// Lors de la définition du nom de la classe, assurez-vous d'avoir mis le même nom de table dans la BDD
//#####################################################################################################


// Définition de la classe ObjetModel
// la mention "extends" signifie que la classe ObjetModel
// hérite des propriétés et méthodes de sa classe mère "Model"
class ObjetModel extends Model {


    /**
     * Récupération d'une donnée de la base de données (BDD)
     *
     * @return $objet
     ******************************************************/   
    public function getObjet() {
        // Appel du fichier config.php où sont déclarées
        // les classes et les tables de données correspondantes
        include 'Config/config.php';
        
        // requête SQL pour récupérer les données de la page demandée grâce à son identifiant
        // les données récupérées sont stockées dans la variable $item
        $codOBJ = $_GET['id'];

        $requete = $this->connexion->prepare("SELECT $tableObjet.code_objet, nom_objet, 
        IF ((SELECT COUNT(*) FROM $tableObjet_achete WHERE $tableObjet_achete.code_objet = $tableObjet.code_objet) = 0, '', 'A') AS achete,
        IF ((SELECT COUNT(*) FROM $tableObjet_prete WHERE $tableObjet_prete.code_objet = $tableObjet.code_objet) = 0, '', 'P') AS prete
        FROM $tableObjet
        WHERE $tableObjet.code_objet = $codOBJ");
        $resultat = $requete->execute();
        $objet = $requete->fetch(PDO::FETCH_ASSOC);
        
        // var_dump($_GET);
        // var_dump($requete);
        // var_dump($resultat);
        // var_dump($requete->errorInfo());
        // var_dump($objet);
        
        return $objet;        
    }
    
    
    /**
     * Récupération de la liste des objets
     *
     * @return $listeObjets
     */
    public function getListeObjets() {
        include 'Config/config.php';
        
        $requete = "SELECT $tableObjet.code_objet, nom_objet,
        IF ((SELECT COUNT(*) FROM $tableObjet_achete WHERE $tableObjet_achete.code_objet = $tableObjet.code_objet) = 0, '', 'A') AS achete,
        IF ((SELECT COUNT(*) FROM $tableObjet_prete WHERE $tableObjet_prete.code_objet = $tableObjet.code_objet) = 0, '', 'P') AS prete
        FROM $tableObjet
        ORDER BY nom_objet";
        $resultat = $this->connexion->query($requete);
        $listeObjets = $resultat->fetchAll(PDO::FETCH_ASSOC);

        // var_dump($requete);
        // var_dump($resultat);
        // var_dump($listeObjets);

        return $listeObjets;
    }
    
    
    /**
     * Liste des enclos où se situe un objet
     *
     * @return $listeEnclosObjet
     */
    public function getListeEnclosObjet() {
        include 'Config/config.php';
        
        $codOBJ = $_GET['id'];

        $requete = "SELECT nom_objet, 
        $tableObjet_achete.code_objet AS achete, $tableObjet_prete.code_objet AS prete, qte_objet, nom_enclos
        FROM $tableObjet
        LEFT JOIN $tableObjet_achete ON $tableObjet_achete.code_objet = $tableObjet.code_objet
        LEFT JOIN $tableObjet_prete ON $tableObjet_prete.code_objet = $tableObjet.code_objet
        INNER JOIN $tablePresent ON $tablePresent.code_objet = $tableObjet.code_objet
        INNER JOIN $tableEnclos ON $tableEnclos.code_enclos = $tablePresent.code_enclos
        WHERE $tableObjet.code_objet = $codOBJ
        ORDER BY nom_enclos";

        $resultat = $this->connexion->query($requete);
        $listeEnclosObjet = $resultat->fetchAll(PDO::FETCH_ASSOC);

        // var_dump($requete);
        // var_dump($requete->errorInfo());
        // var_dump($resultat);
        // var_dump($listeEnclosObjet);

        return $listeEnclosObjet;
    }


    /*
    public function getListeEnclosObjet() {
        include 'Config/config.php';
        
        $codOBJ = $_GET['id'];

        $requete = "SELECT $tablePresent.code_objet, 
        IF ((SELECT COUNT(*) FROM $tableObjet_achete WHERE $tableObjet_achete.code_objet $tablePresent.code_objet) = 0, '', qte_objet) AS achete,
        IF ((SELECT COUNT(*) FROM $tableObjet_prete WHERE $tableObjet_prete.code_objet $tablePresent.code_objet) = 0, '', qte_objet) AS prete
        FROM $tablePresent
        WHERE $tablePresent.code_objet = $codOBJ";

        $resultat = $this->connexion->query($requete);
        $listeEnclosObjet = $resultat->fetchAll(PDO::FETCH_ASSOC);

        var_dump($requete);
        var_dump($requete->errorInfo());
        var_dump($resultat);
        var_dump($listeEnclosObjet);

        return $listeEnclosObjet;
    }*/


    /**
     * Ajout dans la BDD
     *
     * @return void
     ******************************************************/
    public function addDB() {
        include 'Config/config.php';
        
        $nomOBJ = $_POST['nomOBJ'];
        // soit $achepre la variable représentant la valeur de l'objet (achete ou prete)
        $achpre = $_POST['OBJ'];
		// var_dump($achpre);
        
        $requete = $this->connexion->prepare("INSERT INTO $tableObjet
        VALUES (NULL, :nomOBJ)");
        $requete->bindParam(':nomOBJ', $nomOBJ);
        $resultat = $requete->execute();

        // on récupère le dernier code_objet renommé "codobj" (code objet ayant la valeur maximale)
        // dans la table objet à l'aide de la fonction MAX 
        $requete = $this->connexion->prepare("SELECT MAX(code_objet) AS codobj FROM $tableObjet");
        $resultat = $requete->execute();
		$objet = $requete->fetch(PDO::FETCH_ASSOC);

        // on stocke ce code objet "codobj" dans la variable $codobj
		$codobj=$objet['codobj']; 
	    
        // puis on teste la variable contenant la valeur de l'objet
        // si la valeur de l'objet correspond à un A, alors on insère cette valeur dans la table objet acheté
        // en indiquant que la valeur du code objet acheté va prendre celle de la variable $codobj
		if ($achpre == 'A') {
            $requete = $this->connexion->prepare("INSERT INTO $tableObjet_achete
            VALUES (:achOBJ)");
            $requete->bindParam(':achOBJ', $codobj);
            $resultat = $requete->execute();
        // si la variable $achpre n'est pas égale à A, alors c'est qu'elle est égale à P
        // on procéède de la même manière pour mettre à jour la table de l'objet prêté
	    } else {
            $requete = $this->connexion->prepare("INSERT INTO $tableObjet_prete
            VALUES (:preOBJ)");
            $requete->bindParam(':preOBJ', $codobj);
            $resultat = $requete->execute();
        }

        // var_dump($_POST);
        // var_dump($requete);
        // var_dump($resultat);
        // var_dump($requete->errorInfo());

    }


    public function addDBListeEnclosObjet() {
        include 'Config/config.php';
        
        $codENC = $_POST['codENC'];
        $codOBJ = $_POST['codOBJ'];
        $qteOBJ = $_POST['qteOBJ'];

        $requete = $this->connexion->prepare("INSERT INTO $tablePresent

            VALUES (:codENC, :codOBJ, :qteOBJ)");
        
        $requete->bindParam(':codENC', $codENC);
        $requete->bindParam(':codOBJ', $codOBJ);
        $requete->bindParam(':qteOBJ', $qteOBJ);
        $resultat = $requete->execute();

        // var_dump($_POST);
        // var_dump($requete);
        // var_dump($resultat);
        // var_dump($requete->errorInfo());

    }
    

    /**
     * Suppression dans la BDD
     *
     * @return void
     ******************************************************/
    public function delDB() {
        include 'Config/config.php';
        
        $codOBJ = $_GET['id'];

        // suppression du code_objet_achete
        $requete = $this->connexion->prepare("DELETE FROM $tableObjet_achete WHERE $tableObjet_achete.code_objet = :codOBJ");
        $requete->bindParam(':codOBJ', $codOBJ);
        $resultat = $requete->execute();
		
        // suppression du code_objet_prete
      	$requete = $this->connexion->prepare("DELETE FROM $tableObjet_prete WHERE $tableObjet_prete.code_objet = :codOBJ");
        $requete->bindParam(':codOBJ', $codOBJ);
        $resultat = $requete->execute();

        // pour pouvoir supprimer le code_objet de la table objet
        $requete = $this->connexion->prepare("DELETE FROM $tableObjet WHERE $tableObjet.code_objet = :codOBJ");
        $requete->bindParam(':codOBJ', $codOBJ);
        $resultat = $requete->execute();

        // var_dump($_GET);
        // var_dump($resultat);
        // var_dump($requete->errorInfo()); 

    }


    public function delDBListeEnclosObjet() {
        include 'Config/config.php';
        
        $codOBJ = $_GET['id'];

        $requete = $this->connexion->prepare("DELETE FROM $tablePresent 
        WHERE $tableObjet.code_objet = :codOBJ");
        $requete->bindParam(':codOBJ', $codOBJ);
        $resultat = $requete->execute();

        // var_dump($_GET);
        // var_dump($resultat);
        // var_dump($requete->errorInfo()); 

    }


    /**
     * Modification de l'élément dans la BDD
     *
     * @return void
     ******************************************************/
    public function editDB() {
        include 'Config/config.php';
        
        $codOBJ = $_POST['codOBJ'];
        $nomOBJ = $_POST['nomOBJ'];
        $achpre = $_POST['OBJ'];

        // MAJ de la table objet (modification du nom de l'objet)
        $requete = $this->connexion->prepare("UPDATE $tableObjet
            SET nom_objet = :nomOBJ
            WHERE code_objet = :codOBJ");
        $requete->bindParam(':codOBJ', $codOBJ);
        $requete->bindParam(':nomOBJ', $nomOBJ);
        $resultat = $requete->execute();

        // suppression du code_objet_achete
        $requete = $this->connexion->prepare("DELETE FROM $tableObjet_achete WHERE $tableObjet_achete.code_objet = :codOBJ");
        $requete->bindParam(':codOBJ', $codOBJ);
        $resultat = $requete->execute();
		
        // suppression du code_objet_prete
      	$requete = $this->connexion->prepare("DELETE FROM $tableObjet_prete WHERE $tableObjet_prete.code_objet = :codOBJ");
        $requete->bindParam(':codOBJ', $codOBJ);
        $resultat = $requete->execute();
       
        // insertion du nouveau paramètre acheté / prêté
	    if ($achpre == 'A') {
            $requete = $this->connexion->prepare("INSERT INTO $tableObjet_achete
            VALUES (:achOBJ)");
            $requete->bindParam(':achOBJ', $codOBJ);
            $resultat = $requete->execute();
	    } else {
            $requete = $this->connexion->prepare("INSERT INTO $tableObjet_prete
            VALUES (:preOBJ)");
            $requete->bindParam(':preOBJ', $codOBJ);
            $resultat = $requete->execute();
        }

        // var_dump($_POST);
        // var_dump($requete);
        // var_dump($resultat);
        // var_dump($requete->errorInfo());

    }


    public function editDBListeEnclosObjet() {
        include 'Config/config.php';
        
        $codENC = $_POST['codENC'];
        $codOBJ = $_POST['codOBJ'];
        $qteOBJ = $_POST['qteOBJ'];

        $requete = $this->connexion->prepare("UPDATE $tablePresent
            
        SET code_enclos = :codENC, qte_objet = :qteOBJ
        WHERE code_objet = :codOBJ");
        
        $requete->bindParam(':codENC', $codENC);
        $requete->bindParam(':codOBJ', $codOBJ);
        $requete->bindParam(':qteOBJ', $qteOBJ);
        $resultat = $requete->execute();

        // var_dump($_POST);
        // var_dump($requete);
        // var_dump($resultat);
        // var_dump($requete->errorInfo());

    }

}
