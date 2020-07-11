<?php
/**
 * Created by PhpStorm.
 * User: me250043
 * Date: 5/10/2020
 * Time: 11:37 AM
 */
if(isset($_SESSION['username']) && !empty($_SESSION['username']) && ( $_SESSION['username'] == "Admin" || $_SESSION['username'] == "Admin"))
{
    ?>
    <div class="sidebar">
        <div class="logo" style="background-color: #0c5460">

            <div class="logo-image-small" style="color: aliceblue">
                <img src="../assets/img/church.jpg" style="border-radius: 50%;width: 20%">
                كنيسة رئيس الملائكة الجليل ميخائيل

            </div>
            <!-- <p>CT</p> -->


            <!-- <div class="logo-image-big">
              <img src="../assets/img/logo-big.png">
            </div> -->

        </div>
        <div class="sidebar-wrapper" style="background-color: #0c5460">
            <ul class="nav">
                <li class="active ">
                    <a href="dashboard.php">
                        <i class="nc-icon nc-bank"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li>
                    <a href="./booking_slot.php">
                        <i class="nc-icon nc-ruler-pencil"></i>
                        <p>Add Oudas time</p>
                    </a>
                </li>
                <li>
                    <a href="./attendance.php">
                        <i class="fa fa-address-card-o"></i>
                        <p>Take Attendance</p>
                    </a>
                </li>

                <li>
                    <a href="./attendance_reports.php">
                        <i class="fa fa-file"></i>
                        <p>Attendance reports</p>
                    </a>
                </li>

                <li>
                    <a href="./Delete_oudas.php">
                        <i class="fa fa-trash"></i>
                        <p>Delete Oudas</p>
                    </a>
                </li>

                <li>
                    <a href="./Data.php">
                        <i class="fa fa-database"></i>
                        <p>Data</p>
                    </a>
                </li>

                <?php
                if(isset($_SESSION['username']) && !empty($_SESSION['username']) && $_SESSION['username'] == "Admin") {
                    ?>
                    <li>
                        <a href="./book_unbook.php">
                            <i class="fa fa-ticket"></i>
                            <p>Booking Problems</p>
                        </a>
                    </li>
                    <?php
                }
                else{
//                header('Location: ../../index.php');
                }
                ?>
                <!--<li>-->
                <!--    <a href="./map.html">-->
                <!--        <i class="fa fa-file"></i>-->
                <!--        <p>Reorts</p>-->
                <!--    </a>-->
                <!--</li>-->
                <li>
                    <a href="./stopped_names.php">
                        <i class="fa fa-stop-circle"></i>
                        <p>Cannot Book</p>
                    </a>
                </li>
                <li>
                    <a href="./oudas_action_center.php">
                        <i class="fa fa-stethoscope"></i>
                        <p>Oudas Action Center</p>
                    </a>
                </li>
                <li>
                    <a href="../../Controller/logout_controller.php">
                        <i class="nc-icon nc-button-power"></i>
                        <p>Sign out</p>
                    </a>
                </li>

            </ul>
        </div>
    </div>
    <?php
}
else{
    header('Location: ../../index.php');
}
?>
