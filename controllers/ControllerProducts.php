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
        //On affiche la page d'un produit transmis dans l'url
        $productId = $_GET['id'] ?? null;
        if(!$productId || !((int)$productId > 0)){
            throw new Exception('No id in url.');
        }
        $this->_productManager = new ProductManager;
        $produit = $this->_productManager->getProduct($productId);
        if(!$produit){
            throw new Exception('Produit non trouvé.');
        }
        //On récupére les commentaires du produit
        $reviews = $this->_productManager->getProductReviews($produit);
        //Formulaire d'ajout de commentaire :
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
            $note=$_POST['note'];
            $prenom = $_POST['prenom'];
            $genre = $_POST['genre'];
            $titre = $_POST['titre'];
            $commentaire = $_POST['commentaire'];
            $compteur=0;//On regarde si il y'a déjà un commentaire avec le prénom dans ce produit (ça aurait été mieux de faire avec login_id mais on en était pas encore là)
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
        //Formulaire d'ajout au panier :
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submitQty'])) {
            $qty = $_POST['qty']; //On récupére la quantité à ajouter au panier
            $_SESSION["panier"][$productId]=[]; //On rentre les valeurs dans la variable de session
            $_SESSION["panier"][$productId] = ["productId" => $productId];
            $_SESSION["panier"][$productId]["productQty"] = $qty;
            // $_SESSION = ["panier" => [ "24" => ['productId' => 24, 'productQty' => 2], "8" => ['productId' => 8, 'productQty' => 1] ]];
            $_SESSION["prixTotal"] = 0;
            $products = $this->_productManager->getProductsById(array_keys($_SESSION['panier']));
            foreach ($products as $product) {
                $_SESSION["panier"][$product->getId()]["price"] = $product->getPrice();
                $_SESSION["prixTotal"] += $_SESSION["panier"][$product->getId()]["price"] * $_SESSION["panier"][$product->getId()]["productQty"];
            }
        }
        $this->_view = new View('Products');
        $this->_view->generate(array('product' => $produit, 'reviews' => $reviews));

    }
}
?>