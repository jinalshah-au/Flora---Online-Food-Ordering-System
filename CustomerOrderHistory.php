<?php
session_start();
include 'controller/controller.php';
$controller = new controller();
$username = null;
$id = null;
$orderList = null;
$orderDetailList = null;

if (isset($_SESSION['username']) || isset($_SESSION['id'])) {
    $username = $_SESSION['username'];
    $id = $_SESSION['id'];
    $type = $_SESSION['type'];

    if(isset($_GET['id'])){
        $order_id = $_GET['id'];
        $cart = controller::getOrderById($order_id);
        if (gettype($cart) == "boolean") {
            echo "<script> window.location = 'orders.php'; </script>";
        } else {
            list($orderList, $orderDetailList) = $cart;
        }
    }else{
        $cart = controller::getOrderHistory($id);
        if (gettype($cart) == "boolean") {
            echo "<script> window.location = 'orders.php'; </script>";
        } else {
            list($orderList, $orderDetailList) = $cart;
        }
    }
} else {
    echo "<script> window.location = 'orders.php'; </script>";
}

function isEmpty($value){
    return $value == null;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order History</title>


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <style>
    :root {
        --green: #27ae60;
        --black: #192a56;
        --light-color: #666;
        --box-shadow: 0 .5rem 1.5rem rgba(0, 0, 0, .1);
    }

    .center-div {
        position: static;
        margin-top: 50px;
        left: 0;
        right: 0;
        margin: auto;
    }

    .input-design {
        border-style: solid;
        border-color: #bab9b8;
        height: 36px;
        width: 180px;
        border-radius: 10px;
        border-width: 1px;
        margin: 15px;
        font-size: 14px;
        padding: 5px;
    }


    header {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        justify-content: space-between;
        height: 60px;
        background: #fff;
        padding: 1rem 7%;
        display: flex;
        align-items: center;
        z-index: 1000;
        box-shadow: var(--box-shadow);
    }

    header .navbar a {
        font-size: 1.5rem;
        border-radius: .5rem;
        padding-right: 15px;
        padding-left: 15px;
        padding-top: 5px;
        padding-bottom: 5px;
        color: var(--light-color);
    }

    header .navbar a.active,
    header .navbar a:hover {
        color: #fff;
        background: var(--green);
    }

    header .logo {
        color: var(--black);
        font-size: 25px;
        font-family: 'Nunito', sans-serif;
        font-weight: bolder;
        margin-right: 20px;
        text-decoration: none;
    }

    header .logo i {
        color: var(--green);
    }

    label {
        margin: 5px;
    }
    </style>

    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

</head>

<body>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>

    <header>

        <a href="#" class="logo"><i class="fas fa-utensils"></i>FLORA</a>

        <nav class="navbar">
            <a class="active" href="index.php"
                style="font-size:16px;color:white;text-decoration:none;margin-right:17px;">Home</a>
        </nav>

        <div class="navbar" style="text-decoration: none;">
            <a href="Logout.php" class="active" id="signOutBtn"
                style="font-size:16px;color:white;text-decoration:none;margin-right:17px;">Sign out</a>
        </div>

    </header>

    <?php

    if(isEmpty($orderList) || isEmpty($orderDetailList)){
        echo "<script> window.location = 'orders.php'; </script>";
    }
    for($i=0; $i <count($orderList); $i++){
        $order = $orderList[$i];
    ?>

    <div class="center-div " style="color:#108d25;text-align:center; margin:70px;font-size:28px;font-weight:bold;">
        Orders Id <?php echo $order->getOrderId(); ?>
    </div>

    <div class="center-div"
        style="box-shadow: var(--box-shadow);z-index: 1000;width:50%; height:fit-content;font-size: 17px;border-style:solid;border-color:#108d25;border-width:2px;border-radius:20px;padding-top:20px;">

        <div style="text-align:left; padding: 35px;">
            <label>Date : <?php echo $order->getDate(); ?></label>
            <br />
            <label> Payment mode : <?php echo $order->getPaymentMode(); ?></label>
            <br>
            <label> Status : <?php 
                    $status =  $order->getStatus();
                    $id_ = $order->getOrderId();
                    echo "<b><p id='$id_' style='padding:5px;display:inline;'>". $status . "</p></b>";
                    if(strtolower($status) == "received"){
                        echo "<script> document.getElementById('$id_').style.color = 'blue'; </script>";
                    }else if(strtolower($status) == "prepared"){
                        echo "<script> document.getElementById('$id_').style.color = '#fcba03'; </script>";
                    }else if(strtolower($status) == "delivered"){
                        echo "<script> document.getElementById('$id_').style.color = 'green'; </script>";
                    }else if(strtolower($status) == "cancelled"){
                        echo "<script> document.getElementById('$id_').style.color = 'red'; </script>";
                    }
                    ?> </label>
            <br>
            <div
                style="width:fit-content;background: gainsboro;border-style:dashed;border-width:thin;border-color:grey;padding:5px;">

                <?php 
            $orderDetailSubList = $orderDetailList[$i];
            for($j =0; $j < count($orderDetailSubList); $j++){
                $orderDetail = $orderDetailSubList[$j];
                $dish = controller::getDishById($orderDetail->getDish_id());
            ?>
                <label>
                    <?php echo $dish->getTitle(). " ("."$" .  $dish->getPrice(). " x ". $orderDetail->getQuantity() . ") = ". ("$" . $dish->getPrice() * $orderDetail->getQuantity()); ?></label>
                <br>
                <?php } ?>
            </div>
            <label> Total price : <?php echo "$" . $order->getTotalPrice(); ?></label>
            <!-- Example single danger button -->

            <br>
            <br>
        </div>
    </div>

    <?php
        }
    ?>

    <div style="height: 50px;"></div>

</body>

</html>