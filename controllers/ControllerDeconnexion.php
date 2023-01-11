<?php

require_once('views/View.php');

class ControllerDeconnexion
{

    private $_orderManager;

    public function __construct($url)
    {
        if(isset($_SESSION['is_log']))
        {
            $customer_id = $_SESSION['customer_id'];
            if(isset($_SESSION['panier']))
                if($_SESSION['panier'] != [])
                {
                    $this->_orderManager = new OrderManager;
                    if(isset($_SESSION['order_id']))
                    {
                        $date = date('Y-m-d');
                        $this->_orderManager->modifyInTable('orders', Order::class, ['date' => $date],['id' => $_SESSION['order_id']]);
                    }
                    else
                    {
                        $order_id = $this->_orderManager->maxId('orders') + 1;
                        $date = date('Y-m-d');
                        $session = session_id();
                        $total = $_SESSION['prixTotal'];
                        $cond = ['id' => $order_id,'customer_id' => $customer_id,'registered' => '1', 'date' => $date, 'status' => '0', 'session' => $session, 'total' => $total];
                        $this->_orderManager->addToTableColumn('orders', $cond);
                    }
                    foreach($_SESSION['panier'] as $product)
                        {
                            $orderItems_id = $this->_orderManager->maxId('orderitems') + 1;
                            $product_id = $product['productId'];
                            $quantity = $product['productQty'];
                            $cond = ['id' => $orderItems_id, 'order_id' => $order_id, 'product_id' => $product_id, 'quantity' => $quantity];
                            $this->_orderManager->addToTableColumn('orderitems', $cond);
                        }
                }
            session_destroy();
        }
        header('Location: index.php');
    }
}