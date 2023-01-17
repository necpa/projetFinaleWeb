<?php
require_once('views/View.php');
class ControllerFacture
{
    private $_view;
    private $_orderManager;
    public function __construct($url)
    {
        if(isset($url) && count(array($url)) > 1)
        {
            throw new Exception('Page introuvable');
        }
        else
        {
            $this->_orderManager = new OrderManager;
            $order = $this->_orderManager->getOrderById($_SESSION['order_id']); //On récupére la commande
            $this->_view = new View('Facture');
            $this->_view->generate(array('order' => $order));
        }
    }

}