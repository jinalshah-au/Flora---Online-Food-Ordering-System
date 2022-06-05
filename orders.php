<?php
session_start();
include 'controller/controller.php';
$controller = new controller();
$username = null;
$id = null;
$cart = null;
$idListOfCartItem = array();
if (isset($_SESSION['username']) || isset($_SESSION['id'])) {
    $username = $_SESSION['username'];
    $id = $_SESSION['id'];
    $type = $_SESSION['type'];

    if ($type == "admin") {
        echo "<script> window.location = 'AdminDashboard.php'; </script>";
    }
    $cart = controller::getCartItem($id);
    for ($i = 0; $i < count($cart); $i++) {
        $cartItem = $cart[$i];
        $idListOfCartItem[$i] = $cartItem->getDish_id();
    }
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OFOS</title>

    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="style.css">

    <!-- bootstrap css  -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">


    <style>
        .mainDiv {
            margin-top: 80px;
            margin-left: 30px;
            margin-right: 30px;
            font-size: 17px;
            display: inline-block;
        }

        .card {
            margin: 10px;
        }

        .card-title {
            font-size: 20px;
        }

        .card-body {
            font-size: 17px;
        }
    </style>
</head>

<body>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"
        integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB"
        crossorigin="anonymous"></script>


    <header>

        <a href="#" class="logo" style="text-decoration: none;"><i class="fas fa-utensils"></i>FLORA</a>

        <nav class="navbar">
            <a href="index.php" style="text-decoration: none;">Home</a>
            <a href="about.php" style="text-decoration: none;">About</a>
            <a class="active" href="orders.php" style="text-decoration: none;">Order</a>
        </nav>

        <div class="icons" style="text-decoration: none;">
            <i class="fas fa-bars" id="menu-bars"></i>
            <a href="Cart.php" class="fas fa-shopping-cart" style="text-decoration: none;"></a>
        </div>

        <div class="navbar" style="text-decoration: none;">
            <a href="Login.php" id="signInBtn" style="text-decoration: none;">Sign in</a>
            <a href="CustomerRegistration.php" id="signUpBtn" style="text-decoration: none;">Sign up</a>
            <a href="Logout.php" id="signOutBtn" style="text-decoration: none;">Sign out</a>
            <div class="icons" style="display: inline;">
                <i class="fas fa-user" onclick="window.location='CustomerProfile.php'"></i>
            </div>
        </div>

    </header>
    <?php
    if ($id != null) {
        echo "<script> document.getElementById('signInBtn').style.display = 'none'; </script>";
        echo "<script> document.getElementById('signUpBtn').style.display = 'none'; </script>";
    } else {
        echo "<script> document.getElementById('signOutBtn').style.display = 'none'; </script>";
    }
    ?>
    
    <div class="container" style="margin-top:80px;justify-content:left;">
    <div class="dropdown">
    <button style="font-size:18px;" class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
        Select Category
    </button>
    <ul style="font-size:18px;" class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
        <li><a class="dropdown-item" href="orders.php?cat=veg">Veg</a></li>
        <li><a class="dropdown-item" href="orders.php?cat=nonveg">Non Veg</a></li>
        <li><a class="dropdown-item" href="orders.php?cat=carbs">Carbs Rating(Low to High)</a></li>
        <li><a class="dropdown-item" href="orders.php">All</a></li>
    </ul>
    </div>
    <form method="post">
        <div class="row row-cols-3">

        <?php
    $dishList = null;
    if(isset($_GET['cat'])){
        $category = $_GET['cat'];
        
         
        $dishList = controller::getDishByCategory($category);
        if($category == "nonveg"){
            $category = "Non veg";
        }else if($category == "veg"){
            $category = "Veg";
        }else if($category == "carbs"){
            $category="Carbs";
        }
        echo "<script> document.getElementById('dropdownMenuButton1').innerHTML = '". $category ."'; </script>";

    }else{
        $dishList = controller::getDishes();
    }
    for ($i = 0; $i < count($dishList); $i++) {
        $dish = $dishList[$i];
        $quantityOfDish = 0;
        if ($id != null && $cart != null && in_array($dish->getId(), $idListOfCartItem)) {
            $key = array_search($dish->getId(), $idListOfCartItem);
            $quantityOfDish = $cart[$key]->getQuantity();
        }
    ?>
            <div class="col">
                <div class="card" style="width: fit-content; height: 500px;">
                <?php
                    echo "<img src='data:image;base64," . base64_encode($dish->getImage()) . "'  class='card-img-top' style='width:300px;height:250px;margin:10px;' />"; ?>
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $dish->getTitle(); ?> </h5>
                        <p class="card-text"><?php echo $dish->getDescription(); ?> <br>
                        <p style="font-size:15px;">Carbs : <?php echo $dish->getCarbs(); ?>  <i class="fas fa-star" style="color:green;"></i><br>
                        Protein : <?php echo $dish->getProtein(); ?>  <i class="fas fa-star" style="color:green;"></i><br>
                        Cholestrol : <?php echo $dish->getCholestrol(); ?> <i class="fas fa-star" style="color:green;"></i><br>
                        
                    </p>
                        </p>
                        Price : <i style="color:green;font-weight:bold;margin-right:25px;"> <?php echo "$" . $dish->getPrice(); ?></i>
                        <!-- <a href="#" class="btn" style="background:var(--green);color:white;font-size:16px;">Add to Cart</a> -->
                            <div class="btn-group" role="group" aria-label="Basic outlined example">
                                <button type="submit" name="minusBtn" value="<?php echo $dish->getId(); ?>" class="btn btn-outline-success" onclick="minustBtn()"><i class="fas fa-minus"></i></button>
                                <input type="text" id="<?php echo $dish->getId(); ?>" name="<?php echo $dish->getId(); ?>" value="<?php echo $quantityOfDish; ?>" style="pointer-events: none;width:35px" id="quantity" class="btn btn-outline-success"/>
                                <button type="submit" name="plusBtn" value="<?php echo $dish->getId(); ?>" class="btn btn-outline-success" onclick="plusBtn()"><i class="fas fa-plus"></i></button>
                              </div>
                    </div>
                </div>
            </div>

            <?php
}
?>

        </div>
    </form>
    </div>

    <?php

if (isset($_POST['minusBtn'])) {
    if ($id == null) {
        echo "<script> alert('First Login before ordering')</script>";
    } else {
        $dish_id = $_POST['minusBtn'];
        $quantity = $_POST[$dish_id];
        if ($quantity > 0) {
            echo "<script> document.getElementById('" . $dish_id . "').value = " . --$quantity . ";</script>";
            $temp_cart = new Cart($id, $dish_id, $quantity);
            controller::addToCart($temp_cart);
        }
    }
}

if (isset($_POST['plusBtn'])) {
    if ($id == null) {
        echo "<script> alert('First Login before ordering')</script>";
    } else {
        $dish_id = $_POST['plusBtn'];
        $quantity = $_POST[$dish_id];
        ++$quantity;
        echo "<script> document.getElementById('" . $dish_id . "').value = " . $quantity . ";</script>";
        $temp_cart = new Cart($id, $dish_id, $quantity);
        controller::addToCart($temp_cart);
    }
}

?>

</body>

</html>