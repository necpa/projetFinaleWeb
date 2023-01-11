<?php
require_once('views/View.php');
class ControllerProfil
{
    private $_view;
    private $_CustomerManager;

    public function __construct($url)
    {
        $this->_CustomerManager = new CustomerManager;
        if(!isset($_SESSION['login_id'])) {
            throw new Exception('Customer non trouvé.');
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && (isset($_POST['modifyCustomer']))){
            if (isset($_POST["forname"])){
                $forname = $_POST["forname"];
            }
            if (isset($_POST["surname"])){
                $surname = $_POST["surname"];
            }
            if (isset($_POST["addone"])){
                $addone = $_POST["addone"];
            }
            if (isset($_POST["addtwo"])){
                $addtwo = $_POST["addtwo"];
            }
            if (isset($_POST["addthree"])){
                $addthree = $_POST["addthree"];
            }
            if (isset($_POST["postcode"])){
                $postcode = $_POST["postcode"];
            }
            if (isset($_POST["phone"])){
                $phone = $_POST["phone"];
            }
            if (isset($_POST["email"])){
                $email = $_POST["email"];
            }
            $this->_CustomerManager->modifyInTable("customers", customers::class,["forname" => $forname , "surname"  => $surname, "add1" => $addone, "add2" => $addtwo, "add3" => $addthree, "postcode" => $postcode, "phone" => $phone, "email" => $email],["id" => $_SESSION['login_id']]);
        }

        $customer = $this->_CustomerManager->getOneCustomer($_SESSION['login_id']);

        $this->_view = new View('Profil');
        $this->_view->generate(array('customer' => $customer));
    }
}
?>