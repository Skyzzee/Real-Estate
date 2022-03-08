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
$adverts = $advertManager->getListAdverts();
$categories = $categoryManager->getListCategories();
?>

   <table class="table_manage">
        <h2>Gestions des annonces </h2>
       <thead>
           <tr class="first_line">
               <th>value</th>
               <th>title</th>
               <th>description</th>
               <th>postcode</th>
               <th>city</th>
               <th>price</th>
               <th>reservation</th>
               <th>See More</th>
               <th>Update</th>
               <th>Delete</th>
               <th>Created_at</th>
           </tr>
       </thead>
       <tbody>
                   
       <?php foreach($adverts as $advert) : ?>
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
                   <td><a href="./catalogueSeeMore.php?id=<?=$advert['id_advert']?>"><img class="icon1" src="./icon/icons8-visible-50.png" alt="See More" ></a></td>
                   <td><a href="./advert_update.php?id=<?=$advert['id_advert']?>"><img class="icon2" src="./icon/icons8-making-notes-32.png" alt="Update" ></a></td>
                   <td><a href="./advert_delete.php?id=<?=$advert['id_advert']?>"><img class="icon3" src="./icon/icons8-poubelle-50.png" alt="Delete" ></a></td>
                   <td><?= $advert['created_at'] ?></td>
            <?php endforeach; ?>

       </tbody>
   </table>

<?php
require ('./&inc/footer.php');