<?php

class Review{

    private $_id_product;
    private $_name_user;
    private $_photo_user;
    private $_stars;
    private $_title;
    private $_description;

    public function __construct(array $data)
    {
        $this->hydrate($data);
    }

    public function hydrate(array $data)
    {
        foreach ($data as $key => $value)
        {
            $method = 'set'.str_replace(' ', '', ucwords(str_replace('_', ' ', $key)));;

            if(method_exists($this, $method))
            {
                $this->$method($value);
            }
        }
    }

    public function setIdProduct($id_product)
    {
        $this->_id_product = $id_product;
    }

    public function setNameUser($name_user)
    {
        $this->_name_user = $name_user;
    }

    public function setPhotoUser($photo_user)
    {
        $this->_photo_user = $photo_user;
    }

    public function setStars($stars)
        {
           $this->_stars = $stars;
        }
    
        public function setTitle($title)
        {
            $this->_title = $title;
        }
    
        public function setDescription($description)
        {
            $this->_description = $description;
        }

        public function getIdProduct(){
            return $this->_id_product;
        }

        public function getNameUser(){
            return $this->_name_user;
        }

        public function getPhotoUser(){
            return $this->_photo_user;
        }

        public function getStars(){
            return $this->_stars;
        }
        
        public function getTitle(){
            return $this->_title;
        }
        
        public function getDescription(){
            return $this->_description;
        }
        
}