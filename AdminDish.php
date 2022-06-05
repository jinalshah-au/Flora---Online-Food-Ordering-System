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

if(isset($_POST['add'])){
    $id = $_POST['add'];
    echo "<script> window.location = 'EditDish.php?id=". $id ."'; </script>";
}

if(isset($_POST['del'])){
    $id = $_POST['del'];
    controller::deleteDish($id);
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dishes</title>

    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="style.css">

    <style>
    p {
        margin: 15px;
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
            <a href="AddDish.php" style="text-decoration: none;">Add Dish</a>
            <a href="Logout.php" style="text-decoration: none;">Sign out</a>


        </div>

    </header>

    <div class="wrapper" style="margin-top: 60px;">
        <div class="sidebar">
            <ul>
                <li>
                    <a href="AdminHome.php">
                        <span class="item">Home</span>
                    </a>
                </li>
                <li>
                    <a href="AdminDashboard.php">
                        <span class="item">Order</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="active">
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



    <div class="wrapper-div">
        <form method="post">
            <?php

            $dishList = controller::getDishes();
            for ($i = 0; $i < count($dishList); $i++) {
                $dish = $dishList[$i];

            ?>
            <div style="height:200px;font-size:18px; width:100%;padding-top:25px">
                <fieldset>
                    <!-- <legend>burger</legend> -->
                    <?php
                    echo "<img src='data:image;base64," . base64_encode($dish->getImage()) . "' style='width:100px;height:100px;margin:10px;clear:left;float:left;border-style:solid;border-width:0px;padding:5px; border-radius:8px;'/>"; ?>
                </fieldset>
                <br />
                <p style="padding-right:60px;display:inline;">Title</p>
                <span style="text-align:justify;padding:3px;"> <?php echo $dish->getTitle(); ?></span><br><br>
                <p style="padding-right:20px;display:inline;">Description</p>
                <span style="text-align:justify;padding:3px;"> <?php echo $dish->getDescription(); ?></span><br>
                <p style="padding-right:60px;display:inline;">price</p>
                <span style="text-align:justify;padding:3px;font-weight:bold;color:green;">
                    <?php echo "$" . $dish->getPrice(); ?> </span>

                <!-- <input type="number" name="" value="0" min="1" max="10" step="1" style="width:50px;border-style:solid;border-width:1px;padding:5px; border-radius:4px;"/> -->
                <button class="btn" name="add" value="<?php echo $dish->getId();  ?>"
                    style="background:var(--green);padding:10px;margin:20px;">Edit</button>
                <button class="btn" name="del" value="<?php echo $dish->getId();  ?>"
                    style="background:var(--green);padding:10px;margin:20px;">Delete</button>

                <br>
            </div>
            <hr>
            <?php 
}
?>
        </form>

    </div>

    <script>

    </script>

</body>

</html>