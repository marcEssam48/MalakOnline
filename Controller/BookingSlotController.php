<?php
/**
 * Created by PhpStorm.
 * User: me250043
 * Date: 5/11/2020
 * Time: 7:55 AM
 */
ob_start();
session_start();

include '../Models/database.php';
include 'head.php';
$db = new database();
$connect = $db->connects;
if(isset($_POST["book"])){

    $date = $_POST["odate"];
    $time = $_POST["otime"];
    $church = $_POST["church"];
    $audience_number = $_POST["onumber"];
    $shamas = $_POST["shamas"];
    $men = $_POST["men"];
    $women = $_POST["women"];
    // $priest = $_POST["priest"];
    $today =  date("Y-m-d");

//    echo $date . $time . $church . $audience_number . $priest ;

    $sql = "INSERT INTO slots(slot_date,slot_time,church,number,delivered_date,shamas,men,women) values('$date','$time','$church',$audience_number,'$today',$shamas,$men,$women)";
    $result = mysqli_query($connect,$sql);

    if($result){
        ?>
        <div class="alert alert-success" role="alert">
            Inserted Successfully
        </div>

        <div class="alert alert-primary" role="alert">
            You will be redirected back in 3 seconds
        </div>
        <?php
        header( "refresh:0;url=../Admin/Views/booking_slot.php" );
    }
    else{
        echo "Not";
    }

}
?>