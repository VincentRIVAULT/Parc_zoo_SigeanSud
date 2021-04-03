<?php
//#####################################################################################################
// Lors de la définition du nom de la classe, assurez-vous d'avoir mis le même nom de table dans la BDD
//#####################################################################################################


// Définition de la classe AnimalModel
// la mention "extends" signifie que la classe AnimalModel
// hérite des propriétés et méthodes de sa classe mère "Model"
class AnimalModel extends Model {


    /**
     * Récupération d'une donnée de la base de données (BDD)
     *
     * @return $animal
     ******************************************************/
    public function getAnimal() {
        // Appel du fichier config.php où sont déclarées
        // les classes et les tables de données correspondantes
        include 'Config/config.php';
        
        // requête SQL pour récupérer les données de la page demandée grâce à son identifiant
        // les données récupérées sont stockées dans la variable $nomANI
        $nomANI = $_GET['id'];

        $requete = $this->connexion->prepare("SELECT * FROM $tableAnimal WHERE nomb_animal = :nomANI");
        $requete->bindParam(':nomANI', $nomANI);
        $resultat = $requete->execute();
        $animal = $requete->fetch(PDO::FETCH_ASSOC);
        
        // var_dump($_GET);
        // var_dump($resultat);
        // var_dump($requete->errorInfo());
        // var_dump($animal)

        return $animal;
    }
    
    
    /**
     * Récupération de l'ensemble des données de la BDD
     *
     * @return $listeAnimaux
     ******************************************************/
    public function getAnimaux() {
        include 'Config/config.php';
        
        $requete = "SELECT * FROM $tableAnimal INNER JOIN $tableEspece ON $tableAnimal.code_espece = $tableEspece.code_espece  
        ORDER BY nomb_animal";
        $resultat = $this->connexion->query($requete);
        $listeAnimaux = $resultat->fetchAll(PDO::FETCH_ASSOC);

        // var_dump($listeAnimaux);

        return $listeAnimaux;
    }

    public function getAnimalParents() {
        include 'Config/config.php';
        
        // requête SQL pour récupérer les parents de l'animal grâce à son identifiant
        // les données récupérées sont stockées dans la variable $nomANI
        $nomANI = $_GET['id'];
        
        $requete = $this->connexion->prepare("SELECT code_espece, nomb_animal_a_pour_parent as Parents FROM $tableAnimal
        LEFT JOIN $tableParent ON $tableAnimal.nomb_animal = $tableParent.nomb_animal_a_pour_enfant
        AND $tableAnimal.code_espece = $tableParent.a_pour_enfant
        WHERE nomb_animal = $nomANI");
        //$resultat = $this->connexion->query($requete);
        $resultat = $requete->execute();
        $animalParents = $requete->fetchAll(PDO::FETCH_ASSOC);

        // var_dump($_GET);
        // var_dump($resultat);
        // var_dump($requete->errorInfo());
        // var_dump($animalParents);

        return $animalParents;
    }

    // requête pour générer un menu déroulant proposant les espèces présentes
    // à la place du code espèce à saisir
    public function getListEspeces() {
        include 'Config/config.php';
        
        $requete = "SELECT * FROM $tableEspece
        LEFT JOIN $tableAnimal ON $tableAnimal.code_espece = $tableEspece.code_espece
        GROUP BY $tableEspece.nom_espece
        ORDER BY $tableEspece.nom_espece";
        $resultat = $this->connexion->query($requete);
        $listeEspeces = $resultat->fetchAll(PDO::FETCH_ASSOC);

        // var_dump($listeEspeces);

        return $listeEspeces;
    }


    /**
     * Population du parc
     *
     * @return void
     */
    // population totale
    public function getAnimauxParc() {
        include 'Config/config.php';
        
        $requete = "SELECT COUNT(*) AS nbAnimaux 
        FROM $tableAnimal
        WHERE $tableAnimal.dd_animal IS NULL";
        $resultat = $this->connexion->query($requete);
        $listeAnimauxParc = $resultat->fetchAll(PDO::FETCH_ASSOC);

        // var_dump($listeAnimauxParc);

        return $listeAnimauxParc;
    }


    // population par espèce
    public function getAnimauxEspecesParc() {
        include 'Config/config.php';
        
        $requete = "SELECT $tableEspece.nom_espece, COUNT(*) AS nbAnimaux
        FROM $tableAnimal
        INNER JOIN $tableEspece ON $tableEspece.code_espece = $tableAnimal.code_espece
        WHERE $tableAnimal.dd_animal IS NULL
        GROUP BY $tableEspece.code_espece
        ORDER BY $tableEspece.nom_espece";
        $resultat = $this->connexion->query($requete);
        $listeAnimauxEspecesParc = $resultat->fetchAll(PDO::FETCH_ASSOC);

        // var_dump($listeAnimauxEspecesParc);

        return $listeAnimauxEspecesParc;
    }


    // pour chaque espèce
    public function getAnimalEspeceParc() {
        include 'Config/config.php';
        
        $codESP = $_GET['id'];

        $requete = $this->connexion->prepare("SELECT nomb_animal
        FROM $tableAnimal
        WHERE $tableAnimal.code_espece = :codESP
        AND dd_animal IS NULL");
        $requete->bindParam(':codESP', $codESP);
        $resultat = $requete->execute();
        // $resultat = $this->connexion->query($requete);
        $listeAnimalEspeceParc = $resultat->fetch(PDO::FETCH_ASSOC);
        // $listeAnimalEspeceParc = $resultat->fetchAll(PDO::FETCH_ASSOC);

        // var_dump($listeAnimalEspeceParc);

        return $listeAnimalEspeceParc;
    }
    
    
    /**
     * Ajout dans la BDD
     *
     * @return void
     ******************************************************/
    public function addDB() {
        include 'Config/config.php';
        
        $codESP = $_POST['codESP'];
        $nomANI = $_POST['nomANI'];
        $sexeANI = $_POST['sexeANI'];
        $dnANI = $_POST['dnANI'];
        $ddANI = $_POST['ddANI'];

        if (empty($ddANI)) {
            $ddANI=NULL;
        }

        // var_dump($_POST);

        $requete = $this->connexion->prepare("INSERT INTO $tableAnimal
            VALUES (:codESP, :nomANI, :sexeANI, :dnANI, :ddANI)");
        $requete->bindParam(':codESP', $codESP);
        $requete->bindParam(':nomANI', $nomANI);
        $requete->bindParam(':sexeANI', $sexeANI);
        $requete->bindParam(':dnANI', $dnANI);
        $requete->bindParam(':ddANI', $ddANI);
        $resultat = $requete->execute();

        // var_dump($resultat);
        // var_dump($requete->errorInfo());
    }

    public function addDBAnimalParent() {
        include 'Config/config.php';
        
        $parANI = $_POST['parANI'];
        $nomPANI = $_POST['nomPANI'];
        $enfANI = $_POST['enfANI'];
        $nomEANI = $_POST['nomEANI'];

        // var_dump($_POST);

        $requete = $this->connexion->prepare("INSERT INTO $tableParent
            VALUES (:parANI, :nomPAni, :enfANI, :nomEANI)");
    
//INSERT INTO `parent` (`a_pour_parent`, `nom_bapteme_a_pour_parent`, `a_pour_enfant`, `nom_bapteme_a_pour_enfant`) VALUES (@es1, @an1, @es, @an);
        $requete->bindParam(':parANI', $parANI);
        $requete->bindParam(':nomPANI', $nomPANI);
        $requete->bindParam(':enfANI', $enfANI);
        $requete->bindParam(':nomEANI', $nomEANI);
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
        
        $nomANI = $_GET['id'];

        // var_dump($_GET);

        $requete = $this->connexion->prepare("DELETE FROM $tableAnimal WHERE nomb_animal = :nomANI");
        $requete->bindParam(':nomANI', $nomANI);
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
        $nomANI = $_POST['nomANI'];
        $sexeANI = $_POST['sexeANI'];
        $dnANI = $_POST['dnANI'];
        $ddANI = $_POST['ddANI'];

        if (empty($ddANI)) {
            $ddANI=NULL;
        }

        // var_dump($_POST);

        $requete = $this->connexion->prepare("UPDATE $tableParent
            SET code_espece= :codESP, nomb_animal = :nomANI, sexe_animal = :sexeANI, dn_animal = :dnANI, dd_animal = :ddANI
            WHERE nomb_animal = :nomANI");
        $requete->bindParam(':codESP', $codESP);
        $requete->bindParam(':nomANI', $nomANI);
        $requete->bindParam(':sexeANI', $sexeANI);
        $requete->bindParam(':dnANI', $dnANI);
        $requete->bindParam(':ddANI', $ddANI);
        $resultat = $requete->execute();

        // var_dump($resultat);
        // var_dump($requete->errorInfo());
    }       
}