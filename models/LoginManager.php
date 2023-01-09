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

    public function usernameAlreadyExists($username)
    {
        $cond = ["username" => $username];
        $res = $this->getAll('logins',Login::class, $cond);
        if (empty($res))
            return false;
        return true;
    }

    public function newLogin($username, $password)
    {
        $id = $this->maxId('logins') + 1;
        $cond = ["id" => $id, "username" => $username, "password" => $password];
        $this->addToTableColumn('logins', $cond);
    }
}