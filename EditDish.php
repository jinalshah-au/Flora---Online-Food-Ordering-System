<?php

include("controller/controller.php");
$controller = new controller();
$id = null;
$dishItem = null;
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $dishItem = controller::getDishById($id);
    if(gettype($dishItem) == "boolean"){
        echo "<script> window.location='AdminDish.php' </script>";
    }
}else{
    echo "<script> window.location='AdminDish.php' </script>"; 
}

if(isset($_POST['submit'])){

    $fileName = $_FILES['image']['tmp_name'];
    $file = "";
    if(!isEmpty($fileName)){
        $file = addslashes(file_get_contents($fileName));
    }
    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $category = $_POST['category'];
    $cholestrol = $_POST['cholestrol'];
    $carbs = $_POST['carbs'];
    $protein = $_POST['protein'];

    if(isEmpty($title) || isEmpty($description) || isEmpty($price) || isEmpty($category) || isEmpty($cholestrol) || isEmpty($carbs) || isEmpty($protein)){
        echo "<script> alert('All fields are mandatory.')</script>";
    }else{
        $dish = new Dish($id,$price,$title,$description,$category,$cholestrol,$protein,$carbs,"","");
        if(controller::updateDish($dish)){
            echo "<script> alert('Updated successfully.')</script>";
            echo "<script> window.location='AdminDish.php' </script>"; 
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
                class="fas fa-utensils"></i>OFOS.</a>

        <nav class="navbar">
            <a class="btn" href="AdminDashboard.php"
                style="text-align:center;color:white;margin-bottom:10px;margin-right:17px; font-size:18px;background:var(--green);">home</a>
        </nav>
    </header>

    <div class="center-div " style="color:#108d25;text-align:center; margin-top:70px;font-size:28px;font-weight:bold;">
        Edit Dish <?php echo " #".$dishItem->getId(); ?>
    </div>

    <div style="margin-left:20px;margin-right:20px;padding:40px;font-size:18px;">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col" style="margin:10px;padding:10px;">
                    Title :
                    <input type="text" value="<?php echo $dishItem->getTitle(); ?>" name="title" id="title" class="form-control" style="margin:10px;" placeholder="title">
                </div>
                <div class="col" style="margin:10px;padding:10px;">
                    Description :
                    <input type="text" value="<?php echo $dishItem->getDescription(); ?>" name="description" id="description" class="form-control" style="margin:10px;" placeholder="description">
                </div>
            </div>

            <div class="row">
                <div class="col" style="margin:10px;padding:10px;">
                    Price :
                    <input type="text" value="<?php echo $dishItem->getPrice(); ?>" name="price" class="form-control" style="margin:10px;" placeholder="price">
                </div>
                <div class="col" style="margin:10px;padding:10px;">
                    <label for="formFile" class="form-label">Photo</label>
                    <input class="form-control" type="file" name="image" id="formFile">
                </div>
            </div>
            <div class="row">
                <div class="col" style="margin:10px;padding:10px;">
                    Category :
                    <input type="text" value="<?php echo $dishItem->getCategory(); ?>" name="category" class="form-control" style="margin:10px;" placeholder="Category">
                </div>
                <div class="col" style="margin:10px;padding:10px;">
                    Cholestrol :
                    <input type="text" value="<?php echo $dishItem->getCholestrol(); ?>" name="cholestrol" class="form-control" style="margin:10px;" placeholder="Cholestrol">
                </div>
            </div>

            <div class="row">
                <div class="col" style="margin:10px;padding:10px;">
                    Carbs :
                    <input type="text" value="<?php echo $dishItem->getCarbs(); ?>" name="carbs" class="form-control" style="margin:10px;" placeholder="Carbs">
                </div>
                <div class="col" style="margin:10px;padding:10px;">
                    Protein :
                    <input type="text" value="<?php echo $dishItem->getProtein(); ?>" name="protein" class="form-control" style="margin:10px;" placeholder="Protein">
                </div>
            </div>

            <button class="bttn" type="submit" name="submit"
                style="font-size:17px;background:var(--green);border-style:none; margin-right:20px;display:inline;">Submit</button>

                <!-- <div class="g-signin2" data-onsuccess="onSignIn" data-theme="dark" style="float:right;"></div> -->
    
        </form>
    </div>

</body>

</html>