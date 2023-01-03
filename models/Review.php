<?php

class Review{

    private $id_product;
    private $name_user;
    private $photo_user;
    private $stars;
    private $title;
    private $description;

    public function __construct(array $data)
    {
        $this->hydrate($data);
    }

    public function hydrate(array $data)
    {
        foreach ($data as $key => $value)
        {
            $method = 'set'.ucfirst($key);

            if(method_exists($this, $method))
            {
                $this->$method($value);
            }
        }
    }

    public function setIdProduct($id_product)
    {
        $this->id_product = $id_product;
    }

    public function setNameUser($name_user)
    {
        $this->name_user = $name_user;
    }

    public function setPhotoUser($photo_user)
    {
        $this->photo_user = $photo_user;
    }

    public function setStars($stars)
        {
           $this->stars = $stars;
        }
    
        public function setTitle($title)
        {
            $this->title = $title;
        }
    
        public function setDescription($description)
        {
            $this->description = $description;
        }
        
}