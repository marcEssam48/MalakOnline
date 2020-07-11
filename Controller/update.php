<?php
/**
 * Created by PhpStorm.
 * User: me250043
 * Date: 7/2/2020
 * Time: 9:19 AM
 */
session_start();
include '../Models/database.php';
include 'head.php';
$db = new database();
$connect = $db->connects;
if(isset($_SESSION['username']) && !empty($_SESSION['username']) && $_SESSION['username'] == "Admin") {
    if (isset($_GET["upall"])) {
        $yesterday = date("Y-m-d", time() - 60 * 60 * 24);
        $sql = "Update users set next_available_date = '$yesterday' ";
        $result = mysqli_query($connect, $sql);
        if ($result) {
            ?>
            <div class="alert alert-success" role="alert">
                تم فتح الحجز للجميع بنحاح
            </div>

            <div class="alert alert-primary" role="alert">
                You will be redirected back in 3 seconds
            </div>
            <?php
            header("refresh:2;url=../Admin/Views/book_unbook.php");

        } else {
            ?>
            <div class="alert alert-danger" role="alert">
                فشلت المحاولة
            </div>

            <div class="alert alert-primary" role="alert">
                You will be redirected back in 3 seconds
            </div>
            <?php
            header("refresh:2;url=../Admin/Views/book_unbook.php");

        }
    } else {
        $user_id = $_GET["id"];
        $yesterday = date("Y-m-d", time() - 60 * 60 * 24);
//    echo $yesterday;
        $sql = "Update users set next_available_date = '$yesterday' where user_id = $user_id";
        $result = mysqli_query($connect, $sql);
        if ($result) {
            ?>
            <div class="alert alert-success" role="alert">
                تم فتح الحجز بنحاح
            </div>

            <div class="alert alert-primary" role="alert">
                You will be redirected back in 3 seconds
            </div>
            <?php
            header("refresh:2;url=../Admin/Views/book_unbook.php");

        } else {
            ?>
            <div class="alert alert-danger" role="alert">
                فشلت المحاولة
            </div>

            <div class="alert alert-primary" role="alert">
                You will be redirected back in 3 seconds
            </div>
            <?php
            header("refresh:2;url=../Admin/Views/book_unbook.php");

        }


    }
}
else
{



    header('Location: ../index.php');
}
