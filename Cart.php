<?php
session_start();
include 'controller/controller.php';
$controller = new controller();
$username = null;
$id = null;
$cartList = null;
$dishList = null;
$totalPrice = 0;
$user_email = null;
if (isset($_SESSION['username']) || isset($_SESSION['id'])) {
    $username = $_SESSION['username'];
    $id = $_SESSION['id'];
    $type = $_SESSION['type'];
    $user_email = $_SESSION['email'];
    $query = "";

    $cart = controller::getCartDishes($id);
    if (gettype($cart) == "boolean") {
        echo "<script> window.location = 'orders.php'; </script>";
    } else {
        list($dishList, $cartList) = $cart;
    }
} else {
    echo "<script> window.location = 'orders.php'; </script>";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">


    <style>
    :root {
        --green: #27ae60;
        --black: #192a56;
        --light-color: #666;
        --box-shadow: 0 .5rem 1.5rem rgba(0, 0, 0, .1);
    }

    .btn {
        font-size: 1.7rem;
        color: #fff;
        background: var(--green);
        border-radius: .5rem;
        cursor: pointer;
        padding: .8rem 3rem;
    }

    .btn:hover {
        background: var(--green);
        letter-spacing: .05rem;
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

    .cart {
        padding: 40px;
        margin-top: 20px;
    }

    p {
        margin: 15px;
    }

    fieldset {
        width: 100px;
        height: 130px;
        margin: 5px;
        margin-top: 10px;
        margin-right: 20px;
        clear: left;
        float: left;
        padding: 10px;
    }

    .coupon {
        margin-top: 100px;
        margin-left: 20px;
        margin-right: 20px;
        padding: 20px;
    }

    .coupon-a {
        border-style: solid;
        border-width: 0.7px;
        border-color: grey;
        padding: 12px;
        margin: 8px;
        text-align: center;
        border-radius: 6px;
        text-decoration: none;
        color: var(--green);
        cursor: pointer;
    }

    .coupon-a:hover {
        background: whitesmoke;
        color: darkgreen;
    }
    </style>

    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

</head>

<body>

    <header>

        <a href="#" class="logo"><i class="fas fa-utensils"></i>FLORA</a>

        <nav class="navbar">
            <a class="active" href="index.php"
                style="font-size:16px;color:white;text-decoration:none;margin-right:17px;">Home</a>
            <a class="active" href="CustomerOrderHistory.php"
                style="font-size:16px;color:white;text-decoration:none;margin-right:17px;">Order History</a>
        </nav>

        <div class="navbar" style="text-decoration: none;">
            <a href="Logout.php" class="active" id="signOutBtn"
                style="font-size:16px;color:white;text-decoration:none;margin-right:17px;">Sign out</a>
        </div>

    </header>

    <div class="cart">
        <form method="post">
            <?php
for ($i = 0; $i < count($dishList); $i++) {
    $dish = $dishList[$i];
    $cartItem = $cartList[$i];
    $totalPrice += $dish->getPrice() * $cartItem->getQuantity();
    ?>
            <div style="font-size:18px; width:100%;">
                <fieldset>
                    <!-- <legend> <?php //echo $dish->getTitle(); ?></legend> -->
                    <?php
                echo "<img src='data:image;base64," . base64_encode($dish->getImage()) . "'  style='width:100px;height:100px;margin:10px;clear:left;float:left;border-style:solid;border-width:0px;padding:5px; border-radius:8px;' />"; ?>

                    <!-- <img src='image/burger1.jpg'
                    style='width:100px;height:100px;margin:10px;clear:left;float:left;border-style:solid;border-width:0px;padding:5px; border-radius:8px;' /> -->
                </fieldset>
                <br />
                <p style="padding-left:20px;padding-right:20px;display:inline;">Description</p>
                <span style="text-align:justify;padding:3px;"> <?php echo $dish->getDescription(); ?> </span><br>
                <p style="padding-left:20px;padding-right:65px;display:inline;">price</p>
                <span style="text-align:justify;padding:3px;"> <?php echo $dish->getPrice(); ?> </span><br>
                <p style="padding-left:20px;padding-right:40px;display:inline;">Quantity</p>

                <div class="btn-group" role="group" aria-label="Basic outlined example">
                    <button type="submit" name="minusBtn" value="<?php echo $dish->getId(); ?>"
                        class="btn btn-outline-success" onclick="minustBtn()"><i class="fas fa-minus"></i></button>
                    <input type="text" id="<?php echo $dish->getId(); ?>" name="<?php echo $dish->getId(); ?>"
                        value="<?php echo $cartItem->getQuantity(); ?>" style="pointer-events: none;width:35px"
                        id="quantity" class="btn btn-outline-success" />
                    <button type="submit" name="plusBtn" value="<?php echo $dish->getId(); ?>"
                        class="btn btn-outline-success" onclick="plusBtn()"><i class="fas fa-plus"></i></button>
                </div>

                <br>
                <hr>
            </div>

            <?php
        }
        ?>
            <div class="coupon" style="margin-top: 0px;">

                <span style="color:var(--green);"><b>
                        <?php
        $afterDiscount = 0;
        $GST = 10;
        if($totalPrice >= 500){
            $afterDiscount = $totalPrice - (int) round(($totalPrice/100)*30);
        }else if($totalPrice >= 200){
            $afterDiscount = $totalPrice - (int) round(($totalPrice/100)*5);
        }
        $GST_amount =  ($totalPrice/100)*10;
        $totalPrice = $totalPrice + $GST_amount;
        if($afterDiscount != 0){
            echo "Total : ". $totalPrice . "$<br>";
            echo "Applied Coupon : -". ($totalPrice - $afterDiscount) . "$<br>";
            echo "GST : $GST_amount$<br>";
            echo "Final Amount : ". ($afterDiscount + $GST_amount) . "$"; 
        }else{
            echo "GST : $GST_amount$ <br>";
            echo "Total Amount : ". $totalPrice. "$"; 
        }
        ?></b></span>
            </div>

            <button type="submit" name="placeorder" class="btn"
                style="color:white;background: var(--green);float:right;margin-right:30px;margin-bottom:30px;position:relative;">Place
                order</button>
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
            if(controller::addToCart($temp_cart)){
                echo "<script> window.location = 'Cart.php'; </script>";
            }
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
        if(controller::addToCart($temp_cart)){
            echo "<script> window.location = 'Cart.php'; </script>";
        }
    }
}

if (isset($_POST['placeorder'])) {
    if ($id == null) {
        echo "<script> alert('First Login before ordering')</script>";
    } else {
        if($totalPrice != 0){
            if($afterDiscount != 0){
                $totalPrice = $afterDiscount;
            }
        $order_obj = new Order("","","","Cash on Delivery",$totalPrice,$id,"");
        $current_order_id = controller::placeOrder($order_obj,$cartList);
         if(gettype($current_order_id) != "boolean"){

        $order_link = "https://localhost/FLORA/CustomerOrderHistory.php?order_id=".$current_order_id;
        $to_email = $user_email;
        $subject = "Your order has been placed";
        $order_detail = "<p style='width:fit-content;background: gainsboro;border-style:dashed;border-width:thin;border-color:grey;padding:5px'>";
        for($i =0; $i< count($cartList); $i++){
            $cartItem = $cartList[$i];
            $dishItem = $dishList[$i];
            $order_detail = $order_detail ." ". $dishItem->getTitle()." (". $cartItem->getQuantity(). " x ". $dishItem->getPrice()."$) = ". ($cartItem->getQuantity() * $dishItem->getPrice()). "$ <br>" ; 
        }
        $order_detail = $order_detail."</p> <p style='color:green'> GST : $GST_amount$ <br>";
        $order_detail = $order_detail."Total Price :  ".( $totalPrice + $GST_amount )."$ <br></p>";
       
        $body =
        "
        <center>
        <p>
        Your order has been successfully placed.<br>
        Order id : #$current_order_id <br><br>
        <p>
        
        <p> $order_detail </p>
        <p> Hi please find the link for order detail here . $order_link </p>
        </center>
        ";
        $headers = "From: Flora <floraballarat@outlook.com>\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
        
        if (mail($to_email, $subject, $body, $headers)) {
            echo "Email successfully sent to $to_email...";
        } else {
            echo "Email sending failed...";
        }
        echo "<script> window.location = 'CustomerOrderHistory.php?id=". $current_order_id ."'; </script>";
         }
        }else{
            echo "<script> alert('Add Item first')</script>";
        }
    }
}

?>


</body>

</html>