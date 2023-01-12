<?php
require_once('views/View.php');
class ControllerPaiment
{
    private $_view;

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


        $this->_view = new View('Paiment');
        $this->_view->generate();
    }
}
?>