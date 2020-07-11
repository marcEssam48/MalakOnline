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
    $today = date("Y-m-d");

    $sql = "Select count(*) as countU  from users";
    $result = mysqli_query($connect, $sql);
    $row = $result->fetch_assoc();
    $user_count = $row["countU"];

    $sql_2 = "Select count(*) as countO  from slots";
    $result_2 = mysqli_query($connect, $sql_2);
    $row_2 = $result_2->fetch_assoc();
    $oudas_count = $row_2["countO"];


    $sql_female = "Select count(*) as countf  from users where gender = 2";
    $result_female = mysqli_query($connect, $sql_female);
    $row_female = $result_female->fetch_assoc();
    $female = $row_female["countf"];

    $sql_male = "Select count(*) as countm  from users where gender = 1";
    $result_male = mysqli_query($connect, $sql_male);
    $row_male = $result_male->fetch_assoc();
    $male = $row_male["countm"];

    $sql_sh = "Select count(*) as countsh  from users where gender = 3";
    $result_sh = mysqli_query($connect, $sql_sh);
    $row_sh = $result_sh->fetch_assoc();
    $sh = $row_sh["countsh"];
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
        <!--<script src='https://kit.fontawesome.com/a076d05399.js'></script>-->
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
                                            <i class="fa fa-users text-warning"></i>
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
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="card card-stats">
                            <div class="card-body ">
                                <div class="row">
                                    <div class="col-5 col-md-4">
                                        <div class="icon-big text-center icon-warning">
                                            <i class="fa fa-female text-warning"></i>
                                        </div>
                                    </div>
                                    <div class="col-7 col-md-8">
                                        <div class="numbers">
                                            <p class="card-category">Total Women</p>
                                            <p class="card-title"><?php echo $female; ?><p>
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
                                            <i class="fa fa-male text-success"></i>
                                        </div>
                                    </div>
                                    <div class="col-7 col-md-8">
                                        <div class="numbers">
                                            <p class="card-category">Total Men</p>
                                            <p class="card-title"> <?php echo $male ?><p>
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
                                            <i class="fa fa-plus text-danger"></i>
                                        </div>
                                    </div>
                                    <div class="col-7 col-md-8">
                                        <div class="numbers">
                                            <p class="card-category">Total Shamas</p>
                                            <p class="card-title"><?php echo $sh?>
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
                                            <i class="fa fa-user text-primary"></i>
                                        </div>
                                    </div>
                                    <div class="col-7 col-md-8">
                                        <div class="numbers">
                                            <p class="card-category">Total Admins</p>
                                            <p class="card-title">4
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










                <div class="card card-stats">
                    <div class="card-body ">
                        <div class="row">
                            <div class="col-12">
                                <div class="alert alert-secondary" align="center" style="text-align: center;">
                                    <table class="table table-striped" style="text-align: center">
                                        <tr>
                                            <td>تاريخ القداس</td>
                                            <td>توقيت القداس</td>
                                            <td>العدد المتبقي</td>
                                            <td>الحالة</td>
                                        </tr>
                                        <?php
                                        $sql_available = "SELECT slots.slot_date as slt_date , slots.slot_id as slt_id from slots where shown = 'Y'  order by slots.slot_date  ";
                                        $result_available = mysqli_query($connect,$sql_available);
                                        if($result_available->num_rows > 0)
                                        {
                                            while ($row_aval = $result_available->fetch_assoc())
                                            {
                                                $slt_id = $row_aval["slt_id"];
                                                $sql_id_slt = "select number from slots where slot_id = $slt_id";
                                                $result_id_slt = mysqli_query($connect,$sql_id_slt);
                                                $row_slt_id = $result_id_slt->fetch_assoc();
                                                $numbers = $row_slt_id["number"];



                                                $sql_time_slt = "select slot_time from slots where slot_id = $slt_id";
                                                $result_time_slt = mysqli_query($connect,$sql_time_slt);
                                                $row_slt_time = $result_time_slt->fetch_assoc();
                                                $slot_time = $row_slt_time["slot_time"];

                                                $sql_cnt_slt = "select count(user_slot_count.id) as cnt from user_slot_count where slot_id = $slt_id";
                                                $result_cnt_slt = mysqli_query($connect,$sql_cnt_slt);
                                                $row_cnt_time = $result_cnt_slt->fetch_assoc();
                                                $slot_cnt = $row_cnt_time["cnt"];

                                                if($today < $row_aval["slt_date"]) {


                                                    ?>
                                                    <tr>
                                                    <td style="font-size: 12px;"><?php echo $row_aval["slt_date"] ?></td>
                                                    <td><?php echo $slot_time ?></td>
                                                    <td><?php echo $numbers-$slot_cnt ?></td>
                                                    <?php

                                                    if ($numbers == $slot_cnt) {
                                                        ?>
                                                        <td class="alert alert-danger"><?php echo "مكتمل" ?></td>
                                                        <?php

                                                    } else {
                                                        ?>
                                                        <td class="alert alert-success"><?php echo "يوجد أماكن" ?></td>
                                                        <?php

                                                    }
                                                }
                                                ?>

                                                </tr>

                                                <?php
//                                echo $row_aval["slt_date"];
                                            }

                                        }
                                        ?>

                                    </table>
                                </div>
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