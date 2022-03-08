<?php
require ('./&inc/header.php');
require ('./&inc/connexion.php');

// Auto-chargemenht des classes utilisées dans ce fichier 
spl_autoload_register(function($classe){
    require './classes/' .$classe. '.class.php';
});

$advertManager = new AdvertManager($bdd);
$categoryManager = new CategoryManager($bdd);

 // Tableau des adverts en BDD
$advert = $advertManager->getAdvertById();
$categories = $categoryManager->getListCategories();
?>

<main>

    <p class="create"> <?= $advert['created_at'] ?></p>
    
    <h2><?= $advert['title'] ?></h2>
    <?php foreach ($categories as $category): ?>
		<?php if ($category['id_category'] == $advert['category_id']): ?>
			<p class="type">Type de contrat : <?= $category['value']; ?></p>	
		<?php endif; ?>	
	<?php endforeach; ?>
    
    <p class="adress">Situé à <?= $advert['city'] .' '.'('. $advert['postcode'].')' ?></p>
    
    <p class="description">A propos de ce bien :<?= $advert['description'] ?></p>
    
    <p class="price">Prix : <?= $advert['price'].' '.'€' ?></p>
    
    <form action="#" method="post">
        <div>
        <?php if ($advert['reservation_message'] === NULL) :?>
            <div>
            <textarea name='reservation_message' rows= '10' cols= '50'><?= $advert['reservation_message']?></textarea>
            </div>
            <div>
            <button type="submit" name="button">Réserver !</button>
            </div>
        <?php else :?>
            <textarea name='reservation_message' rows= '10' cols= '50' readonly><?= $advert['reservation_message']?></textarea>         
        <?php endif ?>
        </div>
    </form>

</main>

<?php
if (isset($_POST['button'])) {

    $advert = new Advert([
    
        'id_advert' => $advert['id_advert'],
        'title' => $advert['title'],
        'description' => $advert['description'],
        'postcode' => $advert['postcode'],
        'city' => $advert['city'],
        'price' => $advert['price'],
        'category_id' =>  $advert['category_id'] ,
        'reservation_message' => $_POST['reservation_message']
    ]);



    if ($advertManager->updateAdvert($advert)) {
        echo 'Annonce Réservé';
        header("Location:catalogue15.php");
        exit;

    } else {
        echo 'PROBLEME : mon annonce n\'a pas été réservé';
    }
}