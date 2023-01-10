<?php
require_once('views/View.php');
class ControllerPanier
{

    private $_productManager;
    private $_view;

    public function __construct($url)
    {
        //$_SESSION = ["panier" => [ "24" => ['productId' => 24, 'productQty' => 2], "8" => ['productId' => 8, 'productQty' => 1] ]];
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && (isset($_POST['submitQuantite']) || isset($_POST['suprQuantite']))) { //Si un des 2 boutons est activé
            if(isset($_POST["modifierQuantite"]) && is_iterable($_POST["modifierQuantite"])){
                foreach ($_POST["modifierQuantite"] as $productId => $productQuantity){
                    if ($productQuantity == 0){
                        unset($_SESSION["panier"][$productId]);
                    }
                    else{
                        if(!isset($_SESSION["panier"]) || !is_iterable($_SESSION["panier"])){
                            $_SESSION["panier"] = [];
                        }
                        if(!isset($_SESSION["panier"][$productId])){
                            $_SESSION["panier"][$productId] = ["productId" => $productId];
                        }
                        $_SESSION["panier"][$productId]["productQty"] = $productQuantity;
                    }
                }
            }
            if (isset($_POST['suprQuantite'])) { //Si on clique sur le bouton supprimer
                unset($_SESSION["panier"][$productId]); //On enleve l'élément du panier
            }
        }



        $panier = isset($_SESSION["panier"]) && is_iterable($_SESSION["panier"]) && count($_SESSION["panier"]) > 0 ? $_SESSION["panier"] : [];
        $this->_productManager = new ProductManager;
        $products = $this->_productManager->getProductsById(array_keys($panier));
        $this->_view = new View('Panier');
        $this->_view->generate(array('products' => $products, 'panierProducts' => $panier));
    }

}
?>