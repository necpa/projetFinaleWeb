<?php
require_once('views/View.php');
class ControllerPaiment
{
    private $_view;
    private $_productManager;
    private $_orderManager;

    public function __construct($url)
    {
        //On assigne à $_SESSION["payment_type"] le moyen de paiment utilisé
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && (isset($_POST['paimentCheque']) || isset($_POST['paimentPaypal']))) { //Si un des 2 boutons est activé
            if (isset($_POST['paimentCheque'])){
                if (!isset($_SESSION["payment_type"])){
                    $_SESSION["payment_type"]="cheque";
                }
            }
            elseif (isset($_POST['paimentPaypal'])){
                if (!isset($_SESSION["payment_type"])){
                    $_SESSION["payment_type"]="paypal";
                }
            }
        }
        //Si le bouton changer paiment est activé
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && (isset($_POST['retourPaiment']))){
            unset($_SESSION["payment_type"]);
        }
        //Si l'utilisateur valide le paiment
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['validerCommande'])){
            $_SESSION["confirm_payment"] = true;
            foreach (array_keys($_SESSION['panier']) as $product_id)
            {
                $this->_productManager = new ProductManager;
                $product = $this->_productManager->getProduct((int)$product_id);
                $productQty = $product->getQuantity() - $_SESSION['panier'][$product_id]['productQty'];
                $this->_productManager->modifyInTable('products', Product::class, ['quantity' => (int)$productQty], ['id' => (int)$product_id]);
            }
            unset($_SESSION['panier']);
            $date = date('Y-m-d');
            $this->_orderManager = new OrderManager;
            $this->_orderManager->modifyInTable('orders', Order::class, ['date' => $date,'payment_type' => $_SESSION['payment_type'], 'status' => 2, 'session' => session_id()],['id' => $_SESSION['order_id']]);
        }

        $this->_view = new View('Paiment');
        $this->_view->generate();
    }
}
?>