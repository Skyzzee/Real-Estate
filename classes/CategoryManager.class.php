<?php

/**
 * Manager de la class Category
 */
class CategoryManager {

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
     * @param Category $category
     * @return int
     */
    public function addCategory(Category $category) {
        // Préparation de la requete SQL
        $add_category = $this->bdd->prepare ("INSERT INTO category (id_category, value) 
        VALUES (:id_category, :value)");
        // On associe les différentes variables aux marqueurs en respectant les types
        $add_category->bindValue(":id_category", $category->getId_category(), PDO::PARAM_INT);
        $add_category->bindValue(":value", $category->getValue(), PDO::PARAM_STR);

        // On execute la requete 
        $add_category->execute();

        //On libère la connexion BDD
        $add_category->closeCursor();
        return ($add_category->rowCount());
    }


    /**
     * Méthode pour récupérer l'ensemble des category en bdd
     *
     * @return array
     */
    public function getListCategories() {
        return $this->bdd->query('SELECT * FROM category')->fetchAll(PDO::FETCH_ASSOC);
     }

}