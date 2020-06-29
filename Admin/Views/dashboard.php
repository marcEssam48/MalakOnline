<!--
=========================================================
* Paper Dashboard 2 - v2.0.1
=========================================================

* Product Page: https://www.creative-tim.com/product/paper-dashboard-2
* Copyright 2020 Creative Tim (https://www.creative-tim.com)

Coded by www.creative-tim.com

 =========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<?php
ob_start();
session_start();
if(isset($_SESSION['username']) && !empty($_SESSION['username']) && $_SESSION['username'] == "Admin") {
    include '../../Models/database.php';
    $db = new database();
    $connect = $db->connects;
    $oudas_count = 0;
    $user_count = 0;

    $sql = "Select count(*) as countU  from users";
    $result = mysqli_query($connect, $sql);
    $row = $result->fetch_assoc();
    $user_count = $row["countU"];

    $sql_2 = "Select count(*) as countO  from slots";
    $result_2 = mysqli_query($connect, $sql_2);
    $row_2 = $result_2->fetch_assoc();
    $oudas_count = $row_2["countO"];
    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8"/>
        <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
        <link rel="icon" type="image/png" href="../assets/img/favicon.png">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
        <title>
            Oudasy-Admin
        </title>
        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no'
              name='viewport'/>
        <!--     Fonts and icons     -->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet"/>
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
        <!-- CSS Files -->
        <link href="../assets/css/bootstrap.min.css" rel="stylesheet"/>
        <link href="../assets/css/paper-dashboard.css?v=2.0.1" rel="stylesheet"/>
        <!-- CSS Just for demo purpose, don't include it in your project -->
        <link href="../assets/demo/demo.css" rel="stylesheet"/>
    </head>

    <body class="">
    <div class="wrapper ">
        <?php include "Sidebar.php"; ?>
        <div class="main-panel">
            <!-- Navbar -->
            <?php include "Navbar.php"; ?>

            <!-- End Navbar -->
            <div class="content">
                <div class="row">
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="card card-stats">
                            <div class="card-body ">
                                <div class="row">
                                    <div class="col-5 col-md-4">
                                        <div class="icon-big text-center icon-warning">
                                            <i class="nc-icon nc-globe text-warning"></i>
                                        </div>
                                    </div>
                                    <div class="col-7 col-md-8">
                                        <div class="numbers">
                                            <p class="card-category">Total Users</p>
                                            <p class="card-title"><?php echo $user_count; ?><p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer ">
                                <hr>

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="card card-stats">
                            <div class="card-body ">
                                <div class="row">
                                    <div class="col-5 col-md-4">
                                        <div class="icon-big text-center icon-warning">
                                            <i class="nc-icon nc-bank text-success"></i>
                                        </div>
                                    </div>
                                    <div class="col-7 col-md-8">
                                        <div class="numbers">
                                            <p class="card-category">Total Oudasat</p>
                                            <p class="card-title"> <?php echo $oudas_count ?><p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer ">
                                <hr>

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="card card-stats">
                            <div class="card-body ">
                                <div class="row">
                                    <div class="col-5 col-md-4">
                                        <div class="icon-big text-center icon-warning">
                                            <i class="nc-icon nc-paper text-danger"></i>
                                        </div>
                                    </div>
                                    <div class="col-7 col-md-8">
                                        <div class="numbers">
                                            <p class="card-category">att. average</p>
                                            <p class="card-title">0%
                                            <p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer ">
                                <hr>

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="card card-stats">
                            <div class="card-body ">
                                <div class="row">
                                    <div class="col-5 col-md-4">
                                        <div class="icon-big text-center icon-warning">
                                            <i class="nc-icon nc-ambulance text-primary"></i>
                                        </div>
                                    </div>
                                    <div class="col-7 col-md-8">
                                        <div class="numbers">
                                            <p class="card-category">absence average</p>
                                            <p class="card-title">0%
                                            <p>
                                        </div>
                                    </div>
                                </div>


                            </div>
                            <div class="card-footer ">
                                <hr>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card ">
                            <div class="card-header ">
                                <h5 class="card-title">Stats</h5>

                            </div>
                            <div class="card-body ">

                            </div>
                            <div class="card-footer ">


                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="card ">
                            <div class="card-header ">
                                <h5 class="card-title">Available Time Slots</h5>

                            </div>
                            <div class="card-body ">
                                <?php
                                $sql = "select * from slots";
                                $result = mysqli_query($connect, $sql);
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        $dayOfWeek = date("l", strtotime($row["slot_date"]));
                                        $day_in_arabic = "";
                                        $church_char = "";
                                        $today = date("Y-m-d");
                                        if ($dayOfWeek == "Friday") {
                                            $day_in_arabic = "الجمعه";
                                        } elseif ($dayOfWeek == "Saturday") {
                                            $day_in_arabic = "السبت";
                                        } elseif ($dayOfWeek == "Sunday") {
                                            $day_in_arabic = "الأحد";
                                        } elseif ($dayOfWeek == "Monday") {
                                            $day_in_arabic = "الأثنين";
                                        } elseif ($dayOfWeek == "Tuesday") {
                                            $day_in_arabic = "الثلاثاء";
                                        } elseif ($dayOfWeek == "wednesday") {
                                            $day_in_arabic = "الأربعاء";
                                        } elseif ($dayOfWeek == "Thursday") {
                                            $day_in_arabic = "الخميس";
                                        }
                                        if ($row["church"] == "L") {
                                            $church_char = " الكنيسة الكبيرة";
                                        } elseif ($row["church"] == "S") {
                                            $church_char = " الكنيسة الصغيرة";
                                        }
                                        if ($today < $row["slot_date"]) {
                                            ?>


                                            <div class="alert alert-warning" role="alert" style="align-text: center">
                                                <h5 style="color: #3a283d"> يوم <span
                                                            style="color: #062c33"><?php echo $day_in_arabic; ?></span>
                                                    الموافق <span
                                                            style="color: #062c33"><?php echo $row["slot_date"]; ?></span>
                                                    الساعة <span
                                                            style="color: #062c33"><?php echo $row["slot_time"]; ?></span>
                                                    أقصي عدد للحضور <span
                                                            style="color: #062c33"><?php echo $row["number"] . " " . "شخص"; ?> </span>
                                                    سيقام القداس في<span
                                                            style="color: #062c33"><?php echo $church_char; ?> </span> و
                                                    يصليه
                                                    <span style="color: #062c33"><?php echo $row["priest"]; ?> </span>
                                                </h5>
                                                <div class="progress">
                                                    <div class="progress-bar progress-bar-success" role="progressbar"
                                                         aria-valuenow="40"
                                                         aria-valuemin="0" aria-valuemax="100" style="width:40%">
                                                        40% booked (success)
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                        }

                                    }
                                }
                                ?>
                            </div>
                            <div class="card-footer ">


                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <?php include 'footer.php'; ?>
        </div>
    </div>
    <!--   Core JS Files   -->
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
    <script src="../assets/js/paper-dashboard.min.js?v=2.0.1" type="text/javascript"></script>
    <!-- Paper Dashboard DEMO methods, don't include it in your project! -->
    <script src="../assets/demo/demo.js"></script>
    <script>
        $(document).ready(function () {
            // Javascript method's body can be found in assets/assets-for-demo/js/demo.js
            demo.initChartsPages();
        });
    </script>
    </body>

    </html>
    <?php
}
else
{
    header('Location: ../../index.php');
}
?>