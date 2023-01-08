<?php
class LoginManager extends Model
{
    public function login($username, $password)
    {
        $cond = ["username" => $username, "password" => $password];
        $res = $this->getAll('logins',Login::class, $cond);
        if (empty($res))
            return false;
        return true;
    }
}