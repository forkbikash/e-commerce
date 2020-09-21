<?php
/*if(!defined('Cart')){
    header("HTTP/1.0 404 Not Found");
    exit;
}*/
class Cart
{
    private $db=null;
    public function __construct($db)
    {
        if(!isset($db->conn))
        {
            return null;
        }
        $this->db=$db;
    }

    public function getUserCart($user_id, $table='cart')
    {
        $sql="select * from {$table} where `user_id`={$user_id}";
        $result=$this->db->conn->query($sql);
        $result_array=array();
        while($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
        {
            $result_array[]=$row;
        }
        return $result_array;
    }

    public function insertIntoTable($params=null, $table= 'cart')
    {
        if($params!=null)
        {
            $columns= implode(',', array_keys($params));
            $values= implode(',', array_values($params));
            $sql= sprintf("insert into %s(%s) values (%s)", $table, $columns, $values);
            $result= $this->db->conn->query($sql);
            return $result;
        }
    }

    public function addToCart($user_id, $item_id)
    {
        if(isset($user_id) && isset($item_id))
        {
            $params= array(
                'user_id' => $user_id,
                'item_id' => $item_id
            );
            $sql="select * from {$table} where `user_id`={$user_id} and `item_id`={$item_id}";
            $result=$this->db->conn->query($sql);
            if(mysqli_num_rows($result)==0){
                $result = $this->insertIntoTable($params);
                if ($result){
                    // Reload Page
                    header("Location: " . $_SERVER['PHP_SELF']);
                }
            }
        }
    }

    public function getCartId($user_id, $cartArray = null, $key = "item_id"){//changed
        if ($cartArray != null){
            $cart_id = array_map(function ($value) use($key, $user_id){
                if($value['user_id']==$user_id){
                    return $value[$key];
                }
            }, $cartArray);
            return $cart_id;
        }
    }

    public function getSubTotal($cartArray = null){
        if ($cartArray != null){
            $subtotal=0;
            $product=new Product($this->db);
            foreach($cartArray as $value){
                $subtotal=$subtotal+$product->getProduct($value['item_id'])[0]['item_price'];
            };
            return $subtotal;
        }
    }

    public function deleteCart($user_id, $cart_id, $table='cart')//changed
    {
        if(isset($cart_id)){
            $sql= "delete from {$table} where `cart_id`={$cart_id} and `user_id`={$user_id}";
            $result=$this->db->conn->query($sql);
            if($result){
                header("location: " . $_SERVER['PHP_SELF']);
            }
        }
    }
}