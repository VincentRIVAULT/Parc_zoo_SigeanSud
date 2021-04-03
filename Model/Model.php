<?php

$server = $_SERVER['HTTP_HOST'];


if ($server == 'localhost') {
    abstract class Model
{
    const SERVER = "localhost";
    const USER = "root";
    const PASSWORD = "";
    const BASE = "projet2_parc_zoo";

    protected $connexion;

    public function __construct()
    {
        // Connexion
        try {
            $this->connexion = new PDO("mysql:host=" . self::SERVER . ";dbname="
            . self::BASE, self::USER, self::PASSWORD);
        } catch (Exception $e) {
            echo 'Erreur : ' . $e->getMessage();
        }
        //Résoudre problèmes d'encodages (accents)
        $this->connexion->exec("SET NAMES 'UTF8'");

    }
}
} else {
    abstract class Model
{
    const SERVER = "localhost";
    const USER = "bxjurhjn_vincent";
    const PASSWORD = "ABPEgcqm6949&@";
    const BASE = "bxjurhjn_parc_zoo_sigeansud";

    protected $connexion;

    public function __construct()
    {
        // Connexion
        try {
            $this->connexion = new PDO("mysql:host=" . self::SERVER . ";dbname="
            . self::BASE, self::USER, self::PASSWORD);
        } catch (Exception $e) {
            echo 'Erreur : ' . $e->getMessage();
        }
        //Résoudre problèmes d'encodages (accents)
        $this->connexion->exec("SET NAMES 'UTF8'");

    }
}
}