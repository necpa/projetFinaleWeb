<?php

class Product
{
    private $_id;
    private $_cat_id;
    private $_name;
    private $_description;
    private $_image;
    private $_price;
    private $_quantity;

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

    public function setId($id)
    {
        $id = (int)$id;

        if($id > 0)
        {
            $this->_id = $id;
        }
    }

    public function setCatId($cat_id)
    {
        $cat_id = (int)$cat_id;
        $this->_cat_id = $cat_id;
    }

    public function setName($name)
    {
        $name = (string)$name;
        $this->_name = $name;
    }

    public function setDescription($description)
    {
        $description = (string)$description;
        $this->_description = $description;
    }

    public function setImage($image)
    {
        $image = (string)$image;
        $this->_image = $image;
    }

    public function setPrice($price)
    {
        $price = (float)$price;
        $this->_price = $price;
    }

    public function setQuantity($quantity)
    {
        $quantity = (int)$quantity;
        $this->_quantity = $quantity;
    }

    public function getId()
    {
        return $this->_id;
    }

    public function getCatId()
    {
        return $this->_cat_id;
    }

    public function getName()
    {
        return $this->_name;
    }

    public function getDescription()
    {
        return $this->_description;
    }
    
    public function getImage()
    {
        return $this->_image;
    }

    public function getPrice()
    {
        return $this->_price;
    }

    public function getQuantity()
    {
        return $this->_quantity;
    }
}