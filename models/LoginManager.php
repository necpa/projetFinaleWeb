<?php
class LoginManager extends Model
{
    public function getLogins()
    {
        return $this->getAll('logins','Login');
    }
}