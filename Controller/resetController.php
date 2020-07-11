<?php
ob_start();
session_start();

include '../Models/database.php';
//include 'head.php';
//include 'Controller/head.php';
$db = new database();
$connect = $db->connects;
if(isset($_POST["send"])) {
    $username = $_POST["username"];
//                echo $username;

    $sql = "Select secqu from users where username = '$username' and user_type='U' ";
    $result = mysqli_query($connect, $sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $question = $row["secqu"];

        ?>

        <html>
        <head>
            <title>Malak Online</title>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <!--===============================================================================================-->
            <link rel="icon" type="image/png" href="../Admin/assets/img/malak.jpeg"/>
            <!--===============================================================================================-->
            <link rel="stylesheet" type="text/css" href="../vendor/bootstrap/css/bootstrap.min.css">
            <!--===============================================================================================-->
            <link rel="stylesheet" type="text/css" href="../fonts/font-awesome-4.7.0/css/font-awesome.min.css">
            <!--===============================================================================================-->
            <link rel="stylesheet" type="text/css" href="../fonts/iconic/css/material-design-iconic-font.min.css">
            <!--===============================================================================================-->
            <link rel="stylesheet" type="text/css" href="../vendor/animate/animate.css">
            <!--===============================================================================================-->
            <link rel="stylesheet" type="text/css" href="../vendor/css-hamburgers/hamburgers.min.css">
            <!--===============================================================================================-->
            <link rel="stylesheet" type="text/css" href="../vendor/animsition/css/animsition.min.css">
            <!--===============================================================================================-->
            <link rel="stylesheet" type="text/css" href="../vendor/select2/select2.min.css">
            <!--===============================================================================================-->
            <link rel="stylesheet" type="text/css" href="../vendor/daterangepicker/daterangepicker.css">
            <!--===============================================================================================-->
            <link rel="stylesheet" type="text/css" href="../css/util.css">
            <link rel="stylesheet" type="text/css" href="../css/main.css">
            <!--===============================================================================================-->
        </head>
        <body>
        <div class="limiter">
            <div class="container-login100" style="background-image: url('../images/bg-01.jpg');">
                <div class="wrap-login100">
                    <form class="login100-form validate-form" method="post" action="update_password.php">
    <span class="login100-form-logo">
<!--						<i class="zmdi zmdi-landscape"></i>-->
                         <img src="../Admin/assets/img/church.jpg" width="100%" style="border-radius:50%">
                    </span>
                        <br>
                        <div class="form-group">
                            <input type="text" name="seqqu" class="form-control" value="<?php echo $question ?>"
                                   readonly>
                        </div>
                        <div class="form-group">
                            <input type="text" name="ansqu" class="form-control" placeholder="أدخل الاجابة " required>
                        </div>
                        <input type="hidden" value="<?php echo $username ?>" name="username">
                        <div style="text-align: center">
                            <button class="btn btn-success" name="update">
                                إرسال
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        </body>
        </html>
        <?php


    }
    else{
        include 'head.php';
        echo "<div class='alert alert-danger'> عفوا هذا المستخدم غير موجود</div>";
        header( "refresh:3;url=../index.php" );
    }
}

?>