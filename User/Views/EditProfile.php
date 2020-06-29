<?php
ob_start();
session_start();
if(isset($_SESSION['username']) && !empty($_SESSION['username']))
{

    include '../../Models/database.php';
    $db = new database();
    $connect = $db->connects;
    $today_1 = date("2020-06-13");
    $today = date("Y-m-d");
    $username = $_SESSION["username"];

    $sql_user = "select user_id from users where username = '$username'";
    $result_user = mysqli_query($connect,$sql_user);
    $row = $result_user->fetch_assoc();
    $user_id = $row["user_id"];
    $flag = 0;
    $attend = "";
    $next_date = "";
    $low_date = date("1900-01-01");

    $sql_ret = "Select * from users where user_id = $user_id";
    $res = mysqli_query($connect,$sql_ret);

    $category = "";

    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8" />
        <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
        <link rel="icon" type="image/png" href="../../Admin/assets/img/malak.jpeg"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <title>
            Malak Online

        </title>
        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
        <!--     Fonts and icons     -->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
        <!-- CSS Files -->
        <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
        <link href="../assets/css/paper-dashboard.css?v=2.0.1" rel="stylesheet" />
        <!-- CSS Just for demo purpose, don't include it in your project -->
        <link href="../assets/demo/demo.css" rel="stylesheet" />
        <script src="https://kit.fontawesome.com/a076d05399.js"></script>
        <style>
            .modal {
                display: none; /* Hidden by default */
                position: fixed; /* Stay in place */
                z-index: 1; /* Sit on top */
                left: 0;
                top: 0;
                width: 50%; /* Full width */
                height: 50%; /* Full height */
                overflow: auto; /* Enable scroll if needed */

                margin-left: 30%;
            }

            /* Modal Content/Box */
            .modal-content {
                background-color: #fefefe;
                margin: 15% auto; /* 15% from the top and centered */
                padding: 20px;
                border: 1px solid #888;
                width: 80%; /* Could be more or less, depending on screen size */
            }

            /* The Close Button */
            .close {
                color: #aaa;
                float: right;
                font-size: 28px;
                font-weight: bold;
            }

            .close:hover,
            .close:focus {
                color: black;
                text-decoration: none;
                cursor: pointer;
            }
        </style>
    </head>

    <body class="">
    <div class="wrapper ">
        <?php include "UserSidebar.php"; ?>
        <div class="main-panel" >
            <!-- Navbar -->
            <?php include "UserNavbar.php"; ?>


            <div class="content">

                <form name="myForm" method="post"  onsubmit="return validateForm();" action="../../Controller/UpdateDataController.php" >
                    <div class="card card-stats">
                        <div class="card-body ">
                            <div class="alert alert-primary">
                                <h5 style="text-align: right;color: #3a283d">
                                    بياناتي
                                </h5>
                                <?php
                                if($res->num_rows > 0)
                                {
                                    while($row = $res->fetch_assoc())
                                    {

                                        if($row["gender"] == 1)
                                        {
                                            $category = "رجال";
                                        }
                                        else if($row["gender"] == 2)
                                        {
                                            $category = "سيدات";
                                        }
                                        else if($row["gender"] == 3)
                                        {
                                            $category = "شماس";
                                        }
                                        ?>




                                        <div class="row">
                                        <div class="form-control" style="text-align: right">
                                        <label  style="text-align: right;font-size: 200%">اسم المستخدم</label>
                                        <br>
                                        <input type="text" class="form-control" name="username" value="<?php echo $username?>" readonly style="color: #3a283d">
                                        <br>

                                        <label  style="text-align: right;font-size: 200%">رقم العضوية </label>
                                        <br>
                                        <input type="text" class="form-control" name="serialnumber" value="<?php echo $row["serial_no"]?>" readonly style="color: #3a283d">
                                        <br>

                                        <label  style="text-align: right;font-size: 200%">كلمة المرور</label>
                                        <br>
                                        <input type="password" class="form-control" name="pass" value="" >
                                        <br>

                                        <label  style="text-align: right;font-size: 200%">تأكيد كلمة المرور</label>
                                        <br>
                                        <input type="password" class="form-control" name="confpass" value="" >
                                        <br>

                                        <label  style="text-align: right;font-size: 200%">رقم الموبايل</label>
                                        <br>
                                        <input type="number" class="form-control" name="mobile" value="<?php echo $row["mobile"]?>" required>
                                        <br>

                                        <label  style="text-align: right;font-size: 200%">تاريخ الميلاد</label>
                                        <br>
                                        <input type="Date" class="form-control" name="dob" value="<?php echo $row["dob"]?>" >
                                        <br>

                                        <label  style="text-align: right;font-size: 200%"> الفئة</label>
                                        <br>
                                        <input type="text" class="form-control" value="<?php echo "انت الان في فئة ". $category ." لتغيير الفئة قم باختيار الفئة الصحيحة من أسفل"?>" readonly>
                                        <br>
                                        <?php
                                        $ge = $row["gender"];
                                        $sql_gender = "select value from category where category_id = $ge";
                                        $res_gender =  mysqli_query($connect,$sql_gender);
                                        $row_gen = $res_gender->fetch_assoc();
                                        $value = $row_gen["value"];
                                        ?>
                                        <select name="gender" class="form-control">
                                            <option value="<?php echo $ge?>"><?php echo $value?></option>
                                            <?php
                                            $sql_other_gen = "select * from category where category_id != $ge";
                                            $res_other_gen = mysqli_query($connect,$sql_other_gen);

                                            if($res_other_gen->num_rows > 0)
                                            {
                                                while($row_other_gen = $res_other_gen->fetch_assoc() )
                                                {
                                                    ?>
                                                    <option value="<?php echo $row_other_gen["category_id"]?>"><?php echo $row_other_gen["value"] ?></option>
                                                    <?php

                                                }
                                            }
                                            ?>



                                        </select>
                                        <br>

                                        <input type="hidden" class="form-control" name="id" value="<?php echo $user_id?>" >


                                        <?php
                                        if($row["nid"] == "0")
                                        {
                                            ?>
                                            <label  style="text-align: right;font-size: 200%">الرقم القومي </label>
                                            <input type="number" class="form-control" name="nid" value="<?php echo $row["nid"]?>" >
                                            <?php

                                        }
                                        else
                                        {
                                            ?>
                                            <label  style="text-align: right;font-size: 200%">الرقم القومي </label>
                                            <input type="text" class="form-control" name="nid" value="<?php echo $row["nid"]?>" readonly>
                                            <?php
                                        }
                                        ?>

                                        <?php
                                    }
                                    ?>



                                    <div style="text-align: center">

                                        <button class="btn btn-success" value=" ">
                                            تعديل
                                        </button>
                                    </div>

                                    </div>

                                    </div>
                                    <?php

                                }


                                ?>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
            <br>
            <br>
            <?php
            include 'footer.php';
            ?>
            <br>
            <br>
        </div>

    </div>
    <script>
        function validateForm() {
            var pass = document.forms["myForm"]["pass"].value;
            var confpass =  document.forms["myForm"]["confpass"].value;
            var mobile =  document.forms["myForm"]["mobile"].value;
            var nid =  document.forms["myForm"]["nid"].value;

            if (pass.length < 8) {
                alert("password must be 8 characters at least");
                return false;
            }
            if(pass !== confpass)
            {
                alert("Passwords Mismatch");
                return false;
            }
            if(mobile.length !== 11){
                alert("Invalid Mobile Number");
                return false;
            }
            if(nid.length !== 14){
                alert("Invalid National Id ");
                return false;
            }
        }
    </script>
    <script src="../assets/js/core/jquery.min.js"></script>
    <script src="../assets/js/core/popper.min.js"></script>
    <script src="../assets/js/core/bootstrap.min.js"></script>
    <script src="../assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
    <!--  Google Maps Plugin    -->
    <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
    <!-- Chart JS -->
    <script src="../assets/js/plugins/chartjs.min.js"></script>
    <!--  Notifications Plugin    -->
    <script src="../assets/js/plugins/bootstrap-notify.js"></script>
    <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="../assets/js/paper-dashboard.min.js?v=2.0.1" type="text/javascript"></script><!-- Paper Dashboard DEMO methods, don't include it in your project! -->
    <script src="../assets/demo/demo.js"></script>
    <script>
        $(document).ready(function() {
            // Javascript method's body can be found in assets/assets-for-demo/js/demo.js
            demo.initChartsPages();
        });
    </script>
    </body>
    </html>
    <?php
}else
{
    header('Location: ../../index.php');
}
?>
