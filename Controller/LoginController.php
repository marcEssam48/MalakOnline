<?php
ob_start();
session_start();

include '../Models/database.php';
include "head.php";
$db = new database();
$connect = $db->connects;

if(isset($_POST['login']))
{

    $name = $_POST["username"];
    $pass = $_POST["pass"];




    $sql = "SELECT * FROM users WHERE username = '$name'";
    $result = mysqli_query($connect,$sql);

    if($result->num_rows > 0)
    {


        while($row = $result->fetch_assoc())
        {
            $real_pass = $row['password'];
            $type = $row['user_type'];

            if(password_verify($pass, $row["password"])){

//                echo "USER logged in";
                $_SESSION['username'] = $name;
                $_SESSION['login'] = 1;
                if($type == "A"){
//                    echo "Admin";
                    header("Location: ../Admin/Views/dashboard.php");
                    break;
                }
                else if ($type == "U"){
//                    echo "User";
                    header("Location: ../User/Views/UserInterfaceTrial.php");
                    break;

                }
                else if ($type == "M"){
//                    echo "User";
                    header("Location: ../Mini_admin/Views/UserInterfaceTrial.php");
                    break;

                }
                else if ($type == "R"){
//                    echo "User";
                    header("Location: ../Reporter_Admin/Views/UserInterfaceTrial.php");
                    break;

                }


            }
            else{
                ?>
                <div class="alert alert-danger" role="alert">
                    Wrong Password
                </div>

                <div class="alert alert-primary" role="alert">
                    You will be redirected back in 3 seconds
                </div>
                <?php
                header( "refresh:3;url=../index.php" );
            }



        }

    }
    else
    {

        ?>
        <div class="alert alert-danger" role="alert">
            User Doesn't exist!
        </div>

        <div class="alert alert-primary" role="alert">
            You will be redirected back in 3 seconds
        </div>
        <?php
        header( "refresh:3;url=../index.php" );


    }
}
?>