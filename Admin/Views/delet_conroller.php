    <?php
    ob_start();
    session_start();

    include '../../Models/database.php';

    $db = new database();
    $connect = $db->connects;
    $today = date("Y-m-d");
    $slot_id = $_GET["id"];

    $sql = "Delete from slots where slot_id = $slot_id";
    $result = mysqli_query($connect,$sql);

    if($result)
    {
        include '../../Controller/head.php';

        ?>
        <div class="alert alert-danger" role="alert">
            Oudas Deleted
        </div>

        <div class="alert alert-primary" role="alert">
            You will be redirected back in 3 seconds
        </div>
        <?php

        header( "refresh:2;url=dashboard.php" );


    }
    ?>
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
