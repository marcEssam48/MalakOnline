<?php
/**
 * Created by PhpStorm.
 * User: me250043
 * Date: 7/2/2020
 * Time: 9:19 AM
 */
session_start();
if(isset($_SESSION['username']) && !empty($_SESSION['username']) && $_SESSION['username'] == "Admin") {


    $user_id = $_GET["id"];




}
else
{



    header('Location: ../index.php');
}