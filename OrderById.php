<?php
include("controller/controller.php");
$controller = new controller();
$id = null;
$user = null;
$order = null;
$orderDetail = null;
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $orderDetails = controller::getOrderById($id);
    if (gettype($orderDetails) == "boolean") {
        echo "<script> window.location = 'AdminDashboard.php'; </script>";
    } else {
        $orderDetailList = null;
        $orderList = null;
        list($orderList, $orderDetailList) = $orderDetails;
        $order = $orderList[0];
        $orderDetail = $orderDetailList[0];
    }
    $user = controller::getUserById($order->getUser_id());
    if($user == null){
        echo "<script> window.location='AdminDashboard.php' </script>"; 
    }

}else{
    echo "<script> window.location='AdminDashboard.php' </script>"; 
}

if(isset($_POST['submit'])){

    $driver_id = $_POST['driverId'];
    $status = $_POST['orderStatus'];
    $order_final = new Order($id,$driver_id,$status,"","","","");
    if(controller::updateOrder($order_final)){
        echo "<script> alert('Updated successfully.')</script>";
        echo "<script> window.location='AdminDashboard.php' </script>"; 
    }
    
}

function isEmpty($value){
    if($value == null || strlen($value) == 0){
        return true;
    }
    return false;
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order</title>

    <style>
    :root {
        --green: #27ae60;
        --black: #192a56;
        --light-color: #666;
        --box-shadow: 0 .5rem 1.5rem rgba(0, 0, 0, .1);
    }

    .center-div {
        position: static;
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
            <a class="active" href="AdminDashboard.php" style="font-size:16px;color:white;text-decoration:none;">Home</a>
        </nav>

    </header>

    <form method="post">
        <div class="center-div " style="color:#108d25;text-align:center; margin:70px;font-size:28px;font-weight:bold;">
            Order Id : <?php echo $order->getOrderId();  ?>
        </div>
        <div class="center-div"
            style="box-shadow: var(--box-shadow);z-index: 1000;width:50%; height:fit-content;font-size: 17px;border-style:solid;border-color:#108d25;border-width:2px;border-radius:20px;padding-top:20px;">

            <div style="text-align:left; padding: 35px;">
                <label>Customer name : <?php echo $user->getName(); ?></label>
                <br />
                <label> Customer Id : <?php echo $order->getUser_id(); ?></label>
                <br>
                <label> Phone number : <?php echo $user->getPhone(); ?></label>
                <br>
                <label> Address : <?php echo $user->getAddress(); ?></label>
                <br>
                <label>Date : <?php echo $order->getDate(); ?></label>
                <br>
                <div
                style="width:fit-content;background: gainsboro;border-style:dashed;border-width:thin;border-color:grey;padding:5px;">

                <?php 
                for($j =0; $j < count($orderDetail); $j++){
                    $order_obj = $orderDetail[$j];
                    $dish = controller::getDishById($order_obj->getDish_id());
                ?>
                <label>
                    <?php echo $dish->getTitle(). " (". $dish->getPrice(). "$ x ". $order_obj->getQuantity() . ") = ". ($dish->getPrice() * $order_obj->getQuantity()) ."$"; ?></label>
                <br>
                <?php } ?>
            </div>
                <label>Total Price : <?php echo $order->getTotalPrice() ."$"; ?></label>
                <br>
                <label> Order status </label>
                <!-- Example single danger button -->
                <div class="btn-group" style="margin-right: 15px;">
                    <button type="button" id="selectStatus" class="btn btn-success dropdown-toggle"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <?php echo $order->getStatus(); ?>
                    </button>
                    <ul class="dropdown-menu">
                        <input type="hidden" id="orderStatus" name="orderStatus" value="<?php echo $order->getStatus(); ?>"/>
                        <li><a class="dropdown-item" onclick="selectStatus('Received')">Received</a></li>
                        <li><a class="dropdown-item" onclick="selectStatus('Prepared')">Prepared</a></li>
                        <li><a class="dropdown-item" onclick="selectStatus('Delivered')">Delivered</a></li>
                        <li><a class="dropdown-item" onclick="selectStatus('Cancelled')">Cancelled</a></li>
                    </ul>
                </div>
                <label> Assign order </label>
                <div class="btn-group" style="margin-right: 15px;">

                    <button type="button" id="selectAssignees" class="btn btn-success dropdown-toggle"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <?php
                        if($order->getDriverId() != 0){
                            $driver = controller::getDriverById($order->getDriverId());
                            echo $driver->getName();
                        }else{
                            echo "Select Driver";
                        }
                         ?>
                    </button>
                    <ul class="dropdown-menu">
                        <input type="hidden" id="driverId" value="<?php echo $order->getDriverId(); ?>" name="driverId"/>
                        <?php
                        $drivers = controller::getDrivers();
                        for ($i = 0; $i < count($drivers); $i++) {
                            $driver = $drivers[$i];
                        ?>
                        <li><a class="dropdown-item"
                                onclick="selectAssignee('<?php echo $driver->getId();  ?>','<?php echo $driver->getName();  ?>')" ><?php echo $driver->getName();  ?></a>
                        </li>
                        <?php } ?>
                    </ul>


                </div>
                <br>
                <br>

                <button type="submit" name="submit" class="btn btn-success" style="width:90px;">Done</a>
            </div>
        </div>
    </form>
    <script>
    function selectStatus(type) {
        document.getElementById('selectStatus').innerHTML = type;
        document.getElementById('orderStatus').value = type;
    }

    function selectAssignee(id, name) {
        document.getElementById('selectAssignees').innerHTML = name;
        document.getElementById('driverId').value = id;
    }
    </script>
<div style="height: 50px;"></div>
</body>

</html>