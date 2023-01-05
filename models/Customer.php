<?php

class Customer
{

    private $_id;
    private $_forname;
    private $_surname;
    private $_add1;
    private $_add2;
    private $_add3;
    private $_postcode;
    private $_phone;
    private $_email;
    private $_registered;

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

    public function setForname($forname)
    {
        $this->_forname = $forname;
    }

    public function setSurname($surname)
    {
        $this->_surname = $surname;
    }
    
    public function setAdd1($add1)
    {
        $this->_add1 = $add1; 
    }

    public function setAdd2($add2)
    {
        $this->_add2 = $add2 ; 
    }

    public function setAdd3($add3)
    {
        $this->_add3 = $add3;
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

    public function setRegistered($registered)
    {
        $this->_registered = $registered;
    }

    public function getId()
    {
        return $this->_id;
    }
    
    public function getForname()
    {
        return $this->_forname;
    }

    public function getSurname()
    {
        return $this->_surname;
    }

    public function getAdd1()
    {
        return $this->_add1;
    }

    public function getAdd2()
    {
        return $this->_add2;
    }

    public function getAdd3()
    {
        return $this->_add3;
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

    public function getRegistered()
    {
        return $this->_registered;
    }
}