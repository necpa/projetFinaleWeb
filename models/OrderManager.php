<?php
class ProductManager extends Model
{
    public function getOrders()
    {
        return $this->getAll('orders','Order');
    }
}