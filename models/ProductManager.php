<?php
class ProductManager extends Model
{
    public function getProducts()
    {
        return $this->getAll('products','Product');
    }

    public function getProduct($id)
    {
        return $this->getOne('products', $id, Product::class);
    }

    public function getProductReviews(Product $product){
        return $this->getAll('reviews', Review::class, ["id_product" => 1000]);
    }
}