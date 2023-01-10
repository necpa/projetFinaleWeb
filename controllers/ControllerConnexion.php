<?php

require_once('views/View.php');

class ControllerConnexion
{

    private $_view;
    private $_loginManager;
    private $_customerManager;

    public function __construct($url)
    {
        if (isset($_REQUEST['username']) && isset($_REQUEST['password']))
        {
	        $username = stripslashes($_REQUEST['username']);    // récupérer le nom d'utilisateur et supprimer les antislashes ajoutés par le formulaire
	        $password = stripslashes($_REQUEST['password']);    // récupérer le mot de passe et supprimer les antislashes ajoutés par le formulaire
            $this->_loginManager = new LoginManager;
            $is_log = $this->_loginManager->login($username,$password);
            if ($is_log)
            {
                $this->_view = new View('Acceuil');
                $this->_view->generate();
            }
            else
            {
                $this->_view = new View('Connexion');
                $this->_view->generate(["is_log" => $is_log]);
            }
        }
        else
        {
            $this->_view = new View('Connexion');
            $this->_view->generate();
        }   
    }
}
?>