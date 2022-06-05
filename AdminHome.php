<?php

session_start();
include 'controller/controller.php';
$controller = new controller();
$username = null;
$id = null;
if (isset($_SESSION['username']) && isset($_SESSION['id'])) {
    $username = $_SESSION['username'];
    $id = $_SESSION['id'];
    $type = $_SESSION['type'];
}

if (isset($_POST['add'])) {
    $id = $_POST['add'];
    echo "<script> window.location = 'EditCustomer.php?id=" . $id . "'; </script>";
}

if (isset($_POST['del'])) {
    $id = $_POST['del'];
    controller::deleteUser($id);
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User</title>

    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="style.css">

    <style>
    p {
        margin: 15px;
    }

    tr,
    td,
    th {
        margin: 5px;
        padding: 10px;
        text-align: center;
        font-size: 16px;
    }
    </style>

</head>

<body>

    <header style="justify-content:left;height:60px;">

        <a href="#" class="logo" style="margin-right: 15px;"><i class="fas fa-utensils"></i>FLORA</a>

        <nav class="navbar">
            <a class="btn" href="AdminDashboard.php"
                style="text-align:center;color:white;margin-bottom:10px; font-size:18px;background:var(--green);">Home</a>
        </nav>

        <div class="navbar" style="margin-left:10px;right:0;width:max-content;text-decoration: none;">
            <a href="Logout.php" style="text-decoration: none;">Sign out</a>
        </div>

    </header>

    <div class="wrapper" style="margin-top: 60px;">
        <div class="sidebar">
            <ul>
                <li>
                    <a href="#" class="active">
                        <span class="item">Home</span>
                    </a>
                </li>
                <li>
                    <a href="AdminDashboard.php">
                        <span class="item">Order</span>
                    </a>
                </li>
                <li>
                    <a href="AdminDish.php">
                        <span class="item">Dish</span>
                    </a>
                </li>
                <li>
                    <a href="AdminCustomer.php">
                        <span class="item">Users</span>
                    </a>
                </li>
                <li>
                    <a href="AdminDriver.php">
                        <span class="item">Delivery Drivers</span>
                    </a>
                </li>

            </ul>
        </div>

    </div>



    <div class="wrapper-div" style="position: relative; width:60%;">
    
    <p style="font-size:80px;color:green;font-weight:bold;">Welcome Admin</p>

    </div>

    <script>

    </script>

</body>

</html>