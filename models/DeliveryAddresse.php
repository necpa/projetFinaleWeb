<?php

class DeliveryAddresse
{
    private $_id;
    private $_firstname;
    private $_lastname;
    private $_add1;
    private $_add2;
    private $_city;
    private $_postcode;
    private $_phone;
    private $_email;

    public function __construct(array $data)
    {
        $this->hydrate($data);
    }

    public function hydrate(array $data)
    {
        foreach ($data as $key => $value)
        {
            $method = 'set'.str_replace(' ', '', ucwords(str_replace('_', ' ', $key))); //snakecase to camelcase

            if(method_exists($this, $method))
            {
                $this->$method($value);
            }
        }
    }

    public function setId($id)
    {
        $this->_id = $id;
    }

    public function setFirstname($firstname)
    {
        $this->_firstname = $firstname;
    }

    public function setLastname($lastname)
    {
        $this->_lastname = $lastname;
    }
    
    public function setAdd1($add1)
    {
        $this->_add1 = $add1; 
    }

    public function setAdd2($add2)
    {
        $this->_add2 = $add2 ; 
    }

    public function setCity($city)
    {
        $this->_city = $city;
    }

    public function setPostcode($postcode)
    {
        $this->_postcode = $postcode;
    }

    public function setPhone($phone)
    {
        $this->_phone = $phone;
    }

    public function setEmail($email)
    {
        $this->_email = $email;
    }

    public function getId()
    {
        return $this->_id;
    }
    
    public function getFirstname()
    {
        return $this->_firstname;
    }

    public function getLastname()
    {
        return $this->_lastname;
    }

    public function getAdd1()
    {
        return $this->_add1;
    }

    public function getAdd2()
    {
        return $this->_add2;
    }

    public function getCity()
    {
        return $this->_city;
    }

    public function getPostcode()
    {
        return $this->_postcode;
    }

    public function getPhone()
    {
        return $this->_phone;
    }

    public function getEmail()
    {
        return $this->_email;
    }
}