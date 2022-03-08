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
               <th>Voir plus</th>
               <th>Créé le</th>
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
                   <td><a class="icon" href="./catalogueSeeMore.php?id=<?=$advert['id_advert']?>"><img src="./icon/icons8-visible-50.png" alt="See More" ></a></td>
                   <td><?= $advert['created_at'] ?></td>
            <?php endforeach; ?>

       </tbody>
</table>