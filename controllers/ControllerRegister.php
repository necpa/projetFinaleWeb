<?php

require_once('views/View.php');

class ControllerRegister
{

    private $_view;
    private $_loginManager;

    public function __construct($url)
    {
        if (isset($_REQUEST['username']) && isset($_REQUEST['password']) && isset($_REQUEST['email']))
        {
	        $username = stripslashes($_REQUEST['username']);    // récupérer le nom d'utilisateur et supprimer les antislashes ajoutés par le formulaire
	        $password = stripslashes($_REQUEST['password']);    // récupérer le mot de passe et supprimer les antislashes ajoutés par le formulaire
            $email = stripslashes($_REQUEST['email']);
            $this->_loginManager = new LoginManager;
            $usernameAlreadyExists = $this->_loginManager->usernameAlreadyExists($username);
            if($usernameAlreadyExists)
            {
                $this->_view = new View('Register');
                $this->_view->generate(array('usernameAlreadyExists' => $usernameAlreadyExists));
            }
            else
            {
                $this->_loginManager->newLogin($username,$password,$email);
                $this->_view = new View('Acceuil');
                $this->_view->generate();
            }
        }
        else
        {
            $this->_view = new View('Register');
            $this->_view->generate();
        }
    }
}