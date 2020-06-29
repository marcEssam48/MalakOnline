<?php
ob_start();
session_start();
if(isset($_SESSION['username']) && !empty($_SESSION['username'])) {
    include '../Models/database.php';
    $db = new database();
    $connect = $db->connects;

    include 'head.php';
    $user_id = $_POST["id"];
    $pass = $_POST["pass"];
    $confpass = $_POST["confpass"];
    $mobile = $_POST["mobile"];
    $dob = $_POST["dob"];
    $nid = $_POST["nid"];
// $address = $_POST["address"];
    $gender = $_POST["gender"];
//echo $user_id ." ". $pass ." ". $confpass . " " . $mobile. " " . $dob ;

    if ($pass == $confpass) {
        $hash = password_hash($pass, PASSWORD_DEFAULT);
//    echo $hash ;
        $sql = "Update users set password = '$hash' where user_id = $user_id ";
        $result = mysqli_query($connect, $sql);

        if ($result) {

//      echo "done pass";
//      echo "<br>";
            $sql_mob = "Update users set mobile = '$mobile' where user_id = $user_id ";
            $result_mob = mysqli_query($connect, $sql_mob);

            if ($result_mob) {
//            echo "done mobile";
//            echo "<br>";
                $sql_dob = "Update users set dob = '$dob' where user_id = $user_id ";
                $result_dob = mysqli_query($connect, $sql_dob);

                if ($result_dob) {

                    $sql_nid = "Update users set nid = '$nid' where user_id = $user_id ";
                    $result_nid = mysqli_query($connect, $sql_nid);

                    if ($result_nid) {

                        $sql_address = "Update users set address = '$address' where user_id = $user_id ";
                        $result_address = mysqli_query($connect, $sql_address);

                        if ($result_address) {

                            $sql_gender = "Update users set gender = $gender where user_id = $user_id ";
                            $result_gender = mysqli_query($connect, $sql_gender);
                            if ($result_gender) {
                                ?>
                                <div class="alert alert-success" role="alert">
                                    Updated Successfully
                                </div>

                                <div class="alert alert-primary" role="alert">
                                    You will be redirected back in 3 seconds
                                </div>
                                <?php
                                header("refresh:3;url=../User/Views/UserInterfaceTrial.php");

                            } else {
                                ?>
                                <div class="alert alert-danger" role="alert">
                                    Invalid user_type
                                </div>

                                <div class="alert alert-primary" role="alert">
                                    You will be redirected back in 3 seconds
                                </div>
                                <?php
                                header("refresh:3;url=../User/Views/UserInterfaceTrial.php");
                            }


                        } else {
                            ?>
                            <div class="alert alert-danger" role="alert">
                                Invalid address
                            </div>

                            <div class="alert alert-primary" role="alert">
                                You will be redirected back in 3 seconds
                            </div>
                            <?php
                            header("refresh:3;url=../User/Views/UserInterfaceTrial.php");
                        }
                    } else {
                        ?>
                        <div class="alert alert-danger" role="alert">
                            Invalid NationalId
                        </div>

                        <div class="alert alert-primary" role="alert">
                            You will be redirected back in 3 seconds
                        </div>
                        <?php
                        header("refresh:3;url=../User/Views/UserInterfaceTrial.php");
                    }
                } else {
                    ?>
                    <div class="alert alert-danger" role="alert">
                        Date of Birth went wrong
                    </div>

                    <div class="alert alert-primary" role="alert">
                        You will be redirected back in 3 seconds
                    </div>
                    <?php
                    header("refresh:3;url=../User/Views/UserInterfaceTrial.php");
                }
//                echo "done dob";
//                echo "<br>";

            } else {
                ?>
                <div class="alert alert-danger" role="alert">
                    Mobile went wrong
                </div>

                <div class="alert alert-primary" role="alert">
                    You will be redirected back in 3 seconds
                </div>
                <?php
                header("refresh:3;url=../User/Views/UserInterfaceTrial.php");
            }
        } else {
            ?>
            <div class="alert alert-danger" role="alert">
                Password went wrong
            </div>

            <div class="alert alert-primary" role="alert">
                You will be redirected back in 3 seconds
            </div>
            <?php
            header("refresh:3;url=../User/Views/UserInterfaceTrial.php");
        }
    } else {
        ?>
        <div class="alert alert-danger" role="alert">
            Passwords mismatch
        </div>

        <div class="alert alert-primary" role="alert">
            You will be redirected back in 3 seconds
        </div>
        <?php
        header("refresh:3;url=../User/Views/UserInterfaceTrial.php");
    }
}
else
    {
        header('Location: ../../index.php');
    }
