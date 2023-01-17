<?php
require_once('views/View.php');
class ControllerFacture
{
    private $_view;
    private $_orderManager;
    private $_deliveryAddresseManager;
    public function __construct($url)
    {
        if(isset($url) && count(array($url)) > 1)
        {
            throw new Exception('Page introuvable');
        }
        else
        {
            $this->_orderManager = new OrderManager;
            $orders = $this->_orderManager->getOrderByCustId($_SESSION[]); //On récupére la commande
            $this->_deliveryAddresseManager = new DeliveryAddresseManager;
            foreach ($orders as $order){
                $delivery_add_id = $order->getDeliveryAddId();
            }
            $delivery_address = $this->_deliveryAddresseManager->getAddressById($delivery_add_id);
            $this->_view = new View('Facture');
            $this->_view->generate(array('order' => $order, 'delivery_adress' => $delivery_address));
        }
    }

}