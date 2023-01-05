<?php
require_once('views/View.php');
class ControllerFruitsSecs
{
    private $_productManager;
    private $_view;

    public function __construct($url)
    {
        $this->_productManager = new ProductManager;
        $products = $this->_productManager->getProducts();
        $this->_view = new View('FruitsSecs');
        $this->_view->generate(array('products' => $products));
    }
}
?>