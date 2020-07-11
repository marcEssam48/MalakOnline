<?php
ob_start();
session_start();
if(isset($_SESSION['username']) && !empty($_SESSION['username']))
{

    include '../Models/database.php';
    include 'head.php';
    $db = new database();
    $connect = $db->connects;
    $today_1 = date("2020-06-13");
    $today = date("Y-m-d");
    $username = $_SESSION["username"];
    $slot_id = $_GET["id"];
    $user_id = $_GET["user_id"];
    $gender = $_GET["gender"];

    $sql_oudas_number = "select number,shamas,men,women from slots where slot_id = $slot_id";
    $result_oudas_number = mysqli_query($connect,$sql_oudas_number);
    $row_number = $result_oudas_number->fetch_assoc();
    $total_number = $row_number["number"];

    $slot_date_sql = "select slot_date from slots where slot_id = $slot_id";
    $result_slot_date = mysqli_query($connect,$slot_date_sql);
    $row_sql_date =  $result_slot_date->fetch_assoc();
    $slot_date = $row_sql_date["slot_date"];
    $thirtyDays = date('Y-m-d', strtotime($slot_date. ' + 30 days'));

//    echo $thirtyDays;
    $sql_next_date = "select next_available_date from users where user_id = $user_id ";
    $result_next_date = mysqli_query($connect,$sql_next_date);
    $row_next_date =  $result_next_date->fetch_assoc();
    $next_date = $row_next_date["next_available_date"];



//    $shamamsa = round($total_number*2/10);
//    $men = round($total_number*3/10);
//    $women = round($total_number*5/10);

    $shamamsa = $row_number["shamas"];
    $men = $row_number["men"];
    $women = $row_number["women"];



    $sql_safe = "select count(*) as cnt from user_slot_count where slot_id = $slot_id and category = $gender";
    $result_safe = mysqli_query($connect,$sql_safe);
    $row_safe = $result_safe->fetch_assoc();
    $current_number = $row_safe["cnt"];

//    echo $current_number;

if($today > $next_date)
{
    if($gender == 1 && $current_number >= $men)
    {
        ?>
        <div class="alert alert-danger" role="alert">
            نأسف لقد انتهت الأماكن المتاحة
        </div>
        <div class="alert alert-primary" role="alert">
            You will be redirected back in 3 seconds
        </div>
        <?php
        header( "refresh:3;url=../User/Views/UserInterfaceTrial.php" );


    }
   elseif($gender == 2 && $current_number >= $women)
    {
        ?>
        <div class="alert alert-danger" role="alert">
            نأسف لقد انتهت الأماكن المتاحة
        </div>
        <div class="alert alert-primary" role="alert">
            You will be redirected back in 3 seconds
        </div>
        <?php
        header( "refresh:3;url=../User/Views/UserInterfaceTrial.php" );

    }

    elseif($gender == 3 && $current_number >= $shamamsa)
    {
        ?>
        <div class="alert alert-danger" role="alert">
            نأسف لقد انتهت الأماكن المتاحة
        </div>
        <div class="alert alert-primary" role="alert">
            You will be redirected back in 3 seconds
        </div>
        <?php
        header( "refresh:3;url=../User/Views/UserInterfaceTrial.php" );

    }
    else {


// echo $slot_id . " " . $user_id;
        $sql_get_age = "Select dob from users where user_id = $user_id";
        $result_age = mysqli_query($connect, $sql_get_age);
        $row_age = $result_age->fetch_assoc();
        $dob = $row_age["dob"];


        $age = date_diff(date_create($dob), date_create('today'))->y;
// echo $age ;
        if ($age > 10) {
            $sql_insert = "INSERT INTO user_slot_count(user_id,slot_id,category) values($user_id,$slot_id,$gender)";
            $result_insert = mysqli_query($connect, $sql_insert);
        }

        $sql_insert_no = "INSERT INTO user_slot(user_id,slot_id,category) values($user_id,$slot_id,$gender)";
        $result_insert_no = mysqli_query($connect, $sql_insert_no);

        $sql_update_next = "UPDATE users SET next_available_date = '$thirtyDays' where user_id = $user_id";
        $result_update_next = mysqli_query($connect,$sql_update_next);

        include 'head.php';

        if ($result_insert_no) {
            ?>
            <div class="alert alert-success" role="alert">
                تم الحجز بنجاح
            </div>
            <div class="alert alert-primary" role="alert">
                You will be redirected back in 3 seconds
            </div>
            <?php
        header( "refresh:0;url=../User/Views/UserInterfaceTrial.php" );

        } else {

            ?>
            <div class="alert alert-danger" role="alert">
                حدث خطأ ما برجاء المحاولة في وقت لاحق
            </div>
            <div class="alert alert-primary" role="alert">
                You will be redirected back in 5 seconds
            </div>
            <?php
            header("refresh:5;url=../User/Views/UserInterfaceTrial.php");

        }


        ?>

        <?php
    }
    }
    else{
        ?>
        <div class="alert alert-danger" role="alert">
            لم يحن موعد حجزك بعد
        </div>
        <div class="alert alert-primary" role="alert">
            You will be redirected back in 3 seconds
        </div>
        <?php
        header( "refresh:3;url=../User/Views/UserInterfaceTrial.php" );

    }
}
else
{
    header('Location: ../index.php');
}
?>
