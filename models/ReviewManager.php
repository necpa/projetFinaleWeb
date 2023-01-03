<?php
class ProductManager extends Model
{
    public function getReview()
    {
        return $this->getAll('reviews','Review');
    }
}