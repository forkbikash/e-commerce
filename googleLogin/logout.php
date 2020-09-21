<?php
//error_reporting(0);
//logout.php
define('config', true);
include('config.php');

if(!isset($_SESSION['access_token'])){
    header("location: ../index.php");
    exit;
}

//Reset OAuth access token
$google_client->revokeToken($_SESSION['access_token']);

//Destroy entire session data.
session_destroy();

//redirect page to index.php
header('location: ../index.php');
?>