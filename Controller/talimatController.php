<?php

ob_start();
session_start();

include '../Models/database.php';
include 'head.php';
$db = new database();
$connect = $db->connects;
$id = $_GET["id"];

$sql = "update users set verify='T' where user_id = $id";
$result = mysqli_query($connect,$sql);

if($result)
{
    ?>

    <?php
    header( "refresh:0;url=../User/Views/UserInterfaceTrial.php" );
}

?>