<?php
/*if(!defined('User')){
    header("HTTP/1.0 404 Not Found");
    exit;
}*/
class User
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

    public function insertUser($params=null, $table= 'user')
    {
        if($params!=null)
        {
            $param1=$params['user_id'];
            $param2=$params['first_name'];
            $param3=$params['last_name'];
            $sql = "insert into `user`(`user_id`,`first_name`,`last_name`) values ('$param1','$param2','$param3')";
            $result= $this->db->conn->query($sql);
            //echo var_dump($result);
            return $result;
        }
    }

    public function getUser($user_id, $table='user')
    {
        $sql= "select * from {$table} where `user_id`={$user_id}";
        $result=$this->db->conn->query($sql);
        $result_array=array();
        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
        {
            $result_array[]=$row;
        }
        return $result_array;
    }
}