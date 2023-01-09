<?php
require_once('views/View.php');
class ControllerProducts
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
            $this->reviews();
        }
    }
    private function reviews()
    {
        $productId = $_GET['id'] ?? null;
        if(!$productId || !((int)$productId > 0)){
            throw new Exception('No id in url.');
        }
        $this->_productManager = new ProductManager;
        $produit = $this->_productManager->getProduct($productId);
        if(!$produit){
            throw new Exception('Produit non trouvé.');
        }
        $reviews = $this->_productManager->getProductReviews($produit);
        // echo "<pre>" . print_r($reviews, true) . "</pre>";
        // $this->_reviewManager = new ReviewManager;
        // $reviews = $this->_reviewManager->getReview();
        $this->_view = new View('Products');
        $this->_view->generate(array('product' => $produit, 'reviews' => $reviews));
    }
}
?>