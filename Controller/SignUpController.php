<?php
/**
 * Created by PhpStorm.
 * User: me250043
 * Date: 5/10/2020
 * Time: 9:51 AM
 */
ob_start();
include '../Models/database.php';
$db = new database();
$connect = $db->connects;
include 'head.php';

if(isset($_POST["signup"])) {
    $username = $_POST["username"];
    $password = $_POST["pass"];
    $confpass = $_POST["Confpass"];
    $mobile = $_POST["mobile"];
    $DOB = $_POST["DOB"];
    $nid = $_POST["nid"];
    $today = date("Y-m-d");
    // $address = $_POST["address"];
    $gender = $_POST["gender"];
    $street_no = $_POST["street_no"];
    $street_name = $_POST["street_name"];
    $level_no = $_POST["level_no"];
    $flat_no = $_POST["flat_no"];

    $secqu = $_POST["secqu"];
    $ansqu = $_POST["ansqu"];

    $age = date_diff(date_create($DOB), date_create('today'))->y;

    if ($age > 9) {

        $sql_select = "select * from users where username = '$username' || mobile = '$mobile' || nid = '$nid'";
        $result_selectstmt = mysqli_query($connect, $sql_select);
        if ($result_selectstmt->num_rows > 0) {
            ?>
            <div class="alert alert-danger" role="alert">
                User Already Exists!
            </div>

            <div class="alert alert-primary" role="alert">
                You will be redirected back in 3 seconds
            </div>
            <?php
            header("refresh:3;url=../SignUp.php");
        } else {
            if ($password == $confpass) {
                $hash = password_hash($password, PASSWORD_DEFAULT);
                $sql = "Insert into users(username,password,mobile,dob,user_date,nid,gender,street_no,street_name,level_no,flat_no,secqu,ansqu) values('$username','$hash','$mobile','$DOB','$today','$nid',$gender,'$street_no','$street_name','$level_no','$flat_no','$secqu','$ansqu')";
                $result = mysqli_query($connect, $sql);
//echo  password_verify($password, $hash);

                if ($result) {
                    header('Location: ../index.php');

                }
            }
        }
    }
    else{
        ?>
        <div class="alert alert-danger" role="alert">
          لا يمكنك إنشاء حساب لأنك تحت السن
        </div>

        <div class="alert alert-primary" role="alert">
            You will be redirected back in 3 seconds
        </div>
        <?php
        header("refresh:5;url=../SignUp.php");
    }
}
?>