<?php

// On inclut le "connecteur" à la bdd
require ("./&inc/connexion.php");
require ('./&inc/header.php');

// Auto-chargemenht des classes utilisées dans ce fichier 
spl_autoload_register(function($classe){
    require './classes/' .$classe. '.class.php';
});

// On récupère les données
$advertManager = new AdvertManager($bdd);
$categoryManager = new CategoryManager($bdd);
$advert = $advertManager->getAdvertById();
$categories = $categoryManager->getListCategories();

?>


<main>
    <h2>Modifier une Annonce :</h2>

    <form action="#" method="post">
        <div>
            <label for="title">Titre :</label>
            <input type ="text" name="title" value="<?= $advert['title'] ?>">
        </div>

        <div>
            <label for="description">description :</label>
            <input type ="text" name="description" value="<?= $advert['description'] ?>">
        </div>

        <div>
            <label for="postcode">Code Postal :</label>
            <input type ="number" name="postcode" value="<?= $advert['postcode'] ?>">
        </div>

        <div> 
            <label for="city">Ville :</label>
            <input type ="text" name="city"  value="<?= $advert['city'] ?>">
        </div>

        <div> 
            <label for="price">Prix :</label>
            <input type ="text" name="price" step="0.01" value="<?= $advert['price'] ?>">
        </div>

        <div>
            <label>Valeur :</label>
            <select  name="value"  id="value">
				<option  value="" selected disabled>Selectionner une catégorie :</option>
				<?php foreach ($categories as $category): ?>
					<?php if ($category['id_category'] == $advert['category_id']): ?>
						<option value='<?= $category['id_category']; ?>' selected ><?= $category['value'] ?></option>
					<?php else: ?>	
                        <option value='<?= $category['id_category']; ?>' ><?= $category['value'] ?></option>
					<?php endif; ?>	
				<?php endforeach; ?>
			</select>
        </div>

        <input class="button" type="submit" name ="button" value="MODIFIER">
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
    if ($advertManager->updateAdvert($advert)) {
        echo 'Annonce bien modifiée';
    } else {
        echo 'PROBLEME : mon annonce n\'a pas été modifiée en BDD';
    }

}