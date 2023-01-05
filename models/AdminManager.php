<?php
class AdminManager extends Model
{
    public function getAdmins()
    {
        return $this->getAll('admins','Admin');
    }
}