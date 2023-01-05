<?php
class CustomerManager extends Model
{
    public function getCustomers()
    {
        return $this->getAll('customers','Customer');
    }
}