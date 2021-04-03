<?php
//#####################################################################################################
// Lors de la définition du nom de la classe, assurez-vous d'avoir mis le même nom de table dans la BDD
//#####################################################################################################


// Définition de la classe MenusModel
// la mention "extends" signifie que la classe MenusModel
// hérite des propriétés et méthodes de sa classe mère "Model"
class MenusModel extends Model {


    /**
     * Récupération d'une donnée de la base de données (BDD)
     *
     * @return $menu
     ******************************************************/
    public function getMenu() {
        // Appel du fichier config.php où sont déclarées
        // les classes et les tables de données correspondantes
        include 'Config/config.php';
        
        // requête SQL pour récupérer le menu demandé grâce à son identifiant
        // les données récupérées sont stockées dans la variable $codMEN
        $codMEN = $_GET['id'];

        $requete = $this->connexion->prepare("SELECT * FROM $tableMenus WHERE code_menu = :codMEN");
        $requete->bindParam(':codMEN', $codMEN);
        $resultat = $requete->execute();
        $menu = $requete->fetch(PDO::FETCH_ASSOC);
        
        // var_dump($_GET);
        // var_dump($resultat);
        // var_dump($requete->errorInfo());
        // var_dump($menu);
        
        return $menu;
    }
    
    
    /**
     * Récupération de l'ensemble des données de la BDD
     *
     * @return $listeMenus
     ******************************************************/
    public function getMenus() {
        include 'Config/config.php';
        
        $requete = "SELECT * FROM $tableMenus INNER JOIN $tableEspece ON $tableMenus.code_espece = $tableEspece.code_espece";
        $resultat = $this->connexion->query($requete);
        $listeMenus = $resultat->fetchAll(PDO::FETCH_ASSOC);

        // var_dump($listeMenus);

        return $listeMenus;
    }

     /**
     * Récupération de l'ensemble des données de la BDD
     *
     * @return $listeItems
     ******************************************************/
    public function getListRepas() {
        include 'Config/config.php';
        
        $codMEN = $_GET['id'];

        $requete = $this->connexion->prepare("SELECT $tableManger.code_espece, $tableManger.nomb_animal, dh_repas, qte_distribuee, qte_recommandee_menus 
        FROM $tableManger INNER JOIN $tableMenus ON $tableManger.code_menu = $tableMenus.code_menu
        WHERE $tableMenus.code_menu = :codMEN");

        $requete->bindParam(':codMEN', $codMEN);

        //$resultat = $this->connexion->query($requete);
        $resultat = $requete->execute();
        $listeRepas = $requete->fetchAll(PDO::FETCH_ASSOC);

        // var_dump($_GET);
        // var_dump($resultat);
        // var_dump($requete->errorInfo());
        // var_dump($listeRepas);

        return $listeRepas;
    }

    public function getRepas() {
        include 'Config/config.php';
        
        $requete = "SELECT $tableManger.code_espece, $tableManger.nomb_animal, dh_repas, qte_distribuee 
        FROM $tableManger";
        $resultat = $this->connexion->query($requete);
        $repas = $resultat->fetchAll(PDO::FETCH_ASSOC);

       // var_dump($repas);

       return $repas;
    }

    public function getRepasJour() {
        include 'Config/config.php';

        // $dhREPMEN = $_GET['dhREPMEN'];

        $requete = "SELECT * FROM $tableManger";
        // -- WHERE date_format(dh_repas, '%Y-%m-%d') = $dhREPMEN";
        //$requete->bindParam(':dhREPMEN', $dhREPMEN);
        $resultat = $this->connexion->query($requete);
        $repas = $resultat->fetchAll(PDO::FETCH_ASSOC);

        // var_dump($_GET);
        // var_dump($resultat);
        // var_dump($requete->errorInfo());
        // var_dump($repas);

       return $repas;
    }
    
     
    /**
     * Ajout dans la BDD
     *
     * @return void
     ******************************************************/
    public function addDB() {
        include 'Config/config.php';
        
        $libMEN = $_POST['libMEN'];
        $qteRMEN = $_POST['qteRMEN'];
        $codESP = $_POST['codESP'];

        // var_dump($_POST);

        $requete = $this->connexion->prepare("INSERT INTO $tableMenus
            VALUES (NULL, :libMEN, :qteRMEN, :codESP)");
        $requete->bindParam(':libMEN', $libMEN);
        $requete->bindParam(':qteRMEN', $qteRMEN);
        $requete->bindParam(':codESP', $codESP);
        $resultat = $requete->execute();

        // var_dump($resultat);
        // var_dump($requete->errorInfo());
    }

     /**
     * Ajout dans la BDD
     *
     * @return void
     ******************************************************/
    public function addDBRepas() {
        include 'Config/config.php';
        
        $codESP = $_POST['codESP'];
        $nomANI = $_POST['nomANI'];
        $dhREPMEN = $_POST['dhREPMEN'];
        $qteDMEN = $_POST['qteDMEN'];
        $codMEN = $_POST['codMEN'];

        // var_dump($_POST);

        $requete = $this->connexion->prepare("INSERT INTO $tableManger
            VALUES (:codESP, :nomANI, :dhREPMEN, :qteDMEN, :codMEN)");

        $requete->bindParam(':codESP', $codESP);
        $requete->bindParam(':nomANI', $nomANI);
        $requete->bindParam(':dhREPMEN', $dhREPMEN);
        $requete->bindParam(':qteDMEN', $qteDMEN);
        $requete->bindParam(':codMEN', $codMEN);
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
        
        $codMEN = $_GET['id'];

        //var_dump($_GET);

        $requete = $this->connexion->prepare("DELETE FROM $tableMenus WHERE code_menu = :codMEN");
        $requete->bindParam(':codMEN', $codMEN);
        $resultat = $requete->execute();

        //var_dump($resultat);
        //var_dump($requete->errorInfo()); 

    }

    public function delDBRepas() {
        include 'Config/config.php';
        
        $codESP = $_GET['id'];
        $nomANI = $_GET['id'];
        $dhREPMEN = $_GET['id'];

        //var_dump($_GET);

        $requete = $this->connexion->prepare("DELETE FROM $tableManger WHERE $tableManger.code_espece = :codESP
            AND $tableManger.nomb_animal = :nomANI
            AND $tableManger.dh_repas = :dhREPMEN");

        //DELETE FROM `manger` WHERE `manger`.`code_espece` = 12 
        //AND `manger`.`nomb_animal` = \'Sharknado\' 
        //AND `manger`.`dh_repas` = \'2021-02-11 10:00:00\'
        $requete->bindParam(':codESP', $codESP);
        $requete->bindParam(':nomANI', $nomANI);
        $requete->bindParam(':dhREPMEN', $dhREPMEN);
        $resultat = $requete->execute();

        //var_dump($resultat);
        //var_dump($requete->errorInfo()); 
    }


    /**
     * Modification de l'élément dans la BDD
     *
     * @return void
     ******************************************************/
    public function editDB() {
        include 'Config/config.php';
        
        $codMEN = $_POST['codMEN'];
        $libMEN = $_POST['libMEN'];
        $qteRMEN = $_POST['qteRMEN'];
        $codESP = $_POST['codESP'];

        // var_dump($_POST);

        $requete = $this->connexion->prepare("UPDATE $tableMenus
            SET libelle_menus = :libMEN, qte_recommandee_menus = :qteRMEN, code_espece = :codESP
            WHERE code_menu = :codMEN");
        $requete->bindParam(':codMEN', $codMEN);
        $requete->bindParam(':libMEN', $libMEN);
        $requete->bindParam(':qteRMEN', $qteRMEN);
        $requete->bindParam(':codESP', $codESP);
        $resultat = $requete->execute();

        // var_dump($resultat);
        // var_dump($requete->errorInfo());
    }

    public function editDBRepas() {
        include 'Config/config.php';
        
        $codESP = $_POST['codESP'];
        $nomANI = $_POST['nomANI'];
        $dhREPMEN = $_POST['dhREPMEN'];
        $qteDMEN = $_POST['qteDMEN'];
        $codESP = $_POST['codESP'];

        // var_dump($_POST);

        $requete = $this->connexion->prepare("UPDATE $tableManger
            SET code_espece = :codESP, nomb_animal = :nomANI, dh_repas = :dhREPMEN, qte_distribuee = :qteDMEN, code_menu = :codESP 
            WHERE $tableManger.code_espece = :codESP AND  $tableManger.nomb_animal = :nomANI AND $tableManger.dh_repas = :dhREPMEN");

        $requete->bindParam(':codESP', $codESP);
        $requete->bindParam(':nomANI', $nomANI);
        $requete->bindParam('dhREPMEN', $dhREPMEN);
        $requete->bindParam('qteDMEN', $qteDMEN);
        $requete->bindParam(':codMEN', $codMEN);
        $resultat = $requete->execute();

        // var_dump($resultat);
        // var_dump($requete->errorInfo());
    }
}