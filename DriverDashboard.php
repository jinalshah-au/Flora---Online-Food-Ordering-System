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

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders</title>

    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="style.css">

    <style>
        tr, td, th{
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
            <a class="btn" href="DriverDashboard.php" style="text-align:center;color:white;margin-bottom:10px; font-size:18px;background:var(--green);">Home</a>
        </nav>
        <div class="navbar" style="margin-left:10px;right:0;width:max-content;text-decoration: none;">
            <a href="Logout.php" style="text-decoration: none;">Sign out</a>


        </div>

    </header>

    <div class="wrapper" style="margin-top: 56px;">
        <div class="sidebar">
        <ul>
                <li>
                    <a href="#" class="active">
                        <!-- <span class="icon"><i class="fas fa-book"></i></span> -->
                        <span class="item">Order For Delivery</span>
                    </a>
                </li>                
                
                <!-- <li>
                    <a href="editDriverById.php">
                        <span class="icon"><i class="fas fa-tachometer-alt"></i></span> -->
                      <!--  <span class="item">Delivery Drivers</span>
                    </a>
                </li> -->


            </ul>
        </div>
        
        </div>
        <div class="wrapper-div">
            
            <table style="width: 100%;">
                <tr style="background-color:gainsboro;">
                    <th>Order id</th>
                    <th>User ID</th> 
                    <th>Amount</th>
                    <th>Date and Time</th>
                    <th>Order status</th>
                </tr>
                <?php
                $orders = controller::getDriverOrders($_SESSION['id']);
                
                for ($i = 0; $i < count($orders); $i++) {
                    $order = $orders[$i];
                    
                ?>

                <tr>
                    <td><a class="btn" style="color:black;" onclick="viewOrder('<?php echo $order->getOrderId(); ?>')"><?php echo $order->getOrderId();  ?></a></td>
                    <td><?php echo $order->getUser_id();  ?></td>
                    <td><?php echo "$" . $order->getTotalPrice();  ?></td>
                    <td><?php echo $order->getDate();  ?></td>
                    <td><?php 
                    $status =  $order->getStatus();
                    $id_ = $order->getOrderId();
                    echo "<p id='$id_' style='background:whitesmoke;padding:5px;'>". $status . "</p>";
                    if(strtolower($status) == "received"){
                        echo "<script> document.getElementById('$id_').style.color = 'blue'; </script>";
                    }else if(strtolower($status) == "prepared"){
                        echo "<script> document.getElementById('$id_').style.color = '#fcba03'; </script>";
                    }else if(strtolower($status) == "delivered"){
                        echo "<script> document.getElementById('$id_').style.color = 'green'; </script>";
                    }else if(strtolower($status) == "cancelled"){
                        echo "<script> document.getElementById('$id_').style.color = 'red'; </script>";
                    }
                    ?></td>
                   

                </tr>
                <?php

                }
                ?>
   
                
            </table>

        </div>

        <script>
            function viewOrder($order_id){
                window.location = 'OrderForDriver.php?id='+$order_id;
            };
        </script>

  <script>

  </script>

</body>
</html>