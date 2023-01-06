<?php
class CategoryManager extends Model
{
    public function getCategories()
    {
        return $this->getAll('categories',Category::class);
    }

    public function getCategory($id)
    {
        return $this->getOne('categories', $id, Category::class);
    }

    public function getCategoryProducts(Category $category){
        return $this->getAll('products', Product::class, ["cat_id" => $category->getId()]);
    }
}