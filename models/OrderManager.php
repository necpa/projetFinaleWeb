<?php
class OrderManager extends Model
{
    public function getOrders()
    {
        return $this->getAll('orders','Order');
    }
    public function getOrderById($id)
    {
        return $this->getAll('orders',Order::class, ["id" => $id]);
    }
    public function getOrderByCustId($id)
    {
        return $this->getAll('orders',Order::class, ["customer_id" => $id]);
    }
}