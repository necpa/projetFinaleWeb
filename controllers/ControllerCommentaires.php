<?php
require_once('views/View.php');
class ControllerCommentaires
{
    private $_reviewManager;
    private $_view;

    public function __construct($url)
    {
        if(isset($url) && count(array($url)) > 1)
        {
            throw new Exception('Page introuvable');
        }
        else
        {
            $this->reviews();
        }
    }
    private function reviews()
    {
        $this->_reviewManager = new ReviewManager;
        $reviews = $this->_reviewManager->getReview();
        $this->_view = new View('Commentaires');
        $this->_view->generate(array('reviews' => $reviews));
    }
}
?>