<?php
class ProductManager extends Model
{
    public function getProducts()
    {
        return $this->getAll('products','Product');
    }
}