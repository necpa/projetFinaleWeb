<?php
class DeliveryAddresseManager extends Model
{
    public function getDeliveryAddresse()
    {
        return $this->getAll('deliveryaddresses','DeliveryAddresse');
    }
}