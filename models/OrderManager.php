<?php
class OrderManager extends Model
{
    public function getOrders()
    {
        return $this->getAll('orders','Order');
    }
    public function getOrderById($id)
    {
        if(isset($_SESSION['order_id'])){
            return $this->getAll('orders','Order', ["id" => $_SESSION['order_id']]);
        }
        else{
            return NULL;
        }

    }
}