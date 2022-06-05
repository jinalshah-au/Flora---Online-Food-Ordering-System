<?php
session_start();
if(isset($_SESSION['id'])){
session_destroy();
echo "<script> alert('Logging Out.')</script>";
}
echo "<script> window.location ='index.php'; </script>";

?>