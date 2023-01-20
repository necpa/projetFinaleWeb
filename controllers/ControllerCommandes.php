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
                //On récupére les OrderItems des différentes commande
                //Je n'avais pas encore découvert la fonction arraymap que j'utilise dans "facture" et qui est trés pratique
                $items[$orders_id] = $this->_orderItemManager->getOrderItemsByOrderId($orders_id);
            }
            $this->_productManager = new ProductManager;
            foreach ($orders as $order){
                for($i=0; $i <= count($items[$order->getId()])-1; $i++){
                    //On récupéretout les fiches produits des items
                    //De même, arraymap aurait permit de faire quelque chose de plus lisible
                    $products[$items[$order->getId()][$i]->getProductId()] = $this->_productManager->getProduct($items[$order->getId()][$i]->getProductId());
                }
            }
        }

        $this->_view = new View('Commandes');
        if (count($orders) > 0 && count($products) > 0){
            //On envoie les données à la vue
            $this->_view->generate(array('orders' => $orders, 'items' => $items ,'products' => $products));
        }
        else{
            //Si il n'y a pas de commandes on envoie rien
            $this->_view->generate();
        }
    }
}

