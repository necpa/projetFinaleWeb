<?php
require_once('views/View.php');
class ControllerAcceuil
{
    private $_productManager;
    private $_view;

    public function __construct($url)
    {
        if(isset($url) && count(array($url)) > 1)
        {
            throw new Exception('Page introuvable');
        }
        else
        {
            $this->_productManager = new ProductManager;
            //On récupére tout les produits qu'on envoie à la vue
            $products = $this->_productManager->getProducts();
            $this->_view = new View('Acceuil');
            $this->_view->generate(array('products' => $products));
        }
    }
}