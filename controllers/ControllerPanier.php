<?php
require_once('views/View.php');
class ControllerPanier
{

    private $_productManager;
    private $_view;

    public function __construct($url)
    {
        //Notre panier se présente sous cette forme en variable de session
        //$_SESSION = ["panier" => [ "24" => ['productId' => 24, 'productQty' => 2], "8" => ['productId' => 8, 'productQty' => 1] ]];
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && (isset($_POST['submitQuantite']) || isset($_POST['suprQuantite']))) { //Si un des 2 boutons est activé
            if(isset($_POST["modifierQuantite"]) && is_iterable($_POST["modifierQuantite"])){
                //On modifie la quantité dnas le panier
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
        //Quand on arrive sur la page on crée notre panier
        $panier = isset($_SESSION["panier"]) && is_iterable($_SESSION["panier"]) && count($_SESSION["panier"]) > 0 ? $_SESSION["panier"] : [];
        $this->_productManager = new ProductManager;
        //On récupére la liste des produits du panier
        $products = $this->_productManager->getProductsById(array_keys($panier));
        if (!isset($_SESSION["panier"])){
            $_SESSION["panier"]=[];
        }
        else{
            if (!isset($_SESSION["prixTotal"])) {
                $_SESSION["prixTotal"] = 0;
            }
            else{
                if (count($_SESSION["panier"]) == 0){ //Si pas d'éléments prixTotal = 0
                    $_SESSION["prixTotal"] = 0;
                }
                else{
                    $_SESSION["prixTotal"] = 0;
                    //On met à jour le prix total
                    foreach ($products as $product) {
                        $_SESSION["panier"][$product->getId()]["price"] = $product->getPrice();
                        $_SESSION["prixTotal"] += $_SESSION["panier"][$product->getId()]["price"] * $_SESSION["panier"][$product->getId()]["productQty"];
                    }
                }
            }
        }
        $this->_view = new View('Panier');
        if (isset($_SESSION['order_id'])){
            unset($_SESSION['order_id']);
        }
        $this->_view->generate(array('products' => $products, 'panierProducts' => $panier));
    }

}
?>