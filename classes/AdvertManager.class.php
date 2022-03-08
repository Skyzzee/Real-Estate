<?php

/**
 * Manager de la class Advert
 */
class AdvertManager {

    /**
     * Connecteur à la BDD 
     *
     * @var Object
     */
    private $bdd;


     /**
      * Constructeur 
      *
      * @param PDO $bdd
      */
    public function __construct(PDO $bdd) {
        $this->bdd= $bdd;
    }
    

    /**
     * Méthode pour ADD
     *
     * @param Advert $advert
     * @return int
     */
    public function addAdvert(Advert $advert) {
        // Préparation de la requete SQL
        $add_advert = $this->bdd->prepare ("INSERT INTO advert ( title, description, postcode, city, price, reservation_message, category_id) 
        VALUES ( :title, :description, :postcode, :city, :price, :reservation_message, :category_id)");
        // On associe les différentes variables aux marqueurs en respectant les types
        $add_advert->bindValue(":title", $advert->getTitle(), PDO::PARAM_STR);
        $add_advert->bindValue(":description", $advert->getDescription(), PDO::PARAM_STR);
        $add_advert->bindValue(":postcode", $advert->getPostcode(), PDO::PARAM_INT);
        $add_advert->bindValue(":city", $advert->getCity(), PDO::PARAM_STR);
        $add_advert->bindValue(":price", $advert->getPrice(), PDO::PARAM_STR);
        $add_advert->bindValue(":reservation_message", $advert->getReservation_message(), PDO::PARAM_STR);
        $add_advert->bindValue(":category_id", $advert->getCategory_id(), PDO::PARAM_INT);
        

        // On execute la requete 
        $add_advert->execute();

        //On libère la connexion BDD
        $add_advert->closeCursor();
        return ($add_advert->rowCount());
    }



    /**
     * Méthode pour récupérer l'ensemble des annonces en bdd
     *
     * @return array
     */
    public function getListAdverts() {
        return $this->bdd->query('SELECT * FROM advert')->fetchAll(PDO::FETCH_ASSOC);
     }
    
     /**
     * Méthode pour récupérer les 15 premières annonces en bdd(ajouter en dernière)
     *
     * @return array
     */
    public function getList15Adverts() {
        return $this->bdd->query("SELECT * FROM `advert` INNER JOIN category ON category_id = id_category ORDER BY id_advert DESC LIMIT 15;")->fetchAll();
     }

     /**
     * Méthode pour récupérer seulement les ventes en bdd(ajouter en dernière)
     *
     * @return array
     */
    public function getListSaleAdverts() {
        return $this->bdd->query("SELECT * FROM `advert` INNER JOIN category ON category_id = id_category WHERE category_id = 1;")->fetchAll();
     }

     /**
     * Méthode pour récupérer seulement les locations en bdd(ajouter en dernière)
     *
     * @return array
     */
    public function getListRentalAdverts() {
        return $this->bdd->query("SELECT * FROM `advert` INNER JOIN category ON category_id = id_category WHERE category_id = 2;")->fetchAll();
     }

     /**
     * Méthode pour récupérer une annonce en bdd selon son ID
     *
     * @return array
     */
    public function getAdvertById(){
		return $this->bdd->query("SELECT * FROM advert WHERE id_advert = $_GET[id]")->fetch();
	}

     /**
     * Méthode pour UPDATE
     *
     * @param Advert $advert
     * @return int
     */
    public function updateAdvert(Advert $advert) {
        // Préparation de la requete SQL
        $update_advert = $this->bdd->prepare ("UPDATE advert SET title = :title, description = :description, postcode = :postcode, city = :city, price = :price, reservation_message = :reservation_message, category_id = :category_id WHERE id_advert = $_GET[id]");
        // On associe les différentes variables aux marqueurs en respectant les types
        $update_advert->bindValue(":title", $advert->getTitle(), PDO::PARAM_STR);
        $update_advert->bindValue(":description", $advert->getDescription(), PDO::PARAM_STR);
        $update_advert->bindValue(":postcode", $advert->getPostcode(), PDO::PARAM_INT);
        $update_advert->bindValue(":city", $advert->getCity(), PDO::PARAM_STR);
        $update_advert->bindValue(":price", $advert->getPrice(), PDO::PARAM_STR);
        $update_advert->bindValue(":reservation_message", $advert->getReservation_message(), PDO::PARAM_STR);
        $update_advert->bindValue(":category_id", $advert->getCategory_id(), PDO::PARAM_INT);
        
        // On execute la requete 
        $update_advert->execute();

        //On libère la connexion BDD
        $update_advert->closeCursor();
        return ($update_advert->rowCount());
    }

    /**
     * Méthode pour supprimer une advert en bdd
     *
     * @param int $id
     * @return int
     */
    public function deleteAdvertById() {
        // Préparation de la requète SQL
        $delete_advert_byId = $this->bdd->query("DELETE FROM `advert` WHERE `id_advert` =  $_GET[id]");
        $delete_advert_byId->closeCursor();
        return ($delete_advert_byId->rowCount());
    }
}