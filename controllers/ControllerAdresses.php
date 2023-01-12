<?php
require_once('views/View.php');
class ControllerAdresses
{
    private $_view;

    public function __construct($url)
    {
        $this->_view = new View('Adresses');
        $this->_view->generate();
    }
}

?>
