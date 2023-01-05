<?php

class OrderItem
{

    private $_id;
    private $_order_id;
    private $_product_id;
    private $_quantity;

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

    public function setOrderId($orderId)
    {
        $this->_order_id = $orderId;
    }

    public function setProductId($productId)
    {
        $this->_product_id = $productId;
    }

    public function setQuantity($quantity)
    {
        $this->_quantity = $quantity;
    }

    public function getId()
    {
        return $this->_id;
    }

    public function getOrderId()
    {
        return $this->_order_id;
    }

    public function getProductId()
    {
        return $this->_product_id;
    }

    public function getQuantity()
    {
        return $this->_quantity;
    }
}