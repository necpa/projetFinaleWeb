<?php
require_once('views/View.php');
class ControllerCommandes
{
    private $_view;
    private $_orderManager;
    private $_orderItemManager;
    private $_productManager;
    private $_deliveryAddresseManager;
    public function __construct($url)
    {
        if(isset($url) && count(array($url)) > 1)
        {
            throw new Exception('Page introuvable');
        }
        else
        {
            if (isset($_GET['order']))
            {
                $this->_orderManager = new OrderManager;
                $order = $this->_orderManager->getOrderById($_GET['order']);
                if(isset($_POST['submitEnvoie']))
                {
                    $this->_orderManager->modifyInTable('orders', Order::class, ['status' => 10], ['id' => $order->getId()]);
                    header('Location: index.php?url=commandes');
                }
                $this->_deliveryAddresseManager = new DeliveryAddresseManager;
                $deliveryAddresse = $this->_deliveryAddresseManager->getAddressById($order->getDeliveryAddId());
                $this->_orderItemManager = new OrderItemManager;
                $items = $this->_orderItemManager->getOrderItemsByOrderId($order->getId());
                $this->_productManager = new ProductManager;
                foreach ($items as $item)
                {
                    $products[$item->getProductId()] = ($this->_productManager->getProductsById(['id' => $item->getProductId()]))[0];
                }
                if($order->getStatus() == 2)
                {
                    $this->_view = new View('Commande');
                    $this->_view->generate(array('order' => $order, 'deliveryAddresse' => $deliveryAddresse, 'items' => $items, 'products' => $products));
                }
                else
                {
                    $this->_orderManager->deleteInTable('orders',$order->getId());
                    $this->_deliveryAddresseManager->deleteInTable('delivery_addresses',$deliveryAddresse->getId());
                    foreach($items as $item)
                    {
                        $this->_orderItemManager->deleteInTable('orderitems',$item->getId());
                    }
                    header('Location : index.php?url=commandes');
                }

            }
            else
            {
                if (isset($_SESSION['admin']))
                {
                    $this->_orderManager = new OrderManager();
                    if(isset($_POST['status']))
                        $status = $_POST['status'];
                    else
                        $status = 2;
                    $orders = $this->_orderManager->getOrderByStatus($status);
                }
                else
                {
                    $this->_orderManager = new OrderManager;
                    $orders = $this->_orderManager->getOrderByCustId($_SESSION['customer_id']); //On récupére la commande
                    $this->_orderItemManager = new OrderItemManager;
                    foreach ($orders as $order){
                        $orders_id = $order->getId();
                        //On récupére les OrderItems des différentes commande
                        //Je n'avais pas encore découvert la fonction arraymap que j'utilise dans "facture" et qui est trés pratique
                        $items[$orders_id] = $this->_orderItemManager->getOrderItemsByOrderId($orders_id);
                    }
                    $this->_productManager = new ProductManager;
                    foreach ($orders as $order){
                        for($i=0; $i <= count($items[$order->getId()])-1; $i++){
                            //On récupéretout les fiches produits des items
                            //De même, arraymap aurait permit de faire quelque chose de plus lisible
                            $products[$items[$order->getId()][$i]->getProductId()] = $this->_productManager->getProduct($items[$order->getId()][$i]->getProductId());
                        }
                    }
                }

                $this->_view = new View('Commandes');
                if (isset($_SESSION['admin']))
                {
                    if (count($orders) > 0)
                        $this->_view->generate(array('orders' => $orders, 'status' => $status));
                    else
                        $this->_view->generate();
                }
                else {
                    if (count($orders) > 0 && count($products) > 0){
                        //On envoie les données à la vue
                        $this->_view->generate(array('orders' => $orders, 'items' => $items ,'products' => $products));
                    }
                    else{
                        //Si il n'y a pas de commandes on envoie rien
                        $this->_view->generate();
                    }
                }
            }
        }
    }
}

