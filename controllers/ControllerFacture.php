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
            //On récupére l'order id dans l'url
            //Cela nous permet d'avoir accés à toutes les factures et non pas seulement celle d'apres le paiment
            $orderId = $_GET['order'] ?? null;
            //Si il y'a un id dans l'url on récupére l'order avec son id
            //Sinon on récupére la dernier order du customer
            $order = $orderId ? $this->_orderManager->getOrderById($orderId) : $this->_orderManager->getLastOrderByCustId((int)$_SESSION["customer_id"]);
            //On sécurise afin de ne pas avoir acces aux factures juste en mettant un id dans l'url
            if ($order->getCustomerId() != (int)$_SESSION["customer_id"]){
                throw new Exception('Page introuvable');
            }
            $this->_deliveryAddresseManager = new DeliveryAddresseManager;
            //On récupére l'adresse
            $delivery_address = $this->_deliveryAddresseManager->getAddressById($order->getDeliveryAddId());
            $this->_orderItemManager = new OrderItemManager;
            //On récupére les Items
            $orderItems = $this->_orderItemManager->getOrderItemsByOrderId($order->getId());
            $this->_productManager = new ProductManager;
            //Boucle sur chaque orderItem et prend l'id
            $orderProductIds = array_map(fn ($orderItem) => $orderItem->getProductId(), $orderItems);
            //On récupére les produits
            $products = $this->_productManager->getProductsById($orderProductIds);
            //Boucle sur chaque produit et prend l'id
            $array_ids_products = array_map(fn ($product) => $product->getId(), $products);
            $products = array_combine($array_ids_products, $products);
            //On a maintenant un tableau du type ["13" => "Product"]
            $date = date("d/m/Y");
            //On met dans cette variable le code htmlà envoyer dans le pdf
            $pdf_html = <<<EOT
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Facture Web4Shop</title>
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
            //On utilise la librairie Dompdf pour générer notre pdf a partir du html
            $dompdf = new Dompdf();
            $dompdf->loadHtml($pdf_html);
            $dompdf->setPaper('A4', 'portrait');
            $dompdf->render();
            $fichier = 'Facture Web4Shop ' . $orderId .'.pdf';//nom du fichier
            $dompdf->stream($fichier);//DL du fichier
        }
    }





}