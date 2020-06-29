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
    $day_in_arabic="";

    $sql_user = "select user_id,nid,verify from users where username = '$username'";
    $result_user = mysqli_query($connect,$sql_user);
    $row = $result_user->fetch_assoc();
    $user_id = $row["user_id"];
    $user_nid = $row["nid"];
    $user_verify = $row["verify"];
    $flag = 0;
    $attend = "";
    $next_date = "";
    $low_date = date("1900-01-01");
    $trimed = substr($user_nid,9,13);
    $serial_no =  $user_id . $trimed;
    $serial_no_int = (int)$serial_no ;
    $gender_attended = "";
    $sql_serial = "Update users set serial_no = $serial_no_int where user_id = $user_id";
    $result_serial = mysqli_query($connect,$sql_serial);
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

                <?php

                ?>
                <div class="card card-stats">
                    <div class="card-body ">
                        <div class="alert alert-secondary">


                            <h5 style="text-align: right;color: #3a283d">
                                :تعليمات وشروط هامة جدا يجب قراءتها بمنتهى الدقة

                            </h5>
                            <ul style="text-align:right;direction:rtl;color:black;">
                                <li>الحضور للمتناول فقط ، وان يكون قبطياً ارثوذكسيأ ، غير متخاصم مع أحد ، تائب و معترف ، محترس9 ساعات ، صائم صيامات الكنيسة.</li>
                                <li> ممنوع استقبال مكالمات تليفونية او التصوير اثناء القداس لعدم التشتت</li>
                                <li>	يسمح للشخص بحجز قداس واحد مرة واحدة كل ٣٠ يوم </li>
                                <li> 	يجب ان يظهر الشخص الرقم القومي الخاص به او بمرافقيه عند الدخول(بطاقة أو شهادة ميلاد للاقل من سن البطاقة) - لن يسمح بالدخول بدون الرقم القومي  او فى حالة اختلافه مع الرقم المسجل على البرنامج </li>
                                <li> 	لن يسمح بدخول اى شخص لا يرتدى كمامة وسيتم توفير المطهرات قبل الدخول لصحن الكنيسة </li>
                                <li> 	يجب اتباع تعليمات مسئولي الامن والكشافة داخل وخارج صحن الكنيسة بمنتهى الدقة لسلامتكم </li>
                                <li> 	سيتم غلق باب الكنيسة بعد بدء القداس مباشرة وعلى المشترك الحضور قبل الموعد بنصف ساعة </li>
                                <li> 	يسمح بالحجز كشماس بدءا من سن 13 سنة   (أولي إعدادي )فمافوق ولا يقبل حالياً سن اقل من ذلك </li>
                                <li> 	من يغيب عن القداس دون الغاء للحجز قبلها لن يستطيع الحجز مرة أخرى قبل مرور شهر </li>
                                <li> 	يعتذر عن الحضور كل من يشكو من أى أعراض برد او أعراض متشابهة مع أعراض كورونا </li>
                                <li> 	الاطفال اقل من ٩ سنوات لايمكن عمل حساب لهم ويمكن حضورهم مع الاهل مباشرة بحد اقصي طفلين لكل شخص ويجلسون بجواره بالكنيسة </li>
                                <li> 	لن توزع لفائف او ايشاربات او مياه لصرف المناولة او كتب صلوات وعلى كل شخص احضار مستلزماته الخاصة </li>
                                <li> 	تمتنع القبلة المقدسة وتقبيل الايقونات وتقبيل يد الكاهن </li>
                                <li> 	الانصراف بعد تناول كل شخص مباشرة ولايسمح بأى تجمعات قبل أو بعد القداس نهائياً </li>
                                <li> يجب علي الشمامسة تسجيل الفئة" شماس" اثناء تسجيل بياناته ليتمكن من حجز الحضور كشماس</li>
                            </ul>

                            <h6 style="text-align: right;color: #3a283d">
                                أتعهد اننى قرأت جميع الشروط وأوافق عليها
                            </h6>
                            <h6 style="text-align: right;color: #3a283d">
                                اتعهد بدقة وصحة جميع البيانات التى قمت بادخالها
                            </h6>
                            <?php
                            if($user_verify == "F")
                            {
                                ?>
                                <form action="action="../../Controller/talimatController.php"" method="get">
                                <div style="text-align:center;">
                                    <a href="../../Controller/talimatController.php?id=<?php echo $user_id?>"><input type="button" class="btn btn-success" value="تأكيد قراءة التعليمات"></input></a>
                                </div>
                                </form>

                                <?php
                            }
                            ?>


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
                                    $sql_available = "SELECT slots.slot_date as slt_date , slots.slot_id as slt_id from slots  order by slots.slot_date  ";
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
            <?php


            if($user_verify == "T")
            {
                ?>
                <?php
                if($user_nid == "0")
                {
                    ?>
                    <div class="card card-stats">
                        <div class="card-body ">
                            <div class="alert alert-primary">


                                <h5 style="text-align: right;color: #3a283d">
                                    برجاء الذهاب إلي "تعديل بياناتي" و قم بإدخال  رقمك القومي

                                </h5>


                            </div>

                        </div>

                    </div>

                    <?php

                }
                ?>
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
                                                        <i class="fa fa-calendar col-6" aria-hidden="true" style="color: #3a283d"> <span
                                                                    style="color: #3a283d"><?php echo $row["slot_date"] ?></span></i>

                                                        <i class="fa fa-clock-o col-6" aria-hidden="true" style="color: #3a283d"> <span
                                                                    style="color: #3a283d"><?php echo $row["slot_time"] ?></span></i>
                                                    </div>
                                                    <br>
                                                    <div class="row">

                                                        <i class="fas fa-church col-6" aria-hidden="true" style="color: #3a283d">
                                                            <span style="color: #3a283d"><?php echo $church ?></span></i>

                                                        <i class="fas fa-pray col-6" aria-hidden="true" style="color: #3a283d">
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

                        <?php
                        $sql = "select  DISTINCT slot_date  from slots order by slot_date";
                        $result = mysqli_query($connect,$sql);
                        if($result->num_rows > 0)
                        {
                            while($row = $result->fetch_assoc())
                            {

                                if($today < $row["slot_date"]) {

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
                                    ?>


                                    <div class="col-6">
                                        <div class="card card-stats">

                                            <div class="card-body ">
                                                <div class="alert alert-warning">



                                                    <i class="fa fa-calendar col-6" aria-hidden="true" style="color: #3a283d;text-align:center;""></i>
                                                    <p style="color: #3a283d;font-size:12px;text-align:center;"><?php echo $day_in_arabic;?></p>

                                                    <p style="color: #3a283d;font-size:12px;text-align:center;"><?php echo $row["slot_date"] ?></p>



                                                    <br>

                                                    <br>
                                                    <?php

                                                    ?>


                                                </div>


                                            </div>
                                            <div style="text-align: center">
                                                <a href="Dates_Oudasat.php?id=<?php echo $row["slot_date"]?>"><input type="button" value="القداسات المتاحة" class="btn btn-success">
                                                </a>

                                            </div>

                                        </div>

                                    </div>


                                    <?php
                                }

                            }
                        }
                        else {
                            ?>
                        <div class="col-12">
                            <div class="card card-stats">
                                <div class="card-body ">
                                    <div class="alert alert-danger">
                                        <h5 style="text-align: right;color: #3a283d">
                                            لا يوجد قداسات بعد
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                            <?php
                        }
                        ?>



                    </div>
                </form>
                <?php
            }
            else
            {
                ?>
                <div class="card card-stats">
                    <div class="card-body ">
                        <div class="alert alert-primary">


                            <h5 style="text-align: right;color: #3a283d">
                                برجاء الموافقة علي التعهد حتي تتمكن من حجز القداسات

                            </h5>


                        </div>

                    </div>

                </div>
                <?php
            }
            ?>
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
}
else
{

    header('Location: ../../index.php');

}
?>