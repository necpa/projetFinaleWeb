<?php
require_once('views/View.php');
class ControllerCategories
{
    private $_categoryManager;
    private $_view;

    public function __construct($url)
    {
        //Si il y'a un cat dans l'url on renvoie à la page correspondante, sinon on renvoie à la page cat=1
        $catId = $_GET['cat'] ?? 1;
        if(!$catId || !((int)$catId > 0)){
            throw new Exception('No cat in url.');
        }
        $this->_categoryManager = new CategoryManager;
        //On récupére la catégorie associée à l'id
        $category = $this->_categoryManager->getCategory($catId);
        if(!$category) {
            throw new Exception('Catégorie non trouvé.');
        }
        //On récupére es prodits de cette catégorie
        $products = $this->_categoryManager->getCategoryProducts($category);
        $this->_view = new View('Categories');
        //On envoie tout ça à la vue
        $this->_view->generate(array('products' => $products,'category' => $category));
    }
}
?>