<?php

use Dompdf\Dompdf;

require_once 'dompdf/autoload.inc.php';

// instantiate and use the dompdf class
$dompdf = new Dompdf();
$dompdf->loadHtml('hello world');

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'portrait');

// Render the HTML as PDF
$dompdf->render();

$fichier = 'facture-web4shop.pdf';
//Output the generated PDF to Browser
//$dompdf->stream($fichier);

?>