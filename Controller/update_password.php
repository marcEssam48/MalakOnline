<?php
ob_start();
session_start();

include '../Models/database.php';
//include 'head.php';
//include 'Controller/head.php';
$db = new database();
$connect = $db->connects;
if(isset($_POST["pass_update"]))
{
    $pass = $_POST["pass"];
    $confirm = $_POST["confirm"];
    $username = $_POST["username"];
    if($pass == $confirm)
    {
        $hash = password_hash($pass, PASSWORD_DEFAULT);
        $sql_update_passwords = "Update users set password = '$hash' where username = '$username'";
        $result_password_update = mysqli_query($connect,$sql_update_passwords);

        if($result_password_update)
        {
            include 'head.php';
            echo "<div class='alert alert-success'> لقد تم تغيير كلمة المرور بنجاح </div>";
            header( "refresh:3;url=../index.php" );
        }
        else{
            include 'head.php';
            echo "<div class='alert alert-danger'> حدث خطأ ما </div>";
            header( "refresh:3;url=../index.php" );
        }

    }
}



if(isset($_POST["update"])) {
    $username = $_POST["username"];
    $ansqu = $_POST["ansqu"];

    $sql = "Select ansqu from users where username = '$username' ";
    $result = mysqli_query($connect,$sql);
    $row = $result->fetch_assoc();
    $question_real_answer = $row["ansqu"];

    if($question_real_answer == $ansqu)
    {
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
                    <form  name="myForm" class="login100-form validate-form" method="post" action="" onsubmit="return validateForm();">
    <span class="login100-form-logo">
<!--						<i class="zmdi zmdi-landscape"></i>-->
                         <img src="../Admin/assets/img/church.jpg" width="100%"style="border-radius:50%">
                    </span>
                        <br>
                        <div class="form-group">
                            <input type="password" name="pass" class="form-control"  placeholder="كلمة المرور" required>
                        </div>
                        <div class="form-group">
                            <input type="password" name="confirm" class="form-control" placeholder="تأكيد كلمة المرور ">
                        </div>
                        <input type="hidden" value="<?php echo $username?>" name="username">
                        <div style="text-align: center">
                            <button class="btn btn-success" name="pass_update">
                                تغيير
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <script>
            function validateForm() {
                var pass = document.forms["myForm"]["pass"].value;
                var confpass = document.forms["myForm"]["confirm"].value;

                if(pass !== confpass)
                {
                    alert("كلمات السر لا تساوي بعضها");
                    return false;
                }

                if(pass.length < 8 )
                {
                    alert("يجب ان تكون كلمة المرور مكونة من 8 أحرف أو أرقام او مزيج منهما علي الأقل");
                    return false;
                }
            }
        </script>
        </body>
        </html>

<?php
    }
    else
    {
        include 'head.php';
        echo "<div class='alert alert-danger'> الوصية تقول لا تسرق يا صاحبي</div>";
        header( "refresh:5;url=../index.php" );
    }

}