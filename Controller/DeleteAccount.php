<?php
ob_start();
session_start();
if(isset($_SESSION['username']) && !empty($_SESSION['username'])) {
    include '../Models/database.php';
    include 'head.php';
    $db = new database();
    $connect = $db->connects;
    $today = date("Y-m-d");


    $user_id = $_GET["id"];
//    echo $user_id;
    $sql_slot = "Delete from user_slot where user_id = $user_id ";
    $result = mysqli_query($connect, $sql_slot);

    $sql_count = "Delete from user_slot_count where user_id = $user_id ";
    $result_cnt = mysqli_query($connect, $sql_count);

    $sql_user = "Delete from users where user_id = $user_id ";
    $result_user = mysqli_query($connect, $sql_user);

    if ($result && $result_cnt && $result_user) {

        ?>
        <div class="alert alert-success" role="alert">
            تم إلغاء الحساب بنجاح
        </div>
        <div class="alert alert-primary" role="alert">
            You will be redirected back in 3 seconds
        </div>
        <?php
        header("refresh:3;url=../Admin/Views/Data.php");
    }
}
else
{
    header('Location: ../../index.php');
}