<?php
require_once('views/View.php');
class ControllerProduits
{
    private $_categoryManager;
    private $_view;

    public function __construct($url)
    {
        $catId = $_GET['cat'] ?? 1;
        if(!$catId || !((int)$catId > 0)){
            throw new Exception('No cat in url.');
        }
        $this->_categoryManager = new CategoryManager;
        $category = $this->_categoryManager->getCategory($catId);
        if(!$category) {
            throw new Exception('Catégorie non trouvé.');
        }
        $products = $this->_categoryManager->getCategoryProducts($category);
        $this->_view = new View('Products');
        $this->_view->generate(array('products' => $products,'category' => $category));
    }
}
?>