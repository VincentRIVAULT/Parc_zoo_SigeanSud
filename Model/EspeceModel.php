<?php
//#####################################################################################################
// Lors de la définition du nom de la classe, assurez-vous d'avoir mis le même nom de table dans la BDD
//#####################################################################################################


// Définition de la classe EspeceModel
// la mention "extends" signifie que la classe EspeceModel
// hérite des propriétés et méthodes de sa classe mère "Model"
class EspeceModel extends Model {


    /**
     * Récupération d'une donnée de la base de données (BDD)
     *
     * @return $espece
     ******************************************************/
    public function getEspece() {
        // Appel du fichier config.php où sont déclarées
        // les classes et les tables de données correspondantes
        include 'Config/config.php';
        
        // requête SQL pour récupérer les données de la page demandée grâce à son identifiant
        // les données récupérées sont stockées dans la variable $espece
        $codESP = $_GET['id'];
        $requete = $this->connexion->prepare("SELECT * FROM $tableEspece WHERE code_espece = :codESP");
        $requete->bindParam(':codESP', $codESP);
        $resultat = $requete->execute();
        $espece = $requete->fetch(PDO::FETCH_ASSOC);
        
        // var_dump($_GET);
        // var_dump($resultat);
        // var_dump($requete->errorInfo());
        // var_dump($espece);

        return $espece;
    }
    
    
    /**
     * Récupération de l'ensemble des données de la BDD
     *
     * @return $listeEspeces
     ******************************************************/
    public function getEspeces() {
        include 'Config/config.php';
        
        $requete = "SELECT * FROM $tableEspece ORDER BY nom_espece";
        $resultat = $this->connexion->query($requete);
        $listeEspeces = $resultat->fetchAll(PDO::FETCH_ASSOC);

        // var_dump($listeEspeces);

        return $listeEspeces;
    }

    
    /**
     * Récupération des espèces cohabitables pour un id donnée
     *
     * @return $listeEspeceCohabitable
     ******************************************************/
    public function getEspeceCohabitable() {
        include 'Config/config.php';
        $codESP = $_GET['id'];
        $requete = "SELECT * FROM $tableCohabiter 
        INNER JOIN $tableEspece ON $tableCohabiter.code_espece_1 = $tableEspece.code_espece
        WHERE $tableCohabiter.code_espece = $codESP";
        $resultat = $this->connexion->query($requete);
        $listeEspeceCohabitable = $resultat->fetchAll(PDO::FETCH_ASSOC);

       // var_dump($_GET['id']);
       // var_dump($requete);
       // var_dump($resultat);
       // var_dump($listeEspeceCohabitable);

        return $listeEspeceCohabitable;
    }

    public function getEspecesCohabitables() {
        include 'Config/config.php';
        
        $requete = "SELECT * FROM $tableCohabiter
        INNER JOIN $tableEspece ON $tableCohabiter.code_espece_1 = $tableEspece.code_espece ORDER BY nom_espece";
        $resultat = $this->connexion->query($requete);
        $listeEspecesCohabitables = $resultat->fetchAll(PDO::FETCH_ASSOC);

        // var_dump($listeEspecesCohabitables);

        return $listeEspecesCohabitables;
    }

    /**
     * Ajout dans la BDD
     *
     * @return void
     ******************************************************/
    public function addDB() {
        include 'Config/config.php';
        
        $nomESP = $_POST['nomESP'];

        // var_dump($_POST);

        $requete = $this->connexion->prepare("INSERT INTO $tableEspece
            VALUES (NULL, :nomESP)");
        $requete->bindParam(':nomESP', $nomESP);
        $resultat = $requete->execute();

        // var_dump($resultat);
        // var_dump($requete->errorInfo());
    }

    public function addDBEspeceCohabitable() {
        include 'Config/config.php';
        
        $codESP = $_POST['codESP'];
        $codESP1 = $_POST['codESP1'];

        // var_dump($_POST);

        $requete = $this->connexion->prepare("INSERT INTO $tableCohabiter
            VALUES (:codESP, :codESP1), (:codESP1, :codESP)");
        $requete->bindParam(':codESP1', $codESP1);
        $requete->bindParam(':codESP', $codESP);
        $resultat = $requete->execute();

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
        
        $codESP = $_GET['id'];

        // var_dump($_GET);

        $requete = $this->connexion->prepare("DELETE FROM $tableEspece WHERE code_espece = :codESP");
        $requete->bindParam(':codESP', $codESP);
        $resultat = $requete->execute();

        // var_dump($resultat);
        // var_dump($requete->errorInfo()); 

    }

    public function delDBEspeceCohabitable() {
        include 'Config/config.php';
        
        $codESP1 = $_GET['id'];

        // var_dump($_GET);

        $requete = $this->connexion->prepare("DELETE FROM $tableCohabiter WHERE $tableCohabiter.code_espece_1 = :codESP1");
        // DELETE FROM `cohabiter` WHERE `cohabiter`.`code_espece` = 1 AND `cohabiter`.`code_espece_1` = 5 
        $requete->bindParam(':codESP1', $codESP1);
        $resultat = $requete->execute();


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
        
        $codESP = $_POST['codESP'];
        $nomESP = $_POST['nomESP'];

        // var_dump($_POST);

        $requete = $this->connexion->prepare("UPDATE $tableEspece 
            SET nom_espece = :nomESP
            WHERE code_espece = :codESP");
        $requete->bindParam(':codESP', $codESP);
        $requete->bindParam(':nomESP', $nomESP);
        $resultat = $requete->execute();

        // var_dump($resultat);
        // var_dump($requete->errorInfo());
    }
}