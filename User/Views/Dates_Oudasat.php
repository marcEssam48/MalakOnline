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

    $sql_user = "select user_id,gender from users where username = '$username'";
    $result_user = mysqli_query($connect,$sql_user);
    $row = $result_user->fetch_assoc();
    $user_id = $row["user_id"];
    $user_gender = $row["gender"];
    $flag = 0;
    $attend = "";
    $next_date = "";
    $low_date = date("1900-01-01");
    $returned_date = $_GET["id"];

    $sql_count_mates = "select count(*) as count_mates from mates join users on mates.user_id = users.user_id where mates.user_id = $user_id";
    $result_count_mates = mysqli_query($connect,$sql_count_mates);
    $row = $result_count_mates->fetch_assoc();
    $cnts_mates = $row["count_mates"];
    $gender_attended = "";

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
                <form method="get" action="../../Controller/DeleteBooking.php">
                    <div class="row">
                        <div class="col-12">
                            <?php
                            $sql_1 = "select  * from user_slot join users on user_slot.user_id = users.user_id join slots on user_slot.slot_id = slots.slot_id where users.user_id = $user_id order by slots.slot_date asc";
                            $result_1 = mysqli_query($connect,$sql_1);
                            if($result_1->num_rows > 0)
                            {
                                $flag = 1;


                                while($row = $result_1->fetch_assoc()) {
                                    $low_date = $row["slot_date"];
                                    $church = "";
                                    if ($row["church"] == "L") {
                                        $church = "الكنيسة الكبيرة";
                                    } elseif ($row["church"] == "S") {
                                        $church = "الكنيسة الصغيرة";
                                    }

                                    if($row["category"] == 1)
                                    {
                                        $gender_attended = "كرجال" ;

                                    }
                                    else if ($row["category"] == 2)
                                    {
                                        $gender_attended = "كسيدات";
                                    }
                                    else if ($row["category"] == 3)
                                    {
                                        $gender_attended = "كشماس";
                                    }
                                    $attend = $row["attended"];
                                    $next_date = $row["next_available_date"];
                                    if($today < $row["slot_date"]) {
                                        ?>

                                        <div id="myModal" class="modal">

                                            <!-- Modal content -->
                                            <div class="modal-content" style="text-align: center">

                                                <p>هل أنت متأكد من إلغاء الحجز ؟</p>

                                                <a href="../../Controller/DeleteBooking.php?id=<?php echo $row["user_id"]?>&user_slot_id=<?php echo $row["user_slot_id"]?>"><input type="button" class="btn btn-success" value="نعم"></input></a>
                                                <a><input type="button"  class="btn btn-danger" onclick="closeFunction()" value="لا" ></input></a>
                                            </div>

                                        </div>
                                        <div class="card card-stats">
                                            <div class="card-body ">
                                                <div class="alert alert-primary">
                                                    <h5 style="text-align: right;color: #3a283d">
                                                        القداس الذي تم حجزه
                                                    </h5>
                                                    <div class="row">
                                                        <i class="fa fa-calendar col-4" aria-hidden="true" style="color: #3a283d"> <span
                                                                    style="color: #3a283d"><?php echo $row["slot_date"] ?></span></i>

                                                        <i class="fa fa-clock-o col-4" aria-hidden="true" style="color: #3a283d"> <span
                                                                    style="color: #3a283d">من الساعة <?php echo $row["slot_time"] ?></span></i>

                                                        <i class="fa fa-clock-o col-4" aria-hidden="true" style="color: #3a283d"> <span
                                                                    style="color: #3a283d">  الي الساعة <?php echo $row["slot_time_to"] ?></span></i>
                                                    </div>
                                                    <br>
                                                    <div class="row">

                                                        <i class="fas fa-church col-4" aria-hidden="true" style="color: #3a283d">
                                                            <span style="color: #3a283d"><?php echo $church ?></span></i>

                                                        <i class="fas fa-pray col-4" aria-hidden="true" style="color: #3a283d">
                                                            <span style="color: #3a283d"><?php echo "ستحضر القداس ". $gender_attended?></span></i>


                                                    </div>
                                                    <br>
                                                </div>

                                            </div>
                                            <div class="card-footer " style="text-align: center">
                                                <input type="button" value="إلغاء الحجز" class="btn btn-danger" id="myBtn" >


                                            </div>
                                        </div>
                                        <?php
                                    }

                                }
                            }
                            else{
                                ?>
                                <div class="card card-stats">
                                    <div class="card-body ">
                                        <div class="alert alert-danger">
                                            <h5 style="text-align: right;color: #3a283d">
                                                لم يتم حجز أي قداسات بعد
                                            </h5>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                </form>

                <form action="../../Controller/UserBooking.php" method="get">

                    <div class="row">
                        <div class="col-12">
                            <?php
                            $sql = "select  * from slots where slot_date ='$returned_date' and shown='Y' order by slot_date , slot_time";
                            $result = mysqli_query($connect,$sql);
                            if($result->num_rows > 0)
                            {
                                while($row = $result->fetch_assoc())
                                {
                                    $church = "";
                                    if($row["church"] == "L")
                                    {
                                        $church = "الكنيسة الكبيرة";
                                    }
                                    elseif($row["church"] == "S")
                                    {
                                        $church = "الكنيسة الصغيرة";
                                    }
                                    if($today < $row["slot_date"]) {
                                        $slot_id = $row["slot_id"];
                                        $sql_count = "select count(user_slot_count.id) as counter from user_slot_count right join slots on slots.slot_id = user_slot_count.slot_id where user_slot_count.slot_id = $slot_id";
                                        $result_count = mysqli_query($connect,$sql_count);
                                        $row_count = $result_count->fetch_assoc();
                                        $final_count_progress = round($row_count["counter"]/$row["number"]*100);
                                        $left = $row["number"] - $row_count["counter"];

                                        ?>


                                        <div class="card card-stats">

                                            <div class="card-body ">
                                                <div class="alert alert-warning">
                                                    <h5 style="text-align: right;color: #3a283d">
                                                        القداسات المتاحة
                                                    </h5>
                                                    <div class="row">
                                                        <i class="fa fa-calendar col-4" aria-hidden="true" style="color: #3a283d">
                                                            <span style="color: #3a283d"><?php echo $row["slot_date"] ?></span></i>

                                                        <i class="fa fa-clock-o col-4" aria-hidden="true" style="color: #3a283d">
                                                            <span style="color: #3a283d"> من الساعة <?php echo $row["slot_time"] ?></span></i>

                                                        <i class="fa fa-clock-o col-4" aria-hidden="true" style="color: #3a283d"> <span
                                                                    style="color: #3a283d">  الي الساعة <?php echo $row["slot_time_to"] ?></span></i>
                                                    </div>
                                                    <br>
                                                    <div class="row">

                                                        <i class="fas fa-church col-4" aria-hidden="true" style="color: #3a283d">
                                                            <span style="color: #3a283d"><?php echo $church ?></span></i>

                                                        <i class="fas fa-pray col-4" aria-hidden="true" style="color: #3a283d">
                                                            <span style="color: #3a283d"><?php echo $row["number"] ?></span></i>
                                                    </div>
                                                    <br>
                                                    <?php
//                                                    $shamamsa = round($row["number"]*2/10);
//                                                    $men = round($row["number"]*3/10);
//                                                    $women = round($row["number"]*5/10);

                                                    $shamamsa = $row["shamas"];
                                                    $men = $row["men"];
                                                    $women = $row["women"];

                                                    $sql_counter_reminder = "select count(*) as cnt from user_slot_count join users on users.user_id = user_slot_count.user_id where user_slot_count.category = 1 and slot_id =  $slot_id";
                                                    $result_reminder = mysqli_query($connect,$sql_counter_reminder);
                                                    $row_reminder = $result_reminder->fetch_assoc();
                                                    $mens_remainder = $row_reminder["cnt"];

                                                    $sql_counter_reminder_s = "select count(*) as cnt from user_slot_count join users on users.user_id = user_slot_count.user_id where user_slot_count.category = 3 and slot_id =  $slot_id";
                                                    $result_reminder_s = mysqli_query($connect,$sql_counter_reminder_s);
                                                    $row_reminder_s = $result_reminder_s->fetch_assoc();
                                                    $mens_remainder_s = $row_reminder_s["cnt"];

                                                    $sql_counter_reminder_w = "select count(*) as cnt from user_slot_count join users on users.user_id = user_slot_count.user_id where user_slot_count.category = 2 and slot_id =  $slot_id";
                                                    $result_reminder_w = mysqli_query($connect,$sql_counter_reminder_w);
                                                    $row_reminder_w = $result_reminder_w->fetch_assoc();
                                                    $mens_remainder_w = $row_reminder_w["cnt"];

                                                    ?>
                                                    <div class="progress">
                                                        <div class="progress-bar progress-bar-success" role="progressbar"
                                                             aria-valuenow="40"
                                                             aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $final_count_progress;?>%">
                                                            <span style="color: #3a283d"><?php echo $final_count_progress;?>%       </span>
                                                        </div>

                                                    </div>
                                                    <br>
                                                    <div class="row" style="color:black;">
                                                        <div class="col-4">
                                                            <p>عدد الشمامسة : <?php echo $shamamsa?></p>
                                                        </div>
                                                        <div class="col-4">
                                                            <p> عددالرجال : <?php echo $men?></p>
                                                        </div>
                                                        <div class="col-4">
                                                            <p>عدد السيدات : <?php echo $women?></p>
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <div class="row" style="color:black;">
                                                        <div class="col-4">
                                                            <p> المتبقي : <?php echo $shamamsa - $mens_remainder_s?></p>
                                                        </div>
                                                        <div class="col-4">
                                                            <p> المتبقي : <?php echo $men - $mens_remainder ?></p>
                                                        </div>
                                                        <div class="col-4">
                                                            <p> المتبقي : <?php echo $women -$mens_remainder_w?></p>
                                                        </div>
                                                    </div>
                                                    <span style="color: #3a283d"><?php echo $left?> are left</span>
                                                </div>



                                            </div>
                                            <?php




                                            if( $left != 0 && $today >= $next_date && $today > $low_date )
                                            {

                                                if($user_gender == 3)
                                                {
                                                    if($shamamsa - $mens_remainder_s != 0){
                                                        ?>
                                                        <div class="card-footer " style="text-align: center">
                                                            <a href="../../Controller/UserBooking.php?id=<?php echo $row["slot_id"] ?>&user_id=<?php echo $user_id ?>&gender=3">
                                                                <input type="button" name="click_book" value="  حجز القداس كشماس "
                                                                       class="btn btn-success">
                                                            </a>


                                                        </div>
                                                        <!--            <div class="alert alert-primary"> -->
                                                        <!--<h5 style="text-align: right;color: #3a283d">-->
                                                        <!--    لقد انتهت الأماكن المتاحة لحجز هذا القداس-->
                                                        <!--</h5>-->
                                                        <!--</div>-->
                                                        <?php
                                                    }
                                                    if($men - $mens_remainder != 0)
                                                    {
                                                        ?>
                                                        <div class="card-footer " style="text-align: center">
                                                            <a href="../../Controller/UserBooking.php?id=<?php echo $row["slot_id"] ?>&user_id=<?php echo $user_id ?>&gender=1">
                                                                <input type="button" name="click_book" value="  حجز القداس كشعب  "
                                                                       class="btn btn-success">
                                                            </a>


                                                        </div>
                                                        <?php
                                                    }
                                                    else if($men - $mens_remainder == 0)
                                                    {
                                                        ?>
                                                        <div class="alert alert-primary">
                                                            <h5 style="text-align: right;color: #3a283d">
                                                                لقد انتهت الأماكن المتاحة للرجال لحجز هذا القداس
                                                            </h5>
                                                        </div>
                                                        <?php

                                                    }

                                                }
                                                else if ($user_gender == 1)
                                                {
                                                    if($men - $mens_remainder != 0)
                                                    {
                                                        ?>
                                                        <div class="card-footer " style="text-align: center">
                                                            <a href="../../Controller/UserBooking.php?id=<?php echo $row["slot_id"] ?>&user_id=<?php echo $user_id ?>&gender=1">
                                                                <input type="button" name="click_book" value="  حجز القداس كشعب  "
                                                                       class="btn btn-success">
                                                            </a>


                                                        </div>
                                                        <?php
                                                    }
                                                    else if($men - $mens_remainder == 0)
                                                    {
                                                        ?>
                                                        <div style="width:50%;margin-left:25%;">
                                                            <div class="alert alert-danger" >
                                                                <h5 style="text-align: right;color: #3a283d;text-align:center;">
                                                                    لقد انتهت الأماكن المتاحة للرجال لحجز هذا القداس
                                                                </h5>
                                                            </div>
                                                        </div>
                                                        <?php

                                                    }
                                                }
                                                else if ($user_gender == 2)
                                                {
                                                    if($women -$mens_remainder_w != 0)
                                                    {
                                                        ?>
                                                        <div class="card-footer " style="text-align: center">
                                                            <a href="../../Controller/UserBooking.php?id=<?php echo $row["slot_id"] ?>&user_id=<?php echo $user_id ?>&gender=2">
                                                                <input type="button" name="click_book" value="  حجز القداس  كشعب "
                                                                       class="btn btn-success">
                                                            </a>


                                                        </div>
                                                        <?php
                                                    }
                                                    else if($women -$mens_remainder_w == 0)
                                                    {
                                                        ?>
                                                        <div style="width:50%;margin-left:25%;">
                                                            <div class="alert alert-danger" >
                                                                <h5 style="text-align: right;color: #3a283d;text-align:center;">
                                                                    لقد انتهت الأماكن المتاحة للسيدات لحجز هذا القداس
                                                                </h5>
                                                            </div>
                                                        </div>
                                                        <?php

                                                    }
                                                }


                                            }
                                            else
                                            {
//                                                echo $next_date;

                                                if($today <= $low_date || $today < $next_date)
                                                {
                                                    ?>
                                                    <div style="width:50%;margin-left:25%;">
                                                        <div class="alert alert-danger">
                                                            <h5 style="text-align: right;color: #3a283d;text-align:center;">
                                                                لا يمكنك حجز قداس أخر قبل مرور 30 يوم علي الحجز الحالي
                                                            </h5>
                                                        </div>
                                                    </div>
                                                    <?php
                                                }
                                                else{
                                                    ?>
                                                    <div style="width:50%;margin-left:25%;">
                                                        <div class="alert alert-danger">
                                                            <h5 style="text-align: right;color: #3a283d;text-align:center;">
                                                                لقد انتهت الأماكن المتاحة  لحجز هذا القداس
                                                            </h5>
                                                        </div>
                                                    </div>
                                                    <?php

                                                }
                                            }


                                            ?>
                                        </div>
                                        <?php
                                    }

                                }
                            }
                            else {
                                ?>
                                <div class="card card-stats">
                                    <div class="card-body ">
                                        <div class="alert alert-danger">
                                            <h5 style="text-align: right;color: #3a283d">
                                                لا يوجد قداسات بعد
                                            </h5>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                            ?>
                            <?php
                            if($today > $low_date)
                            {

                            }
                            ?>
                        </div>
                    </div>
                </form>

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
        <script>
            var modal = document.getElementById("myModal");

            // Get the button that opens the modal
            var btn = document.getElementById("myBtn");

            // Get the <span> element that closes the modal
            var span = document.getElementsByClassName("close")[0];

            // When the user clicks on the button, open the modal
            btn.onclick = function() {
                modal.style.display = "block";
            }

            // When the user clicks on <span> (x), close the modal
            span.onclick = function() {
                modal.style.display = "none";
            }

            // When the user clicks anywhere outside of the modal, close it
            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            }
        </script>
        <script>
            function closeFunction() {
                var x = document.getElementById("myModal");
                if (x.style.display === "none") {
                    x.style.display = "block";
                } else {
                    x.style.display = "none";
                }
            }
        </script>

    </body>
    </html>
    <?php
}else
{
    header('Location: ../../index.php');
}
?>

