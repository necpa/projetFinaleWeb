<?php
require_once('views/View.php');

class Router
{
    private $_ctrl;
    private $_view;

    public function routeReq()
    {
        try
        {
            session_start();
            spl_autoload_register(function($class){
                require_once('models/'.$class.'.php');
            });

            $url = ''; //url = action
            
            $controllerFile = 'controllers/ControllerAcceuil.php';
            $controllerClass = "ControllerAcceuil";

            if(isset($_GET['url']))
            {
                $url = explode('/', filter_var($_GET['url'], FILTER_SANITIZE_URL));
                $controller = ucfirst(strtolower($url[0]));
                $controllerClass = "Controller" . $controller;
                $controllerFile = "controllers/" . $controllerClass . ".php";

                if(!file_exists($controllerFile)){
                    throw new Exception('Page introuvable');
                }
            }
           
            require_once($controllerFile);
            $this->_ctrl = new $controllerClass($url);
        }
        catch (Exception $e)
        {
            $errorMSG = $e->getMessage();
            $this->_view =  new View('Error');
            $this->_view->generate(array('errorMSG' => $errorMSG));
        }
    }
}