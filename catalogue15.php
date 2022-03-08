<?php

require ('./&inc/connexion.php');
require ('./&inc/header.php');

// Auto-chargemenht des classes utilisées dans ce fichier 
spl_autoload_register(function($classe){
    require './classes/' .$classe. '.class.php';
});

$advertManager = new AdvertManager($bdd);
$categoryManager = new CategoryManager($bdd);

 // Tableau des adverts en BDD
$adverts = $advertManager->getList15Adverts();
$categories = $categoryManager->getListCategories();
?>

<a class ="allAnnonce" href="catalogueAll.php">Voir toutes les annonces</a>
<h2>Les 15 dernières annonces</h2>

<?php
require ('./&inc/table.php');
require ('./&inc/footer.php');