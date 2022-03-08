<?php 
require ('./&inc/header.php');
require ('./&inc/connexion.php');

// Auto-chargemenht des classes utilisées dans ce fichier 
spl_autoload_register(function($classe){
    require './classes/' .$classe. '.class.php';
});

$advertManager = new AdvertManager($bdd);
$categoryManager = new CategoryManager($bdd);
$advert = $advertManager->getAdvertById();
$categories = $categoryManager->getListCategories();
?>
<table>
       <thead>
           <tr class="first_line">
               <th>Type</th>
               <th>Titre</th>
               <th>Description</th>
               <th>Code Postal</th>
               <th>Ville</th>
               <th>Prix</th>
               <th>Disponibilité</th>
               <th>Créé le</th>
           </tr>
       </thead>
       <tbody>
            <tr>
                <?php foreach ($categories as $category): ?>
                    <?php if ($category['id_category'] == $advert['category_id']): ?>
                        <td> <?= $category['value']; ?></td>	
                    <?php endif; ?>	
                <?php endforeach; ?>
            <td><?= $advert['title'] ?></td>
            <td><?= $advert['description'] ?></td>
            <td><?= $advert['postcode'] ?></td>
            <td><?= $advert['city'] ?></td>
            <td><?= $advert['price']  . " " . '€'?></td>
            <?php if ($advert['reservation_message'] === NULL) :?>
                <td>Disponible</td>
            <?php else :?>
                <td>Réservé</td>
            <?php endif ?>
            <td><?= $advert['created_at'] ?></td>
       </tbody>
</table>

<h2> Voulez vous réellement supprimer cette annonce ?</h2>
<form class="delete" action="#" method="post">
    <div>
        <label for="confirm">Ecrivez "Supprimer" avant de confirmer pour supprimer l'annonce</label>
        <input type="text" name="confirm" playholder="Supprimer">
    </div>

    <input  class="button" name="accept" type="submit" value="Supprimer">
    <input  class="button" name="refuse" type="submit" value="Annuler">
</form>

<?php
if ($_POST['confirm'] == "Supprimer") {
    if (isset($_POST['accept'])) {
        // ADD en BDD
        if ($advertManager->deleteAdvertById($advert)) {
            echo 'Annonce bien Supprimée';
        } else {
            echo 'PROBLEME : mon annonce n\'a pas été supprimée en BDD';
        }}
    
    if (isset($_POST['refuse'])) {
        header("Location:advert_manage.php");
        exit;
    }

} else {
    echo 'ERREUR : Veuillez ecrire correctement "Supprimer" avant de confirmer';
} 


?>