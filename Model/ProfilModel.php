<?php
//#####################################################################################################
// Lors de la définition du nom de la classe, assurez-vous d'avoir mis le même nom de table dans la BDD
//#####################################################################################################


// Définition de la classe ProfilModel
// la mention "extends" signifie que la classe ProfilModel
// hérite des propriétés et méthodes de sa classe mère "Model"
class ProfilModel extends Model {


    /**
     * Récupération d'un profil de la base de données (BDD)
     *
     * @return $profil
     ******************************************************/
    public function getProfil() {

        // Appel du fichier config.php où sont déclarées
        // les classes et les tables de données correspondantes
        include 'Config/config.php';
        
        $idPRO = $_GET['id'];

        $requete = $this->connexion->prepare("SELECT * FROM $tableProfil WHERE id_profil = :idPRO");
        $requete->bindParam(':idPRO', $idPRO);
        $resultat = $requete->execute();
        $profil = $requete->fetch(PDO::FETCH_ASSOC);

        // var_dump($_GET);
        // var_dump($requete);
        // var_dump($resultat);
        // var_dump($requete->errorInfo());
        // var_dump($profil);

        return $profil;
    }
    
    
    /**
     * Récupération de l'ensemble des profils de la BDD
     *
     * @return $listeProfils
     ******************************************************/
    public function getListeProfils() {
        include 'Config/config.php';
        
        $requete = "SELECT * FROM $tableProfil";
        $resultat = $this->connexion->query($requete);
        $listeProfils = $resultat->fetchAll(PDO::FETCH_ASSOC);

        // var_dump($requete);
        // var_dump($resultat);
        // var_dump($requete->errorInfo());
        // var_dump($listeProfils);

        return $listeProfils;
    }


    public function getListeProfilsSoignant() {
        include 'Config/config.php';
        
        $requete = "SELECT * FROM $tableProfil WHERE role = 'soignant'";
        $resultat = $this->connexion->query($requete);
        $listeProfilsSoignant = $resultat->fetchAll(PDO::FETCH_ASSOC);

        // var_dump($requete);
        // var_dump($resultat);
        // var_dump($requete->errorInfo());
        // var_dump($listeProfilsSoignant);

        return $listeProfilsSoignant;
    }


    public function getListeProfilsEntretien() {
        include 'Config/config.php';
        
        $requete = "SELECT * FROM $tableProfil WHERE role = 'entretien'";
        $resultat = $this->connexion->query($requete);
        $listeProfilsEntretien = $resultat->fetchAll(PDO::FETCH_ASSOC);

        // var_dump($requete);
        // var_dump($resultat);
        // var_dump($requete->errorInfo());
        // var_dump($listeProfilsEntretien);

        return $listeProfilsEntretien;
    }


    /**
     * Récupération de la liste des espèces par soignant de la BDD
     *
     * @return $listeEspecesSoignant
     */
    public function getListeEspecesSoignant() {
        include 'Config/config.php';
        
        $idPRO = $_GET['id'];

        $requete = "SELECT nom_espece, $tableSpecialiser.id_profil_soignant
        FROM $tableEspece
        INNER JOIN $tableSpecialiser ON $tableEspece.code_espece = $tableSpecialiser.code_espece
        WHERE $tableSpecialiser.id_profil_soignant = $idPRO";
        $resultat = $this->connexion->query($requete);
        $listeEspecesSoignant = $resultat->fetchAll(PDO::FETCH_ASSOC);

        // var_dump($_GET);
        // var_dump($requete);
        // var_dump($resultat);
        // var_dump($requete->errorInfo());
        // var_dump($listeEspecesSoignant);

        return $listeEspecesSoignant;
    }


    /**
     * Récupération de la liste des enclos par entretien de la BDD
     *
     * @return $listeEnclosEntretien
     */
    public function getListeEnclosEntretien() {
        include 'Config/config.php';
        
        $idPRO = $_GET['id'];

        $requete = "SELECT nom_enclos, $tableAmenager.id_profil_entretien
        FROM $tableEnclos
        INNER JOIN $tableAmenager ON $tableEnclos.code_enclos = $tableAmenager.code_enclos
        WHERE $tableAmenager.id_profil_entretien = $idPRO";
        $resultat = $this->connexion->query($requete);
        $listeEnclosEntretien = $resultat->fetchAll(PDO::FETCH_ASSOC);

        // var_dump($_GET);
        // var_dump($requete);
        // var_dump($resultat);
        // var_dump($requete->errorInfo());
        // var_dump($listeEnclosEntretien);

        return $listeEnclosEntretien;
    }


    public function getRepartitionPersonnel() {
        include 'Config/config.php';
        
        $requete = "SELECT nom, prenom, role
        FROM $tableProfil
        WHERE role = 'soignant' OR role = 'entretien'
        ORDER BY role, nom";
        $resultat = $this->connexion->query($requete);
        $RepartitionPersonnel = $resultat->fetchAll(PDO::FETCH_ASSOC);

        // var_dump($_GET);
        // var_dump($requete);
        // var_dump($resultat);
        // var_dump($requete->errorInfo());
        // var_dump($RepartitionPersonnel);

        return $RepartitionPersonnel;
    }


    public function getPersonnelSoignant() {
        include 'Config/config.php';
        
        $requete = "SELECT nom, prenom, role
        FROM $tableProfil
        WHERE role = 'soignant'
        ORDER BY role, nom";
        $resultat = $this->connexion->query($requete);
        $personnelSoignant = $resultat->fetchAll(PDO::FETCH_ASSOC);

        // var_dump($_GET);
        // var_dump($requete);
        // var_dump($resultat);
        // var_dump($requete->errorInfo());
        // var_dump($personnelSoignant);

        return $personnelSoignant;
    }


    public function getPersonnelEntretien() {
        include 'Config/config.php';
        
        $requete = "SELECT nom, prenom, role
        FROM $tableProfil
        WHERE role = 'entretien'
        ORDER BY role, nom";
        $resultat = $this->connexion->query($requete);
        $personnelEntretien = $resultat->fetchAll(PDO::FETCH_ASSOC);

        // var_dump($_GET);
        // var_dump($requete);
        // var_dump($resultat);
        // var_dump($requete->errorInfo());
        // var_dump($personnelEntretien);

        return $personnelEntretien;
    }


    public function getRepartitionEspecesSoignant() {
        include 'Config/config.php';

        $requete = "SELECT $tableProfil.nom, $tableProfil.prenom, nom_espece
        FROM $tableEspece
        INNER JOIN $tableSpecialiser ON $tableSpecialiser.code_espece = $tableEspece.code_espece
        INNER JOIN $tableProfil ON $tableProfil.id_profil = $tableSpecialiser.id_profil_soignant
        ORDER BY $tableProfil.nom, nom_espece";
        $resultat = $this->connexion->query($requete);
        $repartitionEspecesSoignant = $resultat->fetchAll(PDO::FETCH_ASSOC);

        // var_dump($_GET);
        // var_dump($requete);
        // var_dump($resultat);
        // var_dump($requete->errorInfo());
        // var_dump($repartitionEspecesSoignant);

        return $repartitionEspecesSoignant;
    }

    public function getRepartitionEnclosEntretien() {
        include 'Config/config.php';

        $requete = "SELECT $tableProfil.prenom, $tableProfil.nom, nom_enclos
        FROM $tableEnclos
        INNER JOIN $tableAmenager ON $tableAmenager.code_enclos = $tableEnclos.code_enclos
        INNER JOIN $tableProfil ON $tableProfil.id_profil = $tableAmenager.id_profil_entretien
        ORDER BY $tableProfil.nom, nom_enclos";
        $resultat = $this->connexion->query($requete);
        $repartitionEnclosEntretien = $resultat->fetchAll(PDO::FETCH_ASSOC);
    
        // var_dump($_GET);
        // var_dump($requete);
        // var_dump($resultat);
        // var_dump($requete->errorInfo());
        // var_dump($repartitionEnclosEntretien);

        return $repartitionEnclosEntretien;
    }

    /**
     * Ajout d'un profil dans la BDD
     *
     * @return void
     ******************************************************/
    public function addDB() {
        include 'Config/config.php';
        
        $identifiant = $_POST['identifiant'];
        $mdp = $_POST['mdp'];
        $mdpHash = password_hash($mdp, PASSWORD_DEFAULT);
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $adresse = $_POST['adresse'];
        $telephone = $_POST['telephone'];
        $role = $_POST['role'];

        $requete = $this->connexion->prepare("INSERT INTO $tableProfil
            VALUES (NULL, :identifiant, :mdpHash, :nom, :prenom, :adresse, :telephone, :role)");
        $requete->bindParam(':identifiant', $identifiant);
        $requete->bindParam(':mdpHash', $mdpHash);
        $requete->bindParam(':nom', $nom);
        $requete->bindParam(':prenom', $prenom);
        $requete->bindParam(':adresse', $adresse);
        $requete->bindParam(':telephone', $telephone);
        $requete->bindParam(':role', $role);
        $resultat = $requete->execute();

        // var_dump($_POST);
        // var_dump($resultat);
        // var_dump($requete->errorInfo());
    }


    public function addDBEspecesSoignant() {
        include 'Config/config.php';
        
        $codESP = $_POST['codESP'];
        $idSoiPRO = $_POST['idSoiPRO'];

        $requete = $this->connexion->prepare("INSERT INTO $tableSpecialiser
            VALUES (:codESP, :idSoiPRO)");
        $requete->bindParam(':codESP', $codESP);
        $requete->bindParam(':idSoiPRO', $idSoiPRO);
        $resultat = $requete->execute();

        // var_dump($_POST);
        // var_dump($resultat);
        // var_dump($requete->errorInfo());
    }


    public function addDBEnclosEntretien() {
        include 'Config/config.php';
        
        $codESP = $_POST['codENC'];
        $idEntPRO = $_POST['idEntPRO'];

        $requete = $this->connexion->prepare("INSERT INTO $tableAmenager
            VALUES (:codENC, :idEntPRO)");
        $requete->bindParam(':codENC', $codENC);
        $requete->bindParam(':idEntPRO', $idEntPRO);
        $resultat = $requete->execute();

        // var_dump($_POST);
        // var_dump($resultat);
        // var_dump($requete->errorInfo());
    }
    

    /**
     * Suppression d'un profil dans la BDD
     *
     * @return void
     ******************************************************/
    public function delDB() {
        include 'Config/config.php';
        
        $idPRO = $_GET['id'];

        $requete = $this->connexion->prepare("DELETE FROM $tableProfil WHERE id_profil = :idPRO");
        $requete->bindParam(':idPRO', $idPRO);
        $resultat = $requete->execute();

        // var_dump($_GET);
        // var_dump($requete);
        // var_dump($resultat);
        // var_dump($requete->errorInfo());

    }


    public function delDBEspecesSoignant() {
        include 'Config/config.php';
        
        $codESP = $_GET['id'];

        $requete = $this->connexion->prepare("DELETE FROM $tableSpecialiser 
        WHERE code_espece = :codESP");
        $requete->bindParam(':codESP', $codESP);
        $resultat = $requete->execute();
    }


    public function delDBEnclosEntretien() {
        include 'Config/config.php';
        
        $codENC = $_GET['id'];

        $requete = $this->connexion->prepare("DELETE FROM $tableAmenager 
        WHERE code_enclos = :codENC");
        $requete->bindParam(':codENC', $codENC);
        $resultat = $requete->execute();
    }


    /**
     * Modification de l'élément dans la BDD
     *
     * @return void
     ******************************************************/
    public function editDB() {
        include 'Config/config.php';
        
        $idPRO = $_POST['idPRO'];
        $identifiant = $_POST['identifiant'];
        $mdp = $_POST['mdp'];
        $mdpHash = password_hash($mdp, PASSWORD_DEFAULT);
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $adresse = $_POST['adresse'];
        $telephone = $_POST['telephone'];
        $role = $_POST['role'];

        $requete = $this->connexion->prepare("UPDATE $tableProfil 
            SET identifiant = :identifiant, mdp = :mdpHash, nom = :nom, prenom = :prenom, adresse = :adresse, telephone = :telephone, role = :role
            WHERE id_profil = :idPRO");
        $requete->bindParam(':idPRO', $idPRO);
        $requete->bindParam(':identifiant', $identifiant);
        $requete->bindParam(':mdpHash', $mdpHash);
        $requete->bindParam(':nom', $nom);
        $requete->bindParam(':prenom', $prenom);
        $requete->bindParam(':adresse', $adresse);
        $requete->bindParam(':telephone', $telephone);
        $requete->bindParam(':role', $role);
        $resultat = $requete->execute();

        // var_dump($_POST);
        // var_dump($resultat);
        // var_dump($requete->errorInfo());
    }

    public function editDBEspecesSoignant() {
        include 'Config/config.php';
        
        $codESP = $_POST['codESP'];
        $idSoiPRO = $_POST['idSoiPRO'];

        $requete = $this->connexion->prepare("UPDATE $tableSpecialiser
            SET :codESP
            WHERE id_profil_soignant = :idSoiPRO");
        $requete->bindParam(':codESP', $codESP);
        $requete->bindParam(':idSoiPRO', $idSoiPRO);
        $resultat = $requete->execute();

        // var_dump($_POST);
        // var_dump($resultat);
        // var_dump($requete->errorInfo());
    }


    public function editDBEnclosEntretien() {
        include 'Config/config.php';
        
        $codENC = $_POST['codENC'];
        $idEntPRO = $_POST['idEntPRO'];

        $requete = $this->connexion->prepare("UPDATE $tableSpecialiser
            SET :codENC
            WHERE id_profil_entretien = :idEntPRO");
        $requete->bindParam(':codENC', $codENC);
        $requete->bindParam(':idEntPRO', $idEntPRO);
        $resultat = $requete->execute();

        // var_dump($_POST);
        // var_dump($resultat);
        // var_dump($requete->errorInfo());
    }

}
