<?php

class Category
{
    private $_id;
    private $_name;

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
        $id = (int)$id;

        if($id > 0)
        {
            $this->_id = $id;
        }
    }


    public function setName($name)
    {
        $name = (string)$name;
        $this->_name = $name;
    }



    public function getId()
    {
        return $this->_id;
    }

    public function getName()
    {
        return $this->_name;
    }


}