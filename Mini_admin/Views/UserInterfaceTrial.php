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

    $sql_serial = "Update users set serial_no = $serial_no_int where user_id = $user_id";
    $result_serial = mysqli_query($connect,$sql_serial);
    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8" />
        <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
        <link rel="icon" type="image/png" href="../../Admin/assets/img/church.jpg"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <title>
            Oudasy-User

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




