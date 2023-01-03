<?php
define('URL', str_replace("index.php","",(isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[PHP_SELF]"));

// Charge le fichier Router.php
require_once('./controllers/Router.php');

$router = new Router();     // Instancie de la classe router
$router->routeReq();        // Request la route correspondante