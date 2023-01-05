<?php
class OrderItemManager extends Model
{
    public function getOrderItems()
    {
        return $this->getAll('OrderItems','OrderItem');
    }
}