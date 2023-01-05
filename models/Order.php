<?php

class Order
{

    private $_id;
    private $_customer_id;
    private $_register;
    private $_delivery_add_id;
    private $_payment_type;
    private $_date;
    private $_status;
    private $_session;
    private $_total;

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

    public function setCustomerId($customerId)
    {
        $this->_customer_id = $customerId;
    }

    public function setRegister($register)
        {
            $this->_register = $register;
        }
    
        public function setDeliveryAddId($delivery_add_id)
        {
            $this->_delivery_add_id = $delivery_add_id;
        }

        public function setPaymentType($payment_type)
        {
            $this->_payment_type = $payment_type;
        }

        public function setDate($date)
        {
            $this->_date = $date;
        }

        public function setStatus($status)
        {
            $this->_status = $status;
        }

        public function setSession($session)
        {
            $this->_session = $session;
        }

        public function setTotal($total)
        {
            $this->_total = $total;
        }
        
        public function getId()
        {
            return $this->_id;
        }

        public function getCustomerId()
        {
            return $this->_customer_id;
        }

        public function getRegister()
        {
            return $this->_register;
        }

        public function getDeliveryAddId()
        {
            return $this->_delivery_add_id;
        }

        public function getPaymentType()
        {
            return $this->_payment_type;
        }

        public function getDate()
        {
            return $this->_date;
        }

        public function getStatus()
        {
            return $this->_status;
        }

        public function getSession()
        {
            return $this->_session;
        }

        public function getTotal()
        {
            return $this->_total;
        }
}