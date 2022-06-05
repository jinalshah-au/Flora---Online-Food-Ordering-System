<?php
session_start(); // Session start for particular user to track the activity
include('controller/controller.php'); // including controller file 
$controller = new controller(); // Creating object of controller 

// Checking the type of user and if incorrect then it will show error in the popup box
if(isset($_POST['signin'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $type = $_POST['type'];

    if($type == "User" || $type == "Admin" || $type == "Driver" && !isEmpty($username) && !isEmpty($password) && !isEmpty($type)){

    if($type == "User"){
        $data = controller::authenticateUser($username,$password);
        if(gettype($data)== "boolean"){
            echo "<script> alert('Wrong username or password.')</script>";
        }else{
            $_SESSION['username'] = $data->getName();
            $_SESSION['email'] = $data->getEmail();
            $_SESSION['id'] = $data->getId();
            $_SESSION['password'] = $data->getPassword();
            $_SESSION['type'] = "user";
            echo "<script> window.location = 'orders.php'; </script>";
        }
    }
    if($type == "Admin"){
        $data = controller::authenticateAdmin($username,$password);
        if(gettype($data)== "boolean"){
            echo "<script> alert('Wrong username or password.')</script>";
        }else{
            $_SESSION['id'] = $data->getId();
            $_SESSION['email'] = $data->getEmail();
            $_SESSION['type'] = "admin";
            echo "<script> window.location = 'AdminDashboard.php'; </script>";
        }
    }
    if($type == "Driver"){
        $data = controller::authenticateDriver($username,$password);
        if(gettype($data)== "boolean"){
            echo "<script> alert('Wrong username or password.')</script>";
        }else{
            $_SESSION['id'] = $data->getId();
            $_SESSION['email'] = $data->getEmail();
            $_SESSION['type'] = "driver";
            echo "<script> window.location = 'DriverDashboard.php'; </script>";
        }
    }
}else{
    echo "<script> alert('All fields are mandatory.')</script>";
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
    <title>Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        :root{
            --green:#27ae60;
            --black:#192a56;
            --light-color:#666;
            --box-shadow:0 .5rem 1.5rem rgba(0,0,0,.1);
        }

        .center-div {
            position: absolute;
            top: 0;
            bottom: 0;
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

            height:60px;
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
            padding-right:15px;
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

        header .logo{
            color:var(--black);
            font-size: 25px;
            font-family: 'Nunito', sans-serif;
            font-weight: bolder;
            margin-right:20px;
            text-decoration: none;
        }
        
        header .logo i{
            color:var(--green);
        }
        
    </style>

    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

</head>

<body>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>

    <header>

        <a href="#" class="logo"><i class="fas fa-utensils"></i>FLORA</a>

        <nav class="navbar">
            <a class="active" href="index.php" style="font-size:16px;color:white;text-decoration:none;">home</a>
        </nav>

    </header>


    <div class="center-div " style="color:#108d25;text-align:center; margin:70px;font-size:28px;font-weight:bold;">
        Sign In
    </div>
    <div class="center-div"
        style="box-shadow: var(--box-shadow);z-index: 1000;width:370px; height:310px;font-size: 17px;border-style:solid;border-color:#108d25;border-width:2px;border-radius:20px;padding-top:20px;">
        <form method="POST">
        <div style="text-align:center;">
            <label>Username :</label>
            <input class="input-design" type="text" name="username" placeholder="Enter username or email" />
            <br />
            <label> Password : </label>
            <input class="input-design" type="password" name="password" placeholder="Enter password" />
            <br>
            <!-- Example single danger button -->
            <div class="btn-group" style="margin-right: 15px;">
                <button id="selectType" class="btn btn-success dropdown-toggle" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    Select Type
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" onclick="selectedType('Admin')">Admin</a></li>
                    <li><a class="dropdown-item" onclick="selectedType('User')">Customer</a></li>
                    <li><a class="dropdown-item" onclick="selectedType('Driver')">Driver</a></li>
                </ul>
            </div>
            <input type="hidden" name="type" id="type" value="" />

            <button type="submit" name="signin" class="btn btn-success" style="margin:35px;width:90px;">Sign in</button>

            <br>
             Don't have account? <a href="CustomerRegistration.php"> Sign Up </a>
            <br>
        </div>
        </form>
    </div>

    <script>
        function selectedType(type) {
            document.getElementById('selectType').innerHTML = type;
            document.getElementById('type').value = type;
        }
    </script>

</body>

</html>