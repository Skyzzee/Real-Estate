<?php

/**
 * Category
 */
class Category {

    // Propriétés de la Class Category 
    /**
     * @var int
     */
    private $id_category;

    /**
     * @var string
     */
    private $value;




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

    public function getId_category() { return $this -> id_category; }
    public function getValue() { return $this -> value; }




    // Setters

    /**
     * @param int $id_category
     */
    private function setId_category(int $id_category) { 
        $this -> id_category = $id_category; 
        return $this; 
    }

    /**
     * @param string $value
     */
    public function setValue(string $value) { 
        $this -> value = $value; 
        return $this; 
    }

}