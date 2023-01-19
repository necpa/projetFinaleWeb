<?php
class OrderItemManager extends Model
{
    public function getOrderItems()
    {
        return $this->getAll('OrderItems','OrderItem');
    }

    public function clearOrderItem($order_id)
    {
        $sql = "DELETE FROM orderitems WHERE order_id = " .'"'. $order_id .'"';
        $this->addToTable($sql);
    }

    public function getOrderItemsByOrderId($order_id)
    {
        return $this->getAll('OrderItems','OrderItem',['order_id' => $order_id]);
    }
}