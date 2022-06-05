<?php
include("controller/controller.php");
$controller = new controller();
if(isset($_POST['submit']) && isset($_FILES['image'])){

    $fileName = $_FILES['image']['tmp_name'];
    $file = "";
    if(!isEmpty($fileName)){
        $file = addslashes(file_get_contents($fileName));
    }
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $address = $_POST['addr'];
    $phone = $_POST['phoneNo'];

    if(isEmpty($file) || isEmpty($email) || isEmpty($password) || isEmpty($username) || isEmpty($address) || isEmpty($phone)){
        echo "<script> alert('All fields are mandatory.')</script>";
    }else{
        if(controller::isUserExist($email)){
            echo "<script> alert('Account already exist for this email')</script>";
        }else{
            $user = new Customer('',$email,$username,$file,$phone,$password,$address);
            if(controller::createUser($user)){
                echo "<script> window.location = 'Login.html';</script>";
            }
        }
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

    <title>Profile</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <style>
        :root {
            --green: #27ae60;
            --black: #192a56;
            --light-color: #666;
            --box-shadow: 0 .5rem 1.5rem rgba(0, 0, 0, .1);
        }


        .bttn {
            margin-top: 1rem;
            display: inline-block;
            font-size: 1.7rem;
            color: #fff;
            /* background: var(--black); */
            border-radius: .5rem;
            cursor: pointer;
            padding: .8rem 3rem;
        }

        .bttn:hover {
            background: var(--green);
            letter-spacing: .1rem;
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

        .center-div {
            position: relative;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            margin: auto;
        }
    </style>

</head>

<body>


    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>

    <header style="justify-content:left;height:60px;">

        <a href="#" class="logo" style="margin-right: 15px;text-decoration:none;"><i
                class="fas fa-utensils"></i>FLORA</a>

        <nav class="navbar">
            <a class="btn" href="index.php"
                style="text-align:center;color:white;margin-left:17px; font-size:18px;background:var(--green);">home</a>
        </nav>
    </header>

    <div class="center-div " style="color:#108d25;text-align:center; margin-top:70px;font-size:28px;font-weight:bold;">
        Customer Registration
    </div>

    <div style="margin-left:20px;margin-right:20px;padding:40px;font-size:18px;">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col" style="margin:10px;padding:10px;">
                    Name :
                    <input type="text" name="username" id="username" class="form-control" style="margin:10px;" placeholder="Enter Username">
                </div>
                <div class="col" style="margin:10px;padding:10px;">
                    Email :
                    <input type="text" name="email" id="email" class="form-control" style="margin:10px;" placeholder="example@gmail.com">
                </div>
            </div>

            <div class="row">
                <div class="col" style="margin:10px;padding:10px;">
                    Password :
                    <input type="password" name="password" class="form-control" style="margin:10px;" placeholder="Password">
                </div>
                <div class="col" style="margin:10px;padding:10px;">
                    <label for="formFile" class="form-label">Photo</label>
                    <input class="form-control" type="file" name="image" id="formFile">
                </div>
            </div>
            <div class="row">
                <div class="col" style="margin:10px;padding:10px;">
                    Address :
                    <input type="text" name="addr" class="form-control" style="margin:10px;" placeholder="Address(eg. unit 1/6 main st,battarat)">
                </div>
                <div class="col" style="margin:10px;padding:10px;">
                    Phone No. :
                    <input type="text" name="phoneNo" class="form-control" style="margin:10px;" placeholder="Phone number (eg. 0456 xxx xxx)">
                </div>
            </div>

            <button class="bttn" type="submit" name="submit"
                style="font-size:17px;background:var(--green);border-style:none; margin-right:20px;display:inline;">Submit</button>

                <!-- <div class="g-signin2" data-onsuccess="onSignIn" data-theme="dark" style="float:right;"></div> -->
    
        </form>
    </div>
    <script>


        /*
        function onSignIn(googleUser) {
          // Useful data for your client-side scripts:
            alert('logging in');
          var profile = googleUser.getBasicProfile();
          alert(profile.getEmail());
          console.log("ID: " + profile.getId()); // Don't send this directly to your server!
          console.log('Full Name: ' + profile.getName());
          console.log('Given Name: ' + profile.getGivenName());
          console.log('Family Name: ' + profile.getFamilyName());
          console.log("Image URL: " + profile.getImageUrl());
          console.log("Email: " + profile.getEmail());

          document.getElementById('username').innerHTML = profile.getName();
          document.getElementById('email').innerHTML = profile.getEmail();
  
          // The ID token you need to pass to your backend:
          var id_token = googleUser.getAuthResponse().id_token;
          console.log("ID Token: " + id_token);
        }
        */
      </script>

</body>

</html>