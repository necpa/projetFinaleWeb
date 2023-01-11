<?php
class CustomerManager extends Model
{
    public function getCustomers()
    {
        return $this->getAll('customers','Customer');
    }

    public function getOneCustomer($id){
        $customer = $this->getOne("customers", $id, customer::class);
        return $customer;
    }
}