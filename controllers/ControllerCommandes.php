<?php
require_once('views/View.php');
class ControllerCommandes
{
    private $_view;
    private $_orderManager;
    private $_orderItemManager;

    private $_productManager;
    public function __construct($url)
    {
        if(isset($url) && count(array($url)) > 1)
        {
            throw new Exception('Page introuvable');
        }
        else
        {
            $this->_orderManager = new OrderManager;
            $orders = $this->_orderManager->getOrderByCustId($_SESSION['customer_id']); //On récupére la commande
            $this->_orderItemManager = new OrderItemManager;
            foreach ($orders as $order){
                $orders_id = $order->getId();
                $items[$orders_id] = $this->_orderItemManager->getOrderItemsByOrderId($orders_id);
            }
            $this->_productManager = new ProductManager;
            foreach ($orders as $order){
                for($i=0; $i <= count($items[$order->getId()])-1; $i++){
                    $products[$items[$order->getId()][$i]->getProductId()] = $this->_productManager->getProduct($items[$order->getId()][$i]->getProductId());
                }
            }
        }

        $this->_view = new View('Commandes');
        if (count($orders) > 0 && count($products) > 0){
            $this->_view->generate(array('orders' => $orders, 'items' => $items ,'products' => $products));
        }
        else{
            $this->_view->generate();
        }
    }
}

