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

    $sql_slots = "select * from user_slot join users on users.user_id = user_slot.user_id join slots on slots.slot_id = user_slot.slot_id where users.user_id = '$user_id'";
    $res = mysqli_query($connect,$sql_slots);
    $status = "";

    $count_query = "select count(*) as cnt from user_slot join users on users.user_id = user_slot.user_id join slots on slots.slot_id = user_slot.slot_id where users.user_id = '$user_id'";
    $res_count = mysqli_query($connect,$count_query);
    $row_count = $res_count->fetch_assoc();
    $oudas_count = $row_count["cnt"];


    $count_query_yes = "select count(*) as yes from user_slot join users on users.user_id = user_slot.user_id join slots on slots.slot_id = user_slot.slot_id where users.user_id = '$user_id' and user_slot.attended = 'Y'";
    $res_count_yes = mysqli_query($connect,$count_query_yes);
    $row_count = $res_count_yes->fetch_assoc();
    $oudas_count_yes = $row_count["yes"];
    $day_in_arabic = "";

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
            </div>

            <div class="card card-stats" style="width: 100%;text-align: right;">
                <br>
                <?php
                if($res->num_rows > 0) {
                echo "<h3 style='text-align: right;margin-right: 5%;'>قداساتي</h3>";
                while($row = $res->fetch_assoc())
                {
                $date = $row["slot_date"];
                $unixTimestamp = strtotime($date);

                //Get the day of the week using PHP's date function.
                $dayOfWeek = date("l", $unixTimestamp);
                if($dayOfWeek == "Friday"){
                    $day_in_arabic = "الجمعه";
                }
                elseif($dayOfWeek == "Saturday"){
                    $day_in_arabic = "السبت";
                }
                elseif($dayOfWeek == "Sunday"){
                    $day_in_arabic = "الأحد";
                }
                elseif($dayOfWeek == "Monday"){
                    $day_in_arabic = "الأثنين";
                }
                elseif($dayOfWeek == "Tuesday"){
                    $day_in_arabic = "الثلاثاء";
                }
                elseif($dayOfWeek == "Wednesday"){
                    $day_in_arabic = "الأربعاء";
                }
                elseif($dayOfWeek == "Thursday"){
                    $day_in_arabic = "الخميس";
                }
                if($row["church"] == "L"){
                    $church_char = " الكنيسة الكبيرة";
                }
                elseif($row["church"] == "S"){
                    $church_char = " الكنيسة الصغيرة";
                }
                if($row["attended"] == "N")
                {
                    $status = "لم تحضر";
                }
                elseif($row["attended"] == "Y")
                {
                    $status = "حضرت";
                }

                if($row["category"] == 1)
                {
                    $category = "رجال";
                }
                else if($row["category"] == 2)
                {
                    $category = "سيدات";
                }
                else if($row["category"] == 3)
                {
                    $category = "شماس";
                }
                ?>
                <div class="card-body" style="margin-left: 5%;">
                    <div class="row" >
                        <div class="col-12">
                            <?php
                            if($row["attended"] == "N")
                            {
                            ?>
                            <div class="alert alert-danger">
                                <?php

                                }
                                else{
                                ?>
                                <div class="alert alert-success">
                                    <?php

                                    }
                                    ?>

                                    <h5 >  قداس بتاريخ  <span style="color: #3a283d;"><mark><?php echo $row["slot_date"];?></mark></span>   الموافق يوم

                                        <span style="color: #3a283d;"><mark><?php echo $day_in_arabic;?></mark></span>
                                        <br>
                                        في
                                        <span style="color: #3a283d;"><mark><?php echo $church_char;?></mark></span>
                                        <br>
                                        في تمام الساعة
                                        <span style="color: #3a283d;"><mark><?php echo $row["slot_time"];?></mark></span>
                                        <br>

                                        ستحضر القداس كفئة
                                        <span style="color: #3a283d;"><mark><?php echo $category?></mark></span>
                                        <br>
                                        <?php
                                        if($today > $row["slot_date"])
                                        {
                                            ?>
                                            و أنت
                                            <span style="color: #3a283d;"><mark><?php echo $status;?></mark></span>
                                            هذا القداس
                                            <br>
                                            <?php

                                            if($row["attended"] == "Y")
                                            {
                                                ?>
                                                لذلك لن تتمكن من الحجز سوي بعد 30 يوما أي في اليوم الموافق
                                                <span style="color: #3a283d;"><mark><?php echo $row["next_available_date"];?></mark></span>
                                                <?php
                                            }
                                            else{
                                                ?>
                                                و لكنك تستطيع الحجز مرة أخري و لكن برجاء الحضور في التاريخ الذي تم حجزه
                                                <?php

                                            }

                                        }
                                        else{
                                            ?>
                                            و القداس لم يحين موعده
                                        <?php }?>
                                    </h5>
                                </div>
                            </div>
                        </div>


                    </div>

                    <?php
                    }
                    }
                    else{

                        ?>

                        <div class="alert alert-danger">
                            <span>لم يتم حجز أي قداسات بعد</span>
                        </div>
                        <?php
                    }
                    ?>


                </div>
                <div class="row">
                    <div class="col-12" >
                        <div class="card card-stats">
                            <div class="card-body ">
                                <div class="row">
                                    <div class="col-12 col-md-12">
                                        <div class="icon-big text-center icon-warning">
                                            <i class="fas fa-calendar-times"></i>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-12">
                                        <div class="numbers" style="text-align:center;">
                                            <p class="card-category" >عدد القداسات التي تم حجزها</p>
                                            <p class="card-title"><?php echo $oudas_count;?><p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-12">
                        <div class="card card-stats">
                            <div class="card-body ">
                                <div class="row">
                                    <div class="col-12 col-md-12">
                                        <div class="icon-big text-center icon-warning">
                                            <i class="fas fa-calendar-plus"></i>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-12">
                                        <div class="numbers">
                                            <p class="card-category" style="text-align:center;">عدد القداسات التي تم حضورها</p>
                                            <p class="card-title" style="text-align:center;"><?php echo $oudas_count_yes;?><p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>


                    <div class="col-12">
                        <div class="card card-stats">
                            <div class="card-body ">
                                <div class="row">
                                    <div class="col-12 col-md-12">
                                        <div class="icon-big text-center icon-warning">
                                            <i class="fas fa-calendar-minus"></i>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-12">
                                        <div class="numbers">
                                            <p class="card-category" style="text-align:center;">عدد القداسات التي  لم يتم حضورها</p>
                                            <p class="card-title" style="text-align:center;"><?php echo $oudas_count - $oudas_count_yes;?><p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php
        include 'footer.php';
        ?>

    </div>
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