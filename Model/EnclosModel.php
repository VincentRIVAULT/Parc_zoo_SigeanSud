<?php
//#####################################################################################################
// Lors de la définition du nom de la classe, assurez-vous d'avoir mis le même nom de table dans la BDD
//#####################################################################################################


// Définition de la classe EnclosModel
// la mention "extends" signifie que la classe EnclosModel
// hérite des propriétés et méthodes de sa classe mère "Model"
class EnclosModel extends Model {


    /**
     * Récupération d'une donnée de la base de données (BDD)
     *
     * @return $item
     ******************************************************/
    public function getEnclos() {
        // Appel du fichier config.php où sont déclarées
        // les classes et les tables de données correspondantes
        include 'Config/config.php';
        
        // requête SQL pour récupérer les données de la page demandée grâce à son identifiant
        // les données récupérées sont stockées dans la variable $item
        $codENC = $_GET['id'];

        $requete = $this->connexion->prepare("SELECT code_enclos, nom_enclos, superficie_enclos 
        FROM $tableEnclos 
        WHERE $tableEnclos.code_enclos = :codENC");
        $requete->bindParam(':codENC', $codENC);
        $resultat = $requete->execute();
        $enclos = $requete->fetch(PDO::FETCH_ASSOC);
        
        // var_dump($_GET);
        // var_dump($resultat);
        // var_dump($requete->errorInfo());
        // var_dump($enclos);

        return $enclos;
    }


    /**
     * Récupération de l'ensemble des données de la BDD
     *
     * @return $listeEnclos
     ******************************************************/
    public function getListeEnclos() {
        include 'Config/config.php';
        
        $requete = "SELECT * FROM $tableEnclos ORDER BY nom_enclos";
        $resultat = $this->connexion->query($requete);
        $listeEnclos = $resultat->fetchAll(PDO::FETCH_ASSOC);

        // var_dump($listeEnclos);

        return $listeEnclos;
    }


    public function getListeObjets() {
        include 'Config/config.php';
        
        $requete = "SELECT $tableObjet.code_objet, nom_objet
        FROM $tableObjet
        LEFT JOIN $tablePresent ON $tablePresent.code_objet = $tableObjet.code_objet
        LEFT JOIN $tableEnclos ON $tableEnclos.code_enclos = $tablePresent.code_enclos
        GROUP BY nom_objet
        ORDER BY nom_objet";
        $resultat = $this->connexion->query($requete);
        $listeObjets = $resultat->fetchAll(PDO::FETCH_ASSOC);

        // var_dump($requete);
        // var_dump($resultat);
        // var_dump($listeObjets);

        return $listeObjets;
    }
    

    /**
     * Recuperation de TOUS les objets par enclos
     *
     * @return $listeObjetsPresents
     */  
    public function getListeObjetsPresents() {
        include 'Config/config.php';

        $codENC = $_GET['id'];
        
        $requete = "SELECT $tablePresent.code_objet, nom_objet, 
        IF ((SELECT COUNT(*) FROM $tableObjet_achete WHERE $tableObjet_achete.code_objet = $tablePresent.code_objet) = 0, '', qte_objet) AS achete,
        IF ((SELECT COUNT(*) FROM $tableObjet_prete WHERE $tableObjet_prete.code_objet = $tablePresent.code_objet) = 0, '', qte_objet) AS prete
        FROM $tablePresent
        LEFT JOIN $tableObjet ON $tableObjet.code_objet = $tablePresent.code_objet
        WHERE $tablePresent.code_enclos = $codENC";
        $resultat = $this->connexion->query($requete);
        $listeObjetsPresents = $resultat->fetchAll(PDO::FETCH_ASSOC);
        
        // var_dump($_GET);
        // var_dump($requete);
        // var_dump($resultat);
        // var_dump($listeObjetsPresents);

        return $listeObjetsPresents;   
    }


    /**
     * Recuperation de la liste des espèces vivant dans un enclos
     *
     * @return $listeEspecesVivant
     */
    public function getListeEspecesVivant() {
        include 'Config/config.php';

        $codENC = $_GET['id'];
        
        $requete = "SELECT nom_espece
        FROM $tableVivre
        INNER JOIN $tableEspece ON $tableEspece.code_espece = $tableVivre.code_espece
        WHERE $tableVivre.code_enclos = $codENC";
        $resultat = $this->connexion->query($requete);
        $listeEspecesVivant = $resultat->fetchAll(PDO::FETCH_ASSOC);
        
        // var_dump($_GET);
        // var_dump($requete);
        // var_dump($resultat);
        // var_dump($listeEspecesVivant);

        return $listeEspecesVivant;   
    }


    /**
     * Recuperation de la liste des animaux occupant un enclos
     *
     * @return $listeAnimauxOccupant
     */
    public function getListeAnimauxOccupant() {
        include 'Config/config.php';

        $codENC = $_GET['id'];
        
        $requete = "SELECT nom_espece, nomb_animal, date_debut
        FROM $tableHabiter
        INNER JOIN $tableEspece ON $tableEspece.code_espece = $tableHabiter.code_espece
        WHERE $tableHabiter.code_enclos = $codENC AND encours = 1
        ORDER BY nom_espece, nomb_animal";
        $resultat = $this->connexion->query($requete);
        $listeAnimauxOccupant = $resultat->fetchAll(PDO::FETCH_ASSOC);
        
        // var_dump($_GET);
        // var_dump($requete);
        // var_dump($resultat);
        // var_dump($listeAnimauxOccupant);

        return $listeAnimauxOccupant;   
    }

    /* Ne calcule pas le bon nombre d'animaux au sein des enclos...

    public function getOccupationEnclos() {
        include 'Config/config.php';
        
        $requete = "SELECT nom_enclos, COUNT(encours) AS nbAnimaux, nom_objet
        FROM $tableEnclos
        LEFT JOIN $tableHabiter ON $tableEnclos.code_enclos = $tableHabiter.code_enclos
        LEFT JOIN $tablePresent ON $tablePresent.code_enclos = $tableHabiter.code_enclos
        LEFT JOIN $tableObjet ON $tableObjet.code_objet = $tablePresent.code_objet
        WHERE encours = 1
        GROUP BY $tableEnclos.code_enclos
        ORDER BY nom_enclos, nom_objet";
        $resultat = $this->connexion->query($requete);
        $occupationEnclos = $resultat->fetchAll(PDO::FETCH_ASSOC);
        
        // var_dump($_GET);
        // var_dump($requete);
        // var_dump($resultat);
        // var_dump($occupationEnclos);

        return $occupationEnclos;   
    }
    */

    // comptage des animaux par enclos
    public function getListeAnimauxEnclos() {
        include 'Config/config.php';
        
        $requete = "SELECT nom_enclos, COUNT(*) AS nbAnimaux
        FROM $tableHabiter
        INNER JOIN $tableEnclos ON $tableEnclos.code_enclos = $tableHabiter.code_enclos
        WHERE encours = 1
        GROUP BY $tableEnclos.code_enclos
        ORDER BY $tableEnclos.nom_enclos";
        $resultat = $this->connexion->query($requete);
        $listeAnimauxEnclos = $resultat->fetchAll(PDO::FETCH_ASSOC);
        
        // var_dump($_GET);
        // var_dump($requete);
        // var_dump($resultat);
        // var_dump($listeAnimauxEnclos);

        return $listeAnimauxEnclos;   
    }

    /*
    // Animaux de chaque enclos triés par espece et par nom
    public function getListeAnimauxEspeceNom() {
        include 'Config/config.php';
        
        $codENC = $_GET['id'];

        $requete = "SELECT nom_espece, nomb_animal, date_debut
        FROM $tableHabiter
        INNER JOIN $tableEspece ON $tableEspece.code_espece = $tableHabiter.code_espece
        WHERE code_enclos = $codENC AND encours = 1
        ORDER BY nom_espece, nomb_animal";
        // $requete->bindParam(':codENC', $codENC);
        $resultat = $this->connexion->query($requete);
        $listeAnimauxEspeceNom = $resultat->fetchAll(PDO::FETCH_ASSOC);
        
        // var_dump($_GET);
        // var_dump($requete);
        // var_dump($resultat);
        // var_dump($listeAnimauxEspeceNom);

        return $listeAnimauxEspeceNom;   
    } */


    public function getListeAnimauxErrants() {
        include 'Config/config.php';
        
        $requete = "SELECT * FROM $tableAnimal
        WHERE dd_animal IS NULL
        AND CONCAT(code_espece, nomb_animal)
        NOT IN (SELECT CONCAT(code_espece, nomb_animal) FROM $tableHabiter WHERE encours = 1)
        ORDER BY nomb_animal";
        $resultat = $this->connexion->query($requete);
        $listeAnimauxErrants = $resultat->fetchAll(PDO::FETCH_ASSOC);
        
        // var_dump($_GET);
        // var_dump($requete);
        // var_dump($resultat);
        // var_dump($listeAnimauxErrants);

        return $listeAnimauxErrants;   
    }



    /**
     * Ajout dans la BDD
     *
     * @return void
     ******************************************************/
    public function addDB() {
        include 'Config/config.php';
        
        $nomENC = $_POST['nomENC'];
        $supENC = $_POST['supENC'];

        $requete = $this->connexion->prepare("INSERT INTO $tableEnclos
            VALUES (NULL, :nomENC, :supENC)");
        $requete->bindParam(':nomENC', $nomENC);
        $requete->bindParam(':supENC', $supENC);
        $resultat = $requete->execute();

        // var_dump($_POST);
        // var_dump($resultat);
        // var_dump($requete->errorInfo());
    }


    /**
     * Ajout d'objets dans un enclos
     *
     * @return void
     */
    public function addDBObjetsPresents() {
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

        /*
        $codENC = $_POST['codENC'];
        $codOBJ = $_POST['codOBJ'];
        $achOBJ = $_POST['achOBJ'];
        $preOBJ = $_POST['preOBJ'];

        // Mise à jour de la table de l'objet acheté
        if ($achOBJ !== NULL) {
            $requete = $this->connexion->prepare("INSERT INTO $tablePresent
            VALUES (:codENC, :codOBJ, :qteOBJ)");
            $requete->bindParam(':qteOBJ', $achOBJ);
            $resultat = $requete->execute();
        
        // on procède de la même manière pour mettre à jour la table de l'objet prêté
	    } 
        if ($preOBJ !== NULL) {
            $requete = $this->connexion->prepare("INSERT INTO $tablePresent
            VALUES (:codENC, :codOBJ, :qteOBJ)");
            $requete->bindParam(':qteOBJ', $preOBJ);
            $resultat = $requete->execute();
        }
        */

        // var_dump($_POST);
        // var_dump($requete);
        // var_dump($resultat);
        // var_dump($requete->errorInfo());
    }
    

    /**
     * Ajout d'especes dans un enclos
     *
     * @return void
     */
    public function addDBEspecesVivant() {
        include 'Config/config.php';

        $codESP = $_POST['codESP'];
        $codENC = $_POST['codENC'];

        $requete = $this->connexion->prepare("INSERT INTO $tableVivre
            VALUES (:codESP, :codENC)");
        $requete->bindParam(':codESP', $codESP);
        $requete->bindParam(':codENC', $codENC);
        $resultat = $requete->execute();

        // var_dump($_POST);
        // var_dump($requete);
        // var_dump($resultat);
        // var_dump($requete->errorInfo());
    }
    

    /**
     * Ajout d'animaux dans un enclos
     *
     * @return void
     */
    public function addDBAnimauxOccupant() {
        include 'Config/config.php';

        // $codENC = $_GET['id'];
        // $codANI = $_GET['id'];

        $codESP = $_POST['codESP'];
        $nomANI = $_POST['nomANI'];
        $date_debut = $_POST['date_debut'];
        $encours = $_POST['encours'];
        $codENC = $_POST['codENC'];

        // $requete = $this->connexion->prepare("SELECT DISTINCT $tableVivre.code_espece 
        // FROM $tableVivre
        // LEFT JOIN $tableHabiter ON $tableVivre.code_enclos = $tableHabiter.code_enclos
        // WHERE $tableVivre.code_enclos = $codENC AND $tableHabiter.encours = 1
        // AND ($tableHabiter.code_espece IN (SELECT code_espece_1 FROM $tableCohabiter WHERE code_espece = $tableVivre.code_espece)
        // OR $tableHabiter.code_espece = $tableVivre.code_espece)");
        // $resultat = $this->connexion->query($requete);
        // $listeEspecesPossibles = $resultat->fetchAll(PDO::FETCH_ASSOC);
        // return $listeEspecesPossibles;

        // récupération des espèces possibles proposant tous les animaux de chaque espèce
        $requete = "SELECT nomb_animal FROM $tableAnimal WHERE code_espece
        IN (SELECT DISTINCT $tableVivre.code_espece 
        FROM $tableVivre
        LEFT JOIN $tableHabiter ON $tableVivre.code_enclos = $tableHabiter.code_enclos
        WHERE $tableVivre.code_enclos = $codENC AND $tableHabiter.encours = 1
        AND ($tableHabiter.code_espece IN (SELECT code_espece_1 FROM $tableCohabiter WHERE code_espece = $tableVivre.code_espece)
        OR $tableHabiter.code_espece = $tableVivre.code_espece))";
        $resultat = $this->connexion->query($requete);

        $requete = $this->connexion->prepare("UPDATE $tableHabiter SET encours = 0 WHERE nomb_animal = $nomANI");
        $requete->bindParam(':encours', $encours);
        $requete->bindParam(':nomANI', $nomANI);
        $resultat = $requete->execute();

        $requete = $this->connexion->prepare("INSERT INTO $tableHabiter
            VALUES (:codESP, :nomANI, :date_debut, :encours, :codENC)");
        $requete->bindParam(':codESP', $codESP);
        $requete->bindParam(':nomANI', $nomANI);
        $requete->bindParam(':date_debut', $date_debut);
        $requete->bindParam(':encours', $encours);
        $requete->bindParam(':codENC', $codENC);
        $resultat = $requete->execute();

        var_dump($_POST);
        var_dump($requete);
        var_dump($resultat);
        var_dump($requete->errorInfo());
    }
    

    /**
     * Suppression de l'enclos dans la BDD
     *
     * @return void
     ******************************************************/
    public function delDB() {
        include 'Config/config.php';
        
        $codENC = $_GET['id'];

        $requete = $this->connexion->prepare("DELETE FROM $tableEnclos WHERE code_enclos = :codENC");
        $requete->bindParam(':codENC', $codENC);
        $resultat = $requete->execute();

        // var_dump($_GET);
        // var_dump($resultat);
        // var_dump($requete->errorInfo()); 

    }


    /**
     * Suppression de l'objet présent dans l'enclos de la BDD
     *
     * @return void
     */
    public function delDBObjetsPresents() {
        include 'Config/config.php';
        
        $codOBJ = $_GET['id'];

        $requete = $this->connexion->prepare("DELETE FROM $tablePresent WHERE code_objet = :codOBJ");
        $requete->bindParam(':codOBJ', $codOBJ);
        $resultat = $requete->execute();

        // var_dump($_GET);
        // var_dump($resultat);
        // var_dump($requete->errorInfo()); 

    }


    /**
     * Suppression de l'espèce vivant dans l'enclos de la BDD
     *
     * @return void
     */
    public function delDBEspecesVivant() {
        include 'Config/config.php';
        
        $codESP = $_GET['id'];

        $requete = $this->connexion->prepare("DELETE FROM $tableVivre WHERE code_espece = :codESP");
        $requete->bindParam(':codESP', $codESP);
        $resultat = $requete->execute();

        // var_dump($_GET);
        // var_dump($resultat);
        // var_dump($requete->errorInfo()); 

    }


    /**
     * Suppression de l'animal occupant l'enclos de la BDD
     *
     * @return void
     */
    public function delDBAnimauxOccupant() {
        include 'Config/config.php';
        
        $nomANI = $_GET['id'];

        $requete = $this->connexion->prepare("DELETE FROM $tableHabiter WHERE nomb_animal = :nomANI");
        $requete->bindParam(':nomANI', $nomANI);
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
        
        $codENC = $_POST['codENC'];
        $nomENC = $_POST['nomENC'];
        $supENC = $_POST['supENC'];

        $requete = $this->connexion->prepare("UPDATE $tableEnclos 
            SET nom_enclos = :nomENC, superficie_enclos = :supENC
            WHERE code_enclos = :codENC");
        $requete->bindParam(':codENC', $codENC);
        $requete->bindParam(':nomENC', $nomENC);
        $requete->bindParam(':supENC', $supENC);
        $resultat = $requete->execute();

        // var_dump($_POST);
        // var_dump($resultat);
        // var_dump($requete->errorInfo());
    }

    /**
     * Modification de l'objet présent dans l'enclos de la BDD
     *
     * @return void
     ******************************************************/
    public function editDBObjetsPresents() {
        include 'Config/config.php';
        
        $codENC = $_POST['codENC'];
        $codOBJ = $_POST['codOBJ'];
        $qteOBJ = $_POST['qteOBJ'];

        $requete = $this->connexion->prepare("UPDATE $tablePresent 
            SET code_enclos = :codENC, code_objet = :codOBJ, qte_objet = :qteOBJ
            WHERE code_enclos = :codENC");
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
     * Modification de l'espece vivant dans l'enclos de la BDD
     *
     * @return void
     ******************************************************/
    public function editDBEspecesVivant() {
        include 'Config/config.php';
        
        $codESP = $_POST['codESP'];
        $codENC = $_POST['codENC'];

        $requete = $this->connexion->prepare("UPDATE $tableVivre 
            SET code_espece = :codESP, code_enclos = :codENC
            WHERE code_enclos = :codENC");
        $requete->bindParam(':codESP', $codESP);
        $requete->bindParam(':codENC', $codENC);
        $resultat = $requete->execute();
        
        // var_dump($_POST);
        // var_dump($requete);
        // var_dump($resultat);
        // var_dump($requete->errorInfo());
    }


    /**
     * Modification de l'animal occupant l'enclos de la BDD
     *
     * @return void
     ******************************************************/
    public function editDBAnimauxOccupant() {
        include 'Config/config.php';
        
        $codESP = $_POST['codESP'];
        $nomANI = $_POST['nomANI'];
        $date_debut = $_POST['date_debut'];
        $encours = $_POST['encours'];
        $codENC = $_POST['codENC'];

        $requete = $this->connexion->prepare("UPDATE $tableHabiter 
            SET code_espece = :codESP, nomb_animal = :nomANI, date_debut = :date_debut, encours = :encours, code_enclos = :codENC
            WHERE code_enclos = :codENC");
        $requete->bindParam(':codESP', $codESP);
        $requete->bindParam(':nomANI', $nomANI);
        $requete->bindParam(':date_debut', $date_debut);
        $requete->bindParam(':encours', $encours);
        $requete->bindParam(':codENC', $codENC);
        $resultat = $requete->execute();
        
        // var_dump($_POST);
        // var_dump($requete);
        // var_dump($resultat);
        // var_dump($requete->errorInfo());
    }

}
