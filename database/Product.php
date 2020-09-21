<?php
/*if(!defined('Product')){
    header("HTTP/1.0 404 Not Found");
    exit;
}*/
class Product
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

    public function getData($table='product')
    {
        $sql="select * from {$table}";
        $result=$this->db->conn->query($sql);
        $result_array=array();
        while($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
        {
            $result_array[]=$row;
        }
        return $result_array;
    }

    public function getProduct($item_id, $table='product')
    {
        $sql= "select * from {$table} where `item_id`={$item_id}";
        $result=$this->db->conn->query($sql);
        $result_array=array();
        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
        {
            $result_array[]=$row;
        }
        return $result_array;
    }
}