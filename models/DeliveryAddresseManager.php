<?php
class DeliveryAddresseManager extends Model
{
    public function getDeliveryAddresse()
    {
        return $this->getAll('deliveryaddresses','DeliveryAddresse');
    }

    public function getAddressById($id)
    {
        return $this->getAll('delivery_addresses','DeliveryAddresse', ["id" => $id]);

    }
}