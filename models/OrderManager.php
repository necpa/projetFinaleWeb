<?php
class OrderManager extends Model
{
    public function getOrders()
    {
        return $this->getAll('orders','Order');
    }
}