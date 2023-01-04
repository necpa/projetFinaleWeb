<?php
require_once('views/View.php');
class ControllerBiscuits
{
    private $_productManager;
    private $_view;

    public function __construct($url)
    {
        $this->_productManager = new ProductManager;
        $products = $this->_productManager->getProducts();
        $this->_view = new View('Biscuits');
        $this->_view->generate(array('products' => $products));
    }
}
?>