<?php
/**
 * Created by PhpStorm.
 * User: me250043
 * Date: 5/12/2020
 * Time: 12:37 PM
 */
ob_start();
session_start();
if(isset($_SESSION['username']) && !empty($_SESSION['username'])) {
include '../Models/database.php';
include 'head.php';
$db = new database();
$connect = $db->connects;
$user_id = $_GET["id"];
$user_slot_id = $_GET["user_slot_id"];
// echo $user_slot_id;



$sql = "DELETE FROM user_slot where user_slot_id = $user_slot_id";
$result = mysqli_query($connect,$sql);

$sql_cnt = "DELETE FROM user_slot_count where  id = (SELECT max(id) from user_slot_count where user_id = $user_id)";
$result_cnt = mysqli_query($connect,$sql_cnt);




if($result && $result_cnt)
{



    ?>
    <div class="alert alert-success" role="alert">
        تم إلغاء الحجز بنجاح
    </div>
    <div class="alert alert-primary" role="alert">
        You will be redirected back in 3 seconds
    </div>
    <?php
    header( "refresh:3;url=../User/Views/UserInterfaceTrial.php" );

}
else
{

    ?>
    <div class="alert alert-danger" role="alert">
        حدث خطأ ما
    </div>
    <div class="alert alert-primary" role="alert">
        You will be redirected back in 3 seconds
    </div>
    <?php
    header( "refresh:0;url=../User/Views/UserInterfaceTrial.php" );
}
}
else
{
    header('Location: ../../index.php');
}









