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
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $note=$_POST['note'];
            $prenom = $_POST['prenom'];
            $genre = $_POST['genre'];
            $titre = $_POST['titre'];
            $commentaire = $_POST['commentaire'];
            $compteur=0;//On regarde si il y'a déjà un commentaire avec le prénom dans ce produit
            foreach ($reviews as $review) {
                    if ($prenom==$review->getNameUser()){
                        $compteur+=1;
                    }
            }
            if ($compteur == 0){
                $sql = "INSERT INTO `reviews` VALUES (" . $productId . ",'" . $prenom . "','" . $genre . "'," . $note . ",'" . $titre . "','" . $commentaire . "');";
                $this->_productManager->addToTable($sql);
            }
        }
        $this->_view = new View('Products');
        $this->_view->generate(array('product' => $produit, 'reviews' => $reviews));

    }
}
?>