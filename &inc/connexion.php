<?php
$dbservername = 'localhost';     
$dbname = 'real_estate';
$dbusername = 'root';
$dbpassword = '';

// On essaie de se connecter
try{
    $bdd = new PDO("mysql:host=$dbservername;dbname=$dbname;charset=utf8", $dbusername, $dbpassword);
    //On définit le mode d'erreur de PDO sur Exception
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $bdd->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    // echo 'Connexion réussie';

}

// On capture les exceptions si une exception est lancée et on affiche les informations relatives à celle-ci
catch(PDOException $e){
  echo "ERREUR : " . $e->getMessage();
}