<?php
class DeliveryAddresseManager extends Model
{
    public function getDeliveryAddresse()
    {
        return $this->getAll('deliveryaddresses','DeliveryAddresse');
    }

    public function getAddressById($id)
    {
        return $this->getOne('delivery_addresses', $id, DeliveryAddresse::class);

    }
}