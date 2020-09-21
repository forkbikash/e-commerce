<?php
/*if(!defined('DbConn')){
    header("HTTP/1.0 404 Not Found");
    exit;
}*/
class DbConn
{
    private $servername='localhost';//on xampp
    private $username='root';//your username
    private $password='';//your password
    private $dbname = 'ecommerce';//replace this with your database name

    public $conn=null;

    public function __construct()
    {
        $this->conn = mysqli_connect($this->servername, $this->username, $this->password, $this->dbname);
        if($this->conn->connect_error)
        {
            die("Connection failed: " . $this->conn->connect_error);
        }
        //echo 'connection successful';
        //return ($this->conn);
    }

    public function __destruct()
    {
        $this->closeConnection();
    }

    private function closeConnection()
    {
        if($this->conn!=null)
        {
            $this->conn->close();
            $this->conn=null;
        }
    }
}