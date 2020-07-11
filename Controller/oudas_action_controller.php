<?php
/**
 * Created by PhpStorm.
 * User: me250043
 * Date: 7/11/2020
 * Time: 1:22 PM
 */
ob_start();
session_start();

include '../Models/database.php';
include "head.php";
$db = new database();
$connect = $db->connects;
if(isset($_SESSION['username']) && !empty($_SESSION['username']) && $_SESSION['username'] == "Admin") {
    $id = $_GET["id"];
    $status = $_GET["status"];

    $sql = "Update slots set shown = '$status' where slot_id = $id ";
    $result = mysqli_query($connect,$sql);

    if($result)
    {
        ?>
        <div class="alert alert-success" role="alert">
            تم   بنجاح
        </div>
        <div class="alert alert-primary" role="alert">
            You will be redirected back in 3 seconds
        </div>
        <?php
        header( "refresh:3;url=../Admin/Views/oudas_action_center.php" );



    }
    else{
        ?>
        <div class="alert alert-danger" role="alert">
               حدث خطأ ما
        </div>
        <div class="alert alert-primary" role="alert">
            You will be redirected back in 3 seconds
        </div>
        <?php
        header( "refresh:3;url=../Admin/Views/oudas_action_center.php" );

        }
}
else
{
    header('Location: ../../index.php');
}