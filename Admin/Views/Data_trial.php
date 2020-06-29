<?php
ob_start();
session_start();

include '../../Models/database.php';
$db = new database();
$connect = $db->connects;
$today = date("Y-m-d");



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../assets/img/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>
        Oudasy-Admin
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
</head>

<body class="">
<div class="wrapper ">
    <?php include "Sidebar.php"; ?>
    <div class="main-panel" >
        <!-- Navbar -->
        <?php include "navbar.php"; ?>

        <!-- End Navbar -->
        <div class="content">
            <form method="post" action="../../Controller/AttendanceController.php">
                <div class="row">
                    <div class="col-12">
                        <div class="card card-stats">
                            <div class="card-body ">
                                <div class="row">
                                    <div class="col-12">

                                    </div>
                                    <?php
                                    $sql = "SELECT username,secqu,nid,mobile,serial_no from users where user_type ='U' ";
                                    $result = mysqli_query($connect,$sql);
                                    ?>
                                    <table class="table table-bordered"  id="tabledata"  style="text-align:center;">
                                        <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">الأسم</th>
                                            <th scope="col">الرقم القومي</th>
                                            <th scope="col">رقم الموبايل</th>
                                            <th scope="col">السؤال الأمني</th>

                                        </tr>
                                        </thead>
                                        <?php
                                        if($result->num_rows>0)
                                        {
                                            while($row = $result->fetch_assoc())
                                            {
                                                ?>
                                                <tr>
                                                    <td><?php echo $row["serial_no"]?></td>
                                                    <td><?php echo $row["username"]?></td>
                                                    <td><?php echo $row["nid"]?></td>
                                                    <td><?php echo $row["mobile"]?></td>
                                                    <td><?php echo $row["secqu"]?></td>
                                                </tr>
                                                <?php

                                            }
                                        }
                                        ?>

                                    </table>

                                </div>



                            </div>
                        </div>
                    </div>
                </div>
            </form>

            <div style="text-align: center">
                <!--                <button class="btn btn-info" onclick="window.print()">Print report</button>-->
                <button class="btn btn-success" onclick="downloadDoc()">Download PDF</button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="../assets/js/jquery.js"></script>

<script type="text/javascript" src="../assets/js/pdfmake.min.js"></script>

<script type="text/javascript" src="../assets/js/html2canvas.min.js"></script>

<script type="text/javascript">
    function downloadDoc(){

        html2canvas($("#tabledata")[0],{
            onrendered:function(canvas){
                var data=canvas.toDataURL();
                var docDefinition={
                    content:[{
                        image:data,
                        width:500
                    }]
                };
                pdfMake.createPdf(docDefinition).download("Table.pdf");
            }
        })



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
