<?php
use Dompdf\Dompdf;
require_once('views/View.php');
require_once 'dompdf/autoload.inc.php';

class ControllerFacture
{
    private $_view;
    private $_orderManager;
    private $_deliveryAddresseManager;
    private $_orderItemManager;
    private $_productManager;
    public function __construct($url)
    {
        if(isset($url) && count(array($url)) > 1)
        {
            throw new Exception('Page introuvable');
        }
        else
        {
            $this->_orderManager = new OrderManager;
            $orderId = $_GET['order'] ?? null;
            $order = $orderId ? $this->_orderManager->getOrderById($orderId) : $this->_orderManager->getLastOrderByCustId((int)$_SESSION["customer_id"]);
            if ($order->getCustomerId() != (int)$_SESSION["customer_id"]){
                throw new Exception('Page introuvable');
            }
            $this->_deliveryAddresseManager = new DeliveryAddresseManager;
            $delivery_address = $this->_deliveryAddresseManager->getAddressById($order->getDeliveryAddId());
            $this->_orderItemManager = new OrderItemManager;
            $orderItems = $this->_orderItemManager->getOrderItemsByOrderId($order->getId());
            $this->_productManager = new ProductManager;
            $orderProductIds = array_map(fn ($orderItem) => $orderItem->getProductId(), $orderItems);//Boucle sur chaque orderItem et prend l'id
            $products = $this->_productManager->getProductsById($orderProductIds);
            $array_ids_products = array_map(fn ($product) => $product->getId(), $products);
            $products = array_combine($array_ids_products, $products);
            $date = date("d/m/Y");
            $pdf_html = <<<EOT
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Bootstrap demo</title>
        <style>
            table {
              border: 1px solid black;
              border-collapse: collapse;
            }
            thead tr th {
              border-bottom: 1px solid black;
            }
            thead tr th, tfoot tr td{
                border-right: 1px solid black;
            }
            tfoot tr td {
              border-top: 1px solid black;
            }
            
            th, td {
              padding: 10px;
            }
        </style>
    </head>
    <body>
        <div style="margin-bottom: 15px;">
            <div>{$delivery_address->getLastname()} {$delivery_address->getFirstname()}</div>
            <div>{$delivery_address->getAdd1()}</div>
            <div>{$delivery_address->getAdd2()}</div>
            <div>{$delivery_address->getPostCode()} {$delivery_address->getCity()}</div>
        </div>
        <div style="text-align: right; margin-bottom: 30px;">
            <div>ISIWeb4Shop</div>
            <div>111 1st Ave</div>
            <div>New York, NY 10016</div>
        </div>
        <div style="text-align: right; margin-bottom: 30px;">Le {$date}</div>
        <div style="font-weight: bold; margin-bottom: 30px; ">Facture n°{$order->getId()}</div>
        <table style="width: 100%;">
            <thead>
                <tr>
                    <th style="width: 100%;">Designation</th>
                    <th>Prix&nbsp;unitaire</th>
                    <th>Quantité</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
EOT;
            $prixFinal = 0;
            foreach($orderItems as $orderItem){
                $product = $products[$orderItem->getProductId()];
                $prixTotal = $product->getPrice() * $orderItem->getQuantity();
                $prixFinal += $prixTotal;
                $prixTotal = number_format($prixTotal, 2, ',', ' ');
                $prixProduct = number_format($product->getPrice(), 2, ',', ' ');
                $pdf_html .= <<<EOT
                <tr>
                    <td>{$product->getName()}</td>
                    <td style="text-align: right">{$prixProduct}&nbsp;€</td>
                    <td style="text-align: right">{$orderItem->getQuantity()}</td>
                    <td style="text-align: right">{$prixTotal}&nbsp;€</td>
                </tr>
EOT;
            }
            for($i = count($orderItems); $i <= 10; $i++){
                $pdf_html .= '<tr><td colspan="4"></td></tr>';
            }
            $prixFinal = number_format($prixFinal, 2, ',', ' ');
            $pdf_html .= <<<EOT
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3" style="text-align: right; font-weight: bold">Total</td>
                    <td style="text-align: right; font-weight: bold">{$prixFinal}&nbsp;€</td>
                </tr>
            </tfoot>
        </table>
    </body>
</html>
EOT;



            $dompdf = new Dompdf();
            $dompdf->loadHtml($pdf_html);
            $dompdf->setPaper('A4', 'portrait');
            $dompdf->render();
            $fichier = 'Facture Web4Shop ' . $orderId .'.pdf';
            $dompdf->stream($fichier);
        }


    }





}