<?php

// On inclut le "connecteur" à la bdd
require ("./&inc/connexion.php");
require ('./&inc/header.php');

// Auto-chargemenht des classes utilisées dans ce fichier 
spl_autoload_register(function($classe){
    require './classes/' .$classe. '.class.php';
});

// On récupère les données de la table Category
$categoryManager = new CategoryManager($bdd);
$categories = $categoryManager->getListCategories();

?>


<main>
    <h2>Ajouter une nouvelle Annonce :</h2>

    <form action="#" method="post">
        <div>
            <label for="title">Titre :</label>
            <input type ="text" name="title" placeholder="(champ obligatoire)">
        </div>

        <div>
            <label for="description">description :</label>
            <input type ="text" name="description" placeholder="(champ obligatoire)">
        </div>

        <div>
            <label for="postcode">Code Postal :</label>
            <input type ="number" name="postcode" placeholder="(champ obligatoire)">
        </div>

        <div> 
            <label for="city">Ville :</label>
            <input type ="text" name="city"  placeholder="(champ obligatoire)">
        </div>

        <div> 
            <label for="price">Prix :</label>
            <input type ="text" name="price" step="0.01" placeholder="(champ obligatoire)">
        </div>

        <div>
            <label>Valeur :</label>
					<select name="value"  id="value">
						<option value="" selected disabled>Sélectionner un type de vente :</option>
						<?php foreach ($categories as $category): ?>
							<option value='<?= $category['id_category']; ?>' ><?= $category['value'] ?></option>
						<?php endforeach; ?>
					</select>
        </div>

        <input class="button" type="submit" name ="button" value="AJOUTER">
    </form>
</main>


<?php

if (isset($_POST['button'])) {

    $advertManager = new AdvertManager($bdd);
    $categoryManager = new CategoryManager($bdd);

    $advert = new Advert([
        'title' => $_POST['title'] ,
        'description' => $_POST['description'],
        'postcode' => $_POST['postcode'],
        'city' => $_POST['city'],
        'price' => $_POST['price'],
        'category_id' =>  $_POST['value'] ,
    ]);


    // ADD en BDD
    if ($advertManager->addAdvert($advert)) {
        echo 'Annonce bien ajoutée';
        header("Location:catalogue15.php");
        exit;
        
    } else {
        echo 'PROBLEME : mon annonce n\'a pas été ajoutée en BDD';
    }

}