<?php

require_once('views/View.php');

class ControllerAdresse 
{

    private $_view;
    private $_customerManager;
    private $_deliveryAddresseManager;
    private $_orderManager;
    private $_orderItemManager;
    
    public function __construct($url)
    {
        if($_SERVER['REQUEST_METHOD'] === 'POST')
        {
            $this->_deliveryAddresseManager = new DeliveryAddresseManager;
            $addresse_id = $this->_deliveryAddresseManager->maxId('delivery_addresses') + 1;
            $this->_customerManager = new CustomerManager;
            if(isset($_POST['submitChoixAdresse']))
            {
                $customer_id = $_SESSION['customer_id'];
                $registered = 1;                
                if($_POST['customer_address'] == "0")
                {
                    $customer = $this->_customerManager->getOneCustomer($_SESSION['customer_id']);
                    $req = ["id" => $addresse_id, "firstname" => $customer->getForname(), "lastname" => $customer->getSurname(),
                     "add1" => $customer->getAdd1(), "add2" => $customer->getAdd2(), "city" => $customer->getAdd3(),
                     "postcode" => $customer->getPostcode(), "phone" => $customer->getPhone(), "email" => $customer->getEmail()];
                }
                else
                {
                    $firstname = $_POST['prenom'];
                    $lastname = $_POST['nom'];
                    $add1 = $_POST['add1'];
                    $add2 = $_POST['add2'];
                    $city = $_POST['add3'];
                    $postcode = $_POST['postcode'];
                    $phone = $_POST['phone'];
                    $email = $_POST['email'];
                    $req = ["id" => $addresse_id, "firstname" => $firstname, "lastname" => $lastname,
                     "add1" => $add1, "add2" => $add2, "city" => $city,
                     "postcode" => $postcode, "phone" => $phone, "email" => $email];
                }
            }
            else
            {
                $customer_id = $this->_customerManager->maxId('customers') + 1;
                $firstname = $_POST['prenom'];
                $lastname = $_POST['nom'];
                $add1 = $_POST['add1'];
                $add2 = $_POST['add2'];
                $city = $_POST['add3'];
                $postcode = $_POST['postcode'];
                $phone = $_POST['phone'];
                $email = $_POST['email'];
                $registered = 0;
                $req = ["id" => $customer_id, "forname" => $firstname, "surname" => $lastname,
                    "add1" => $add1, "add2" => $add2, "add3" => $city,
                    "postcode" => $postcode, "phone" => $phone, "email" => $email, "registered" => "0"];
                $this->_customerManager->addToTableColumn('customers',$req);
                $req = ["id" => $addresse_id, "firstname" => $firstname, "lastname" => $lastname,
                 "add1" => $add1, "add2" => $add2, "city" => $city,
                 "postcode" => $postcode, "phone" => $phone, "email" => $email];
            }
            $this->_deliveryAddresseManager->addToTableColumn('delivery_addresses', $req);
            $this->_orderManager = new OrderManager;
            if(isset($_SESSION['order_id']))
            {
                $date = date('Y-m-d');
                $order_id = $_SESSION['order_id'];
                $session = session_id();
                $this->_orderManager->modifyInTable('orders', Order::class, ['date' => $date,'delivery_add_id' => $addresse_id, 'status' => '1', 'session' => $session],['id' => $order_id]);
            }
            else
            {
                $order_id = $this->_orderManager->maxId('orders') + 1;
                $date = date('Y-m-d');
                $session = session_id();
                $total = $_SESSION['prixTotal'];
                $cond = ['id' => $order_id,'customer_id' => $customer_id,'registered' => $registered, 'date' => $date, 'status' => '1','delivery_add_id' => $addresse_id, 'session' => $session, 'total' => $total];
                $this->_orderManager->addToTableColumn('orders', $cond);
            }
            $_SESSION['order_id'] = $order_id;
            $this->_orderItemManager = new OrderItemManager;
            $this->_orderItemManager->clearOrderItem($order_id);
            foreach($_SESSION['panier'] as $product)
            {
                $orderItems_id = $this->_orderManager->maxId('orderitems') + 1;
                $product_id = $product['productId'];
                $quantity = $product['productQty'];
                $cond = ['id' => $orderItems_id, 'order_id' => $order_id, 'product_id' => $product_id, 'quantity' => $quantity];
                $this->_orderManager->addToTableColumn('orderitems', $cond);
            }
            header('Location: index.php?url=paiment');
            
        }
        else
        {
            $this->_customerManager = new CustomerManager;
            if(isset($_SESSION['is_log']))
            {
                $customer = $this->_customerManager->getOneCustomer($_SESSION['customer_id']);
                if (isset($customer))
                {
                    $data = ['customer' => $customer];
                }
                else
                    $data = [];
            }
            else
                $data =[];
            $this->_view = new View('Adresse');
            $this->_view->generate($data);
        }
    }
}