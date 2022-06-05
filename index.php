<?php
session_start();
$username = null;
$id = null;
if (isset($_SESSION['type']) && isset($_SESSION['id'])) {
    $id = $_SESSION['id'];
    $type = $_SESSION['type'];

    if ($type == "admin") {
        echo "<script> window.location = 'AdminDashboard.php'; </script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
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
        a{
          text-decoration: none;
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
            <a class="active" href="index.php" style="text-decoration: none;">Home</a>
            <a href="about.php" style="text-decoration: none;">About</a>
            <a href="orders.php" style="text-decoration: none;">Order</a>
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


    <div style="font-size:21px;" id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
 <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="image/front-1.jpg" style="height:650px;" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h5>Combo</h5>
        <p>Get a perfect combo for your dinner.</p>
      </div>
    </div>
    <div class="carousel-item">
      <img src="image/front-2.jpg" style="height:650px;" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h5> Shawarma </h5>
        <p>Best Shawarma special for today.</p>
      </div>
    </div>
    <div class="carousel-item">
      <img src="image/front-3.jpg" style="height:650px;" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h5>Burger</h5>
        <p>Get yourself burger with french fries.</p>
      </div>
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>

<?php
if ($id != null) {
    echo "<script> document.getElementById('signInBtn').style.display = 'none'; </script>";
    echo "<script> document.getElementById('signUpBtn').style.display = 'none'; </script>";
} else {
    echo "<script> document.getElementById('signOutBtn').style.display = 'none'; </script>";
}
?>


  <!-- Footer -->
  <footer
          class="text-center text-lg-start text-dark"
          style="background-color: #ECEFF1;position:static;"
          >
    <!-- Section: Social media -->
    <section
             class="d-flex justify-content-between p-4 text-white"
             style="background-color: #21D192"
             >
      <!-- Left -->
      <div class="me-5">
        <span>Get connected with us on social networks:</span>
      </div>
      <!-- Left -->

      <!-- Right -->
      <div>
        <a href="" class="text-white me-4">
          <i class="fab fa-facebook-f"></i>
        </a>
        <a href="" class="text-white me-4">
          <i class="fab fa-twitter"></i>
        </a>
        <a href="" class="text-white me-4">
          <i class="fab fa-google"></i>
        </a>
        <a href="" class="text-white me-4">
          <i class="fab fa-instagram"></i>
        </a>
        <a href="" class="text-white me-4">
          <i class="fab fa-linkedin"></i>
        </a>
        <a href="" class="text-white me-4">
          <i class="fab fa-github"></i>
        </a>
      </div>
    </section>

    <section class="">
      <div class="container text-center text-md-start mt-5">
        <div class="row mt-3">
          <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
            <h6 class="text-uppercase fw-bold">FLORA</h6>
            <hr
                class="mb-4 mt-0 d-inline-block mx-auto"
                style="width: 60px; background-color: #7c4dff; height: 2px"
                />
            <p>
              We Deliver fresh food at your door step.
              Guaranteed delivery in 30 mins.
            </p>
          </div>
          <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
            <h6 class="text-uppercase fw-bold">Products</h6>
            <hr
                class="mb-4 mt-0 d-inline-block mx-auto"
                style="width: 60px; background-color: #7c4dff; height: 2px"
                />
            <p>
              <a href="about.php" class="text-dark">About Us</a>
            </p>
            <p>
              <a href="#!" class="text-dark">Feedback</a>
            </p>
            <p>
              <a href="#!" class="text-dark">Our Parteners</a>
            </p>
            <p>
              <a href="#!" class="text-dark">Donations</a>
            </p>
          </div>
          <!-- Grid column -->

          <!-- Grid column -->
          <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
            <!-- Links -->
            <h6 class="text-uppercase fw-bold">Career</h6>
            <hr
                class="mb-4 mt-0 d-inline-block mx-auto"
                style="width: 60px; background-color: #7c4dff; height: 2px"
                />
            <p>
              <a href="#!" class="text-dark">Delivery</a>
            </p>
            <p>
              <a href="#!" class="text-dark">Programmer</a>
            </p>
            <p>
              <a href="#!" class="text-dark">Analyst</a>
            </p>
            <p>
              <a href="#!" class="text-dark">Human Resource</a>
            </p>
          </div>

          <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
            <!-- Links -->
            <h6 class="text-uppercase fw-bold">Contact</h6>
            <hr
                class="mb-4 mt-0 d-inline-block mx-auto"
                style="width: 60px; background-color: #7c4dff; height: 2px"
                />
            <p><i class="fas fa-home mr-3"></i> Ballarat, VIC 3350, AU</p>
            <p><i class="fas fa-envelope mr-3"></i> floraballarat@outlook.com</p>
            <p><i class="fas fa-phone mr-3"></i> + 61 234 567 88</p>
            <p><i class="fas fa-print mr-3"></i> + 61 234 567 89</p>
          </div>
          <!-- Grid column -->
        </div>
        <!-- Grid row -->
      </div>
    </section>
    <!-- Section: Links  -->

    <!-- Copyright -->
    <div
         class="text-center p-3"
         style="background-color: rgba(0, 0, 0, 0.2)"
         >
         Copyright  ©  
         <script>
            var CurrentYear = new Date().getFullYear();
            document.write(CurrentYear);
          </script>
      By
      <a class="text-dark" href="#"
         >Flora.com</a
        >
    </div>
    <!-- Copyright -->
  </footer>



</body>

</html>