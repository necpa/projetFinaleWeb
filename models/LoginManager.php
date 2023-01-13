<?php
class LoginManager extends Model
{
    public function login($username, $password)
    {
        $cond = ["username" => $username, "password" => $password];
        $res = $this->getAll('logins',Login::class, $cond);
        if (empty($res))
            return false;
        $_SESSION['login_id'] = $res[0]->getId();
        $_SESSION['customer_id'] = $res[0]->getCustomerId();
        $_SESSION['username'] = $username;
        $_SESSION['is_log'] = true;
        $res = $this->getAll('orders', Order::class, ['customer_id' => $_SESSION['customer_id'], 'status' => '0']);
        if (!empty($res))
        {
            $_SESSION['order_id'] = $res[0]->getId();
            $res = $this->getAll('orderitems', OrderItem::class, ['order_id' => $_SESSION['order_id']]);
            if(isset($_SESSION['panier']))
            {
                if ($_SESSION['panier'] == [])
                {
                    foreach($res as $orderitem)
                    {
                        $product = ($this->getAll('products', Product::class,['id' => $orderitem->getProductId()]))[0];
                        $_SESSION['panier'][$product->getId()]['productId']=$orderitem->getQuantity();
                        $_SESSION['panier'][$product->getId()]['productQty']=$orderitem->getQuantity();
                        $_SESSION['panier'][$product->getId()]['price']=$product->getPrice();
                    }
                }
                else
                {
                    foreach($res as $orderitem)
                    {
                        $product = ($this->getAll('products', Product::class,['id' => $orderitem->getProductId()]))[0];
                        if(!isset($_SESSION['panier'][$product->getId()]))
                        {
                            $_SESSION['panier'][$product->getId()]['productQty']=$orderitem->getQuantity();
                            $_SESSION['panier'][$product->getId()]['price']=$product->getPrice();
                        }
                    }
                }
            }
            else
            {
                foreach($res as $orderitem)
                {
                    $product = ($this->getAll('products', Product::class,['id' => $orderitem->getProductId()]))[0];
                    $_SESSION['panier'][$product->getId()]['productQty']=$orderitem->getQuantity();
                    $_SESSION['panier'][$product->getId()]['price']=$product->getPrice();
                }
            }
        }
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

    public function emailAlreadyExists($email)
    {
        $res = $this->getAll('customers',Customer::class, ["email" => $email]);
        if(empty($res))
            return false;
        else
        {
            $customer = $res[0];
            $res = $this->getAll('logins',Login::class, ["customer_id" => $customer->getId()]);
            if (empty($res))
                return false;
            return true;
        }
    }

    public function newLogin($username, $password, $email)
    {
        $id = $this->maxId('logins') + 1;
        $res = $this->getAll('customers',Customer::class,["email" => $email]);
        if (empty($res))
        {
            $customer_id = $this->maxId('customers') + 1;
            $cond = ["id" => $customer_id,"email" => $email];
            $this->addToTableColumn('customers',$cond);
        }
        else
            $customer_id = $res[0]->getId();
        $cond = ["id" => $id,"customer_id" => $customer_id, "username" => $username, "password" => $password];
        $this->addToTableColumn('logins', $cond);
        $_SESSION['customer_id'] = $customer_id;
        $_SESSION['login_id'] = $id;
        $_SESSION['username'] = $username;
        $_SESSION['is_log'] = true;
    }

}