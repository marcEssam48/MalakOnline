<?php
/**
 * Created by PhpStorm.
 * User: me250043
 * Date: 5/12/2020
 * Time: 2:37 PM
 */
ob_start();
session_start();

include '../Models/database.php';
include 'head.php';
$db = new database();
$connect = $db->connects;
$slot = $_POST["slot"];
$today = date("2020-05-13");
$lowdate =  date("1900-01-01");
//$thirtyDays = date("Y-m-d", strtotime("+30 days"));

$slot_date_sql = "select slot_date from slots where slot_id = $slot";
$result_slot_date = mysqli_query($connect,$slot_date_sql);
$row_sql_date =  $result_slot_date->fetch_assoc();
$slot_date = $row_sql_date["slot_date"];
$thirtyDays = date('Y-m-d', strtotime($slot_date. ' + 30 days'));

//echo $thirtyDays;

if(isset($_POST['attend'])){

    if(!empty($_POST['names'])) {
// Counting number of checked checkboxes.
        $checked_count = count($_POST['names']);
        echo "You have selected following ".$checked_count." option(s): <br/>";
// Loop to store and display values of individual checked checkbox.
        foreach($_POST['names'] as $selected) {
//            echo "<p>".$selected . $slot ."</p>";
            $sql = "UPDATE user_slot set attended = 'Y' where slot_id = $slot and user_id=$selected";
            $result = mysqli_query($connect,$sql);

            $sql_1 = "Update users set next_available_date = '$thirtyDays' where user_id=$selected ";
            $result_1 = mysqli_query($connect,$sql_1);

            if($result && $result_1)
            {
                ?>
                <div class="alert alert-success" role="alert">
                    Attended Successfully
                </div>

                <div class="alert alert-primary" role="alert">
                    You will be redirected back in 3 seconds
                </div>
                <?php
                header( "refresh:3;url=../Admin/Views/dashboard.php" );

            }
            else{
                ?>
                <div class="alert alert-danger" role="alert">
                    Something went wrong
                </div>

                <div class="alert alert-primary" role="alert">
                    You will be redirected back in 3 seconds
                </div>
                <?php
                header( "refresh:3;url=../Admin/Views/dashboard.php" );
            }


        }


    }
    else{
        echo "<b>Please Select Atleast One Option.</b>";
    }


    if($today > $thirtyDays)
    {
        echo "HERE";
    }
}
?>