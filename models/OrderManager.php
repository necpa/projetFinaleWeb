<?php
class OrderManager extends Model
{
    public function getOrders()
    {
        return $this->getAll('orders','Order');
    }
    public function getOrderById($id)
    {
        return $this->getOne('orders', $id, Order::class);
    }
    public function getOrderByCustId($customer_id)
    {
        return $this->getAll('orders',Order::class, ["customer_id" => $customer_id]);
    }

    public function getLastOrderByCustId($id)
    {
        $orders = $this->getOrderByCustId($id);
        if (count($orders) > 0){
            return $orders[count($orders) - 1];
        }
        return null;
    }
}