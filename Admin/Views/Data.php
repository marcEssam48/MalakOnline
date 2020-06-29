<?php
ob_start();
session_start();
if(isset($_SESSION['username']) && !empty($_SESSION['username']) && $_SESSION['username'] == "Admin") {
include '../../Models/database.php';
$db = new database();
$connect = $db->connects;
$today = date("Y-m-d");




?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <!--<link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">-->
    <link rel="icon" type="image/png" href="../assets/img/malak.jpeg">
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
    <?php include "Sidebar.php"; ?>
    <div class="main-panel" >
        <!-- Navbar -->
        <?php include "Navbar.php"; ?>

        <!-- End Navbar -->
        <div class="content">
            <form method="get" action="../../Controller/DeleteAccount.php">
                <div class="row">
                    <div class="col-12">
                        <div class="card card-stats">
                            <div class="card-body ">
                                <div class="row" style="overflow:auto;">
                                    <div class="col-12">

                                    </div>
                                    <?php
                                    $sql = "SELECT user_id,username,secqu,nid,mobile,serial_no,ansqu from users where user_type ='U' ";
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
                                            <th scope="col">الإجابة </th>
                                            <th scope="col">Action </th>

                                        </tr>
                                        </thead>
                                        <?php
                                        if($result->num_rows>0)
                                        {
                                            while($row = $result->fetch_assoc())
                                            {
                                                ?>
                                                <div id="myModal" class="modal">

                                                    <!-- Modal content -->
                                                    <div class="modal-content" style="text-align: center">

                                                        <p>هل أنت متأكد من إلغاء الحساب ؟</p>

                                                        <a href="../../Controller/DeleteAccount.php?id=<?php echo $row["user_id"]?>"><input type="button" class="btn btn-success" value="نعم"></input></a>
                                                        <a><input type="button"  class="btn btn-danger" onclick="closeFunction()" value="لا" ></input></a>
                                                    </div>

                                                </div>
                                                <tr>
                                                    <td><?php echo $row["serial_no"]?></td>
                                                    <td><?php echo $row["username"]?></td>
                                                    <td><?php echo $row["nid"]?></td>
                                                    <td><?php echo $row["mobile"]?></td>
                                                    <td><?php echo $row["secqu"]?></td>
                                                    <td><?php echo $row["ansqu"]?></td>
                                                    <td><a href="../../Controller/DeleteAccount.php?id=<?php echo $row["user_id"]?>"><input type="button"  name="del" value="Delete" class="btn btn-danger"/></a></td>

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
                <!--                <button class="btn btn-success" onclick="downloadDoc()">Download PDF</button>-->
            </div>
        </div>
        <?php include 'footer.php';?>
    </div>
</div>
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
<?php
}
else
{
    header('Location: ../../index.php');
}
?>