<?php

/**
 * Advert
 */
class Advert {

    // Propriétés de la Class Advert
    /**
     * @var int
     */
    private $id_advert;

    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $description;

    /**
     * @var int
     */
    private $postcode;

    /**
     * @var string
     */
    private $city;

    /**
     * @var string
     */
    private $price;

    /**
     * @var string
     */
    private $reservation_message;

    /**
     * @var int
     */
    private $category_id;

    /**
     * @var string
     */
    private $created_at;



    // Constructeur

    function __construct(array $data) {
        foreach ($data as $key => $value) {
            $method = 'set'.ucfirst($key);
            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }



    // Getters 

    public function getId_advert() { return $this -> id_advert; }
    public function getTitle() { return $this -> title; }
    public function getDescription() { return $this -> description; }
    public function getPostcode() { return $this -> postcode; }
    public function getCity() { return $this -> city; }
    public function getPrice() { return $this -> price; }
    public function getReservation_message() { return $this -> reservation_message; }
    public function getCategory_id() { return $this -> category_id; }
    public function getCreated_at() { return $this -> created_at; }




    // Setters 

    /**
     * @param int $id_advert
     */
    private function setId_advert(int $id_advert) { 
        $this -> id_advert = $id_advert; 
        return $this; 
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title) { 
        $this -> title = $title; 
        return $this; 
    
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description) { 
        $this -> description = $description; 
        return $this; 
    }

    /**
     * @param int $postcode
     */
    public function setPostcode(int $postcode) { 
        $this -> postcode = $postcode; 
        return $this;

    }

    /**
     * @param string $city
     */
    public function setCity(string $city) { 
        $this -> city = $city; 
        return $this; 
    }

    /**
     * @param string $price
     */
    public function setPrice(string $price) {
         $this -> price = $price; 
        return $this; 
    }

    /**
     * @param string $reservation_message
     */
    public function setReservation_message(string $reservation_message) {
         $this -> reservation_message = $reservation_message; 
        return $this; 
    }

    /**
     * @param int $category_id
     */
    public function setCategory_id(int $category_id) {
         $this -> category_id = $category_id; 
        return $this; 
    }

    /**
     * @param string $created_at
     */
    public function setCreated_at(string $created_at) {
         $this -> created_at = $created_at; 
        return $this; 
    }

}