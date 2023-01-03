<?php
class ReviewManager extends Model
{
    public function getReview()
    {
        return $this->getAll('reviews','Review');
    }
}