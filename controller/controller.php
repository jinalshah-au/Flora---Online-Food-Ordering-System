<?php
//importing all the class files from model
require_once ('model/Account.php');
include 'model/Dish.php';
include 'model/Cart.php';
include 'model/Customer.php';
include 'model/Admin.php';
include 'model/Order.php';
include 'model/Driver.php';
include 'model/Drivers.php';
include 'model/OrderDetails.php';

class controller
{

    public static $conn;

    public function __construct()           //creatingg connection
    {
        if (self::$conn == null) {
            self::$conn = mysqli_connect('localhost', 'root', '', 'ofos');
        }
    }

    public static function getDishes()          //function to get all the dishes
    {
        $dishList = array();                //declearing array to store all the dish data
        $query = "select * from dish";
        $result = self::$conn->query($query);
        if (!$result) {
            self::showAlert();
            return $dishList;
        }
        $i = 0;
        while ($row = $result->fetch_assoc()) {
            $id = $row['id'];
            $title = $row['title'];
            $description = $row['description'];
            $price = $row['price'];
            $category = $row['category'];
            $cholestrol = $row['cholestrol'];
            $protein = $row['protein'];
            $carbs = $row['carbs'];
            $avg_health = $row['avg_health'];
            $image = $row['image'];
            $dish = new Dish($id, $price, $title, $description, $category, $cholestrol, $protein, $carbs, $avg_health, $image);
            $dishList[$i] = $dish;
            $i++;
        }

        return $dishList;
    }

    public static function getDishById($id){            //funcion to get a perticular dish by its ID
        $query = "select * from dish where id=". $id;
        $result = self::$conn->query($query);
        if (!$result) {
            self::showAlert();
            return false;
        }
        if (mysqli_num_rows($result) > 0) {
            $row = $result->fetch_assoc();
            $id = $row['id'];
            $title = $row['title'];
            $description = $row['description'];
            $price = $row['price'];
            $category = $row['category'];
            $cholestrol = $row['cholestrol'];
            $protein = $row['protein'];
            $carbs = $row['carbs'];
            $avg_health = $row['avg_health'];
            $image = $row['image'];
            $dish = new Dish($id, $price, $title, $description, $category, $cholestrol, $protein, $carbs, $avg_health, $image);
            return $dish;
        }
        return false;
    }

    public static function updateDish($dish){           //function to edit dish details
        $avg_health = ($dish->getCholestrol() + $dish->getProtein() + $dish->getCarbs())/3;
        $avg_health = number_format($avg_health, 1);
        $query = null;
        if($dish->getImage() != ""){
            $query = "update `dish` set `title` = '". $dish->getTitle() . "', `description` = '". $dish->getDescription() ."', `cholestrol` = '". $dish->getCholestrol() ."', `protein` = '". $dish->getProtein() ."', `carbs` = '". $dish->getCarbs() ."', `category` = '". $dish->getCategory() ."',`price` = '". $dish->getPrice() ."',`avg_health` ='". $avg_health ."', `image`='". $dish->getImage() ."' WHERE `dish`.`id` = ". $dish->getId() .";";
        }else{
            $query = "update `dish` set `title` = '". $dish->getTitle() . "', `description` = '". $dish->getDescription() ."', `cholestrol` = '". $dish->getCholestrol() ."', `protein` = '". $dish->getProtein() ."', `carbs` = '". $dish->getCarbs() ."', `category` = '". $dish->getCategory() ."',`price` = '". $dish->getPrice() ."',`avg_health` ='". $avg_health ."' WHERE `dish`.`id` = ". $dish->getId() .";";
        }
        $result = self::$conn->query($query);
        if (!$result) {
            self::showAlert();
            return false;
        }
        return true;
    }

    public static function addDish($dish){          //function to add ne dish
        $avg_health = ($dish->getCholestrol() + $dish->getProtein() + $dish->getCarbs())/3;
        $avg_health = number_format($avg_health, 1);
        $query = "insert into `dish` (`title`, `description`, `price`, `category`, `cholestrol`, `protein`, `carbs`, `avg_health`, `image`) values ('". $dish->getTitle() ."', '". $dish->getDescription() ."', ". $dish->getPrice() .", '". $dish->getCategory() ."',". $dish->getCholestrol() ." , ". $dish->getProtein() .", ". $dish->getCarbs() .", ". $avg_health .",'". $dish->getImage() ."')";
        echo "<script> alert('". $query ."'); </script>";
        $result = self::$conn->query($query);
        if (!$result) {
            self::showAlert();
            return false;
        }
        return true;
    }

    public static function deleteDish($id){         //to delete any dish(by id)
        $query = "delete from dish where id=". $id;
        $result = self::$conn->query($query);
        if (!$result) {
            self::showAlert();
            return false;
        }
        return true;
    }



    public static function isUserExist($email)      //to check weather user is already in system
    {
        $query = "select * from user where email='$email'";
        $result = self::$conn->query($query);
        if (!$result) {
            self::showAlert();
        }
        if (mysqli_num_rows($result) > 0) {
            return true;
        }
        return false;
    }

    public static function createUser($user)            //to add new customre
    {
        $query = "insert into user (`username`, `password`, `email`, `phone`, `address`, `image`) values('" . $user->getName() . "', '" . $user->getPassword() . "','" . $user->getEmail() . "','" . $user->getPhone() . "','" . $user->getAddress() . "','" . $user->getImage() . "')";
        $result = self::$conn->query($query);
        if (!$result) {
            self::showAlert();
            return false;
        }
        return true;
    }

    public static function authenticateUser($username, $password)       //customer validation while login
    {
        $query = "select * from user where (username ='" . $username . "' or email='" . $username . "') and password='" . $password . "';";
        $result = self::$conn->query($query);
        if (!$result) {
            return false;
        }
        if (mysqli_num_rows($result) > 0) {
            $row = $result->fetch_assoc();
            $id = $row['id'];
            $uname = $row['username'];
            $pword = $row['password'];
            $email = $row['email'];

            $user = new Customer($id, $email, $uname, "", "", $pword, "");

            return $user;
        }
        return false;
    }
    // This method will admin email and password and validate with database value, if find true then retur true
    public static function authenticateAdmin($username, $password)      //admin validation while login
    {
        $query = "select * from admin where email ='" . $username . "' and password='" . $password . "';"; // SQL query 
        $result = self::$conn->query($query);
        if (!$result) {
            return false;
        }
        if (mysqli_num_rows($result) > 0) {
            $row = $result->fetch_assoc();
            $id = $row['id'];
            $pword = $row['password'];
            $email = $row['email'];

            $user = new Admin($id, $email, $pword);

            return $user;
        }
        return false;
    }
    // This method will driver name and password and validate with database value, if find true then retur true
    public static function authenticateDriver($name, $password)         //driver validation while login
    {
        $query = "select * from drivers where drivername ='" . $name . "' and password='" . $password . "';"; // SQL query 
        $result = self::$conn->query($query);
        if (!$result) {
            return false;
        }
        if (mysqli_num_rows($result) > 0) {
            $row = $result->fetch_assoc();
            $id = $row['id'];
            $pword = $row['password'];
            $email = $row['email'];

            $user = new Drivers($id, $email, $pword,"","","","","");

            return $user;
        }
        return false;
    }

    public static function getCartItem($user_id)               //access cart data(by user ID)
    {
        $cartList = array();
        $query = "select * from cart where user_id=" . $user_id;
        $result = self::$conn->query($query);
        if (!$result) {
            self::showAlert();
        }
        if (mysqli_num_rows($result) > 0) {
            $i = 0;
            while ($row = $result->fetch_assoc()) {
                $quantity = $row['quantity'];
                $user_id = $row['user_id'];
                $dish_id = $row['dish_id'];

                $cart = new Cart($user_id, $dish_id, $quantity);

                $cartList[$i] = $cart;
                $i++;
            }
        }
        return $cartList;
    }

    public static function getCartDishes($user_id){     //to get details of dishes in cart
        $query = "SELECT c1.*, c2.* FROM dish c1, cart c2 WHERE c1.id IN (SELECT c2.dish_id FROM cart where c2.user_id=". $user_id .")";
        $result = self::$conn->query($query);
        if (!$result) {
            self::showAlert();
            return false;
        }
        $dishList = array();
        $cartList = array();
        if(mysqli_num_rows($result) > 0){
            $i=0;
            while($row = $result->fetch_assoc()){
                $dish_id = $row['id'];
                $title = $row['title'];
                $description = $row['description'];
                $price = $row['price'];
                $image = $row['image'];
                $quantity = $row['quantity'];

                $dish = new Dish($dish_id,$price,$title,$description,"","","","","",$image);
                $cart = new Cart($user_id,$dish_id,$quantity);
                $dishList[$i] = $dish;
                $cartList[$i] = $cart;
                $i++;
            }
        }
        return array($dishList,$cartList);
    }

    public static function addToCart($cart){        //to add dish in cart

        if(self::isCartItemExist($cart)){
            return self::updateCartItem($cart);
        }
        $query = "insert into cart(`user_id`,`dish_id`,`quantity`) values((select id from user where user.id=". $cart->getUser_id() ."),(select id from dish where dish.id=". $cart->getDish_id() ."),". $cart->getQuantity() .");";
        $result = self::$conn->query($query);
        if (!$result) {
            self::showAlert();
            return false;
        }
        return true;
    }

    public static function updateCartItem($cart){       //to adit from the cart
        if($cart->getQuantity() == 0){
            return self::deleteCartItem($cart);
        }
        $query = "update cart set quantity=". $cart->getQuantity() ." where (dish_id=". $cart->getDish_id() ." and user_id=". $cart->getUser_id() .");";
        $result = self::$conn->query($query);
        if (!$result) {
            self::showAlert();
            return false;
        }
        return true;
    }

    public static function deleteCartItem($cart){           //to delete cart
        $query = "delete from cart where (dish_id=". $cart->getDish_id() ." and user_id=". $cart->getUser_id() .");";
        $result = self::$conn->query($query);
        if (!$result) {
            self::showAlert();
            return false;
        }
        return true;
    }

    public static function isCartItemExist($cart){      //to check if any items are in cart
        $query = "select * from cart where(dish_id=". $cart->getDish_id() ." and user_id=". $cart->getUser_id() .");";
        $result = self::$conn->query($query);
        if (!$result) {
            self::showAlert();
            return false;
        }
        if(mysqli_num_rows($result) > 0){
            return true;
        }
        return false;
    }

    public static function getOrders(){     
            // "SELECT c1.*,c2.* FROM orders c1, order_details c2 WHERE c1.user_id=1 AND c1.id = c2.order_id"
    }

    public static function getDishByCategory($category){        //to filter dishes by category
        if($category == "all"){
            return self::getDishes();
        }else if($category == "carbs"){
            return self::getDishesByCarbs();
        }
        $dishList = array();
        $query = "select * from dish where category='". $category ."'";
        $result = self::$conn->query($query);
        if (!$result) {
            self::showAlert();
            return false;
        }
        $i = 0;
        while ($row = $result->fetch_assoc()) {
            $id = $row['id'];
            $title = $row['title'];
            $description = $row['description'];
            $price = $row['price'];
            $category = $row['category'];
            $cholestrol = $row['cholestrol'];
            $protein = $row['protein'];
            $carbs = $row['carbs'];
            $avg_health = $row['avg_health'];
            $image = $row['image'];
            $dish = new Dish($id, $price, $title, $description, $category, $cholestrol, $protein, $carbs, $avg_health, $image);
            $dishList[$i] = $dish;
            $i++;
        }

        return $dishList;
    }

    public static function getDishesByCarbs(){          //to filter by carbs
        $query = "select * from dish order by carbs asc";
        $dishList = array();
        $result = self::$conn->query($query);
        if (!$result) {
            self::showAlert();
            return false;
        }
        $i = 0;
        while ($row = $result->fetch_assoc()) {
            $id = $row['id'];
            $title = $row['title'];
            $description = $row['description'];
            $price = $row['price'];
            $category = $row['category'];
            $cholestrol = $row['cholestrol'];
            $protein = $row['protein'];
            $carbs = $row['carbs'];
            $avg_health = $row['avg_health'];
            $image = $row['image'];
            $dish = new Dish($id, $price, $title, $description, $category, $cholestrol, $protein, $carbs, $avg_health, $image);
            $dishList[$i] = $dish;
            $i++;
        }

        return $dishList;
    }

    public static function placeOrder($order, $cartList){       //to place an order from cart into orders
        $query = "insert into `orders` (`driver_id`, `status`, `payment_mode`, `total_price`, `user_id`, `date`) values (0,'Received', '" . $order->getPaymentMode() . "', " . $order->getTotalPrice() .", (select id from user where user.id=". $order->getUser_id() ."), CURRENT_TIMESTAMP)";
        $result = self::$conn->query($query);
        if (!$result) {
            self::showAlert();
            return false;
        }
        $last_id = self::$conn->insert_id;
        for($i=0; $i <count($cartList); $i++){
            $cart = $cartList[$i];
            $query_OrderDetail = "insert into order_details(order_id,dish_id,quantity) values(". $last_id .",(select id from dish where dish.id=". $cart->getDish_id(). "),". $cart->getQuantity() .")";
            echo "<script> console.log('got it'); </script>";
            $result_OrderDetail = self::$conn->query($query_OrderDetail);
            if (!$result_OrderDetail) {
                self::showAlert();
                return false;
            }
        }
        self::deleteAllCartItem($order->getUser_id());
        return $last_id;
    }

    public static function deleteAllCartItem($user_id){     //delete cart once order is placed
        $query = "delete from cart where user_id=". $user_id;
        $result = self::$conn->query($query);
        if (!$result) {
            self::showAlert();
            return false;
        }
        return true;
    }

    public static function getOrderById($order_id){         //to get order by order id
        $query = "select * from orders where id=". $order_id . ";";
        $result = self::$conn->query($query);
        if (!$result) {
            self::showAlert();
            return false;
        }
        $ordersList = array();      //array to store the order
        $orderDetailList = array();     //array to each order details
        $i=0;
        while($row = $result->fetch_assoc()){
            $id = $row['id'];
            $driver_id = $row['driver_id'];
            $total_price = $row['total_price'];
            $payment_mode = $row['payment_mode'];
            $status = $row['status'];
            $date = $row['date'];
            $user_id = $row['user_id'];

            $order_obj = new Order($id,$driver_id,$status,$payment_mode,$total_price,$user_id,$date);
            $ordersList[$i] = $order_obj;

            
            $orderDetailSubList = array();
            $query_OrderDetail = "select * from order_details where order_id=". $id;
            $result_OrderDetail = self::$conn->query($query_OrderDetail);
            if (!$result_OrderDetail) {
                self::showAlert();
                return false;
            }
            $j =0;
            while($row_OrderDetail = $result_OrderDetail->fetch_assoc()){
                $order_id = $row_OrderDetail['order_id'];
                $dish_id = $row_OrderDetail['dish_id'];
                $quantity = $row_OrderDetail['quantity'];
                $orderDetail = new OrderDetails($order_id, $dish_id, $quantity);
                $orderDetailSubList[$j] = $orderDetail;
                $j++;
            }
            $orderDetailList[$i] = $orderDetailSubList;
            $i++;
        }
        return array($ordersList, $orderDetailList);
    }

    public static function getOrderHistory($user_id){               //to get all the orders associated to perticular user
        $query = "select * from orders where user_id=". $user_id . " order by id desc;";
        $result = self::$conn->query($query);
        if (!$result) {
            self::showAlert();
            return false;
        }
        $ordersList = array();          //array to store the order
        $orderDetailList = array();     //array to each order details
        $i=0;
        while($row = $result->fetch_assoc()){
            $id = $row['id'];
            $driver_id = $row['driver_id'];
            $total_price = $row['total_price'];
            $payment_mode = $row['payment_mode'];
            $status = $row['status'];
            $date = $row['date'];

            $order_obj = new Order($id,$driver_id,$status,$payment_mode,$total_price,"",$date);
            $ordersList[$i] = $order_obj;

            
            $orderDetailSubList = array();
            $query_OrderDetail = "select * from order_details where order_id=". $id;
            $result_OrderDetail = self::$conn->query($query_OrderDetail);
            if (!$result_OrderDetail) {
                self::showAlert();
                return false;
            }
            $j =0;
            while($row_OrderDetail = $result_OrderDetail->fetch_assoc()){
                $order_id = $row_OrderDetail['order_id'];
                $dish_id = $row_OrderDetail['dish_id'];
                $quantity = $row_OrderDetail['quantity'];
                $orderDetail = new OrderDetails($order_id, $dish_id, $quantity);
                $orderDetailSubList[$j] = $orderDetail;
                $j++;
            }
            $orderDetailList[$i] = $orderDetailSubList;
            $i++;
        }
        return array($ordersList, $orderDetailList);
    }
    public static function updateUser($user){           //to update customer details
        $query = null;
        if($user->getImage() != ""){
            $query = "update `user` set `username` = '". $user->getName() . "', `password` = '". $user->getPassword() ."', `email` = '". $user->getEmail() ."', `phone` = '". $user->getPhone() ."', `address` = '". $user->getAddress() ."', `image` = '". $user->getImage() ."' WHERE `user`.`id` = ". $user->getId() .";";
        }else{
            $query = "update `user` set `username` = '". $user->getName() . "', `password` = '". $user->getPassword() ."', `email` = '". $user->getEmail() ."', `phone` = '". $user->getPhone() ."', `address` = '". $user->getAddress() ."' WHERE `user`.`id` = ". $user->getId() .";";
        }
        $result = self::$conn->query($query);
        if (!$result) {
            self::showAlert();
            return false;
        }
        return true;
    }



    public static function deleteUser($id){             //to delete customer profile
        $query = "delete from user where id=". $id;
        $result = self::$conn->query($query);
        if (!$result) {
            self::showAlert();
            return false;
        }
        return true;
    }




    public static function updateDriver($driver){           //to update driver profile
        $query = null;
        if($driver->getImage() != ""){
            $query = "update `drivers` set `drivername` = '". $driver->getName() . "', `phone` = '". $driver->getPhone() ."', `password` = '". $driver->getPassword() ."', `address` = '". $driver->getAddress() ."', `email` = '". $driver->getEmail() ."', `image` = '". $driver->getImage() ."' WHERE `drivers`.`id` = ". $driver->getId() .";";
        }else{
            $query = "update `drivers` set `drivername` = '". $driver->getName() . "', `phone` = '". $driver->getPhone() ."', `password` = '". $driver->getPassword() ."', `address` = '". $driver->getAddress() ."', `email` = '". $driver->getEmail() ."' WHERE `drivers`.`id` = ". $driver->getId() .";";
        }
        $result = self::$conn->query($query);
        if (!$result) {
            self::showAlert();
            return false;
        }
        return true;
    }
    public static function getDriverById($id){      //access driver data by driverID
   
        $query = "select * from `drivers` WHERE `drivers`.`id` = ". $id .";";
        $result = self::$conn->query($query);
        $driver=null;
        if(mysqli_num_rows($result) > 0){
           
            while($row = $result->fetch_assoc()){
                $id = $row['id'];
                $name = $row['drivername'];
                $phone = $row['phone'];
                $password = $row['password'];
                $email = $row['email'];
                $address = $row['address'];
                $image = $row['image'];

                $driver = new Drivers($id,$email,$name,$image,$phone,$password,$address);
  
            }
        }
        return $driver;
    }


    public static function deleteDriver($id){           //delete driver profile
        $query = "delete from drivers where id=". $id;
        $result = self::$conn->query($query);
        if (!$result) {
            self::showAlert();
            return false;
        }
        return true;
    }

    

    public static function addDriver($driver){      //to add new driver into system
   
        $query = "insert into `drivers` (drivername, password, email, phone,address,image) values ('". $driver->getName() ."', '". $driver->getPassword() ."','". $driver->getEmail() ."','". $driver->getPhone() ."','". $driver->getAddress() ."','". $driver->getImage()."')";
        echo "<script> alert('". $query ."'); </script>";
        $result = self::$conn->query($query);
        if (!$result) {
            self::showAlert();
            return false;
        }
        return true;
    }

  

    public static function getDrivers(){        //to get all the data from drivers table
        $query = "SELECT * FROM drivers";
        $result = self::$conn->query($query);
        if (!$result) {
            self::showAlert();
            return false;
        }
        $drivers = array();
    
        if(mysqli_num_rows($result) > 0){
            $i=0;
            while($row = $result->fetch_assoc()){
                $id = $row['id'];
                $name = $row['drivername'];
                $phone = $row['phone'];
                $password = $row['password'];
                $email = $row['email'];
                $address = $row['address'];
                $image = $row['image'];

                $driver = new Drivers($id,$email,$name,$image,$phone,$password,$address);
               
                $drivers[$i] = $driver;

                $i++;
            }
        }
        return $drivers;
    }

  

    public static function getUsers(){      //to get all the customer details
        $query = "SELECT * FROM user";
        $result = self::$conn->query($query);
        if (!$result) {
            self::showAlert();
            return false;
        }
        $users = array();
    
        if(mysqli_num_rows($result) > 0){
            $i=0;
            while($row = $result->fetch_assoc()){
                $id = $row['id'];
                $username = $row['username'];
                $password = $row['password'];
                $email = $row['email'];
                $phone = $row['phone'];
                $address = $row['address'];
                $image = $row['image'];
   
                $user = new Customer($id,$email,$username,$image,$phone,$password,$address);
               
                $users[$i] = $user;

                $i++;
            }
        }
        return $users;
    }
    public static function getUserById($id){            //to get a perticlart customer details
        $query = "SELECT * FROM user WHERE `user`.`id` = ". $id .";";
        $result = self::$conn->query($query);
        $user = null;
        if(mysqli_num_rows($result) > 0){
            while($row = $result->fetch_assoc()){
                $id = $row['id'];
                $username = $row['username'];
                $password = $row['password'];
                $email = $row['email'];
                $phone = $row['phone'];
                $address = $row['address'];
                $image = $row['image'];
                $user = new Customer($id,$email,$username,$image,$phone,$password,$address);
            }
        }
        return $user;
    }



    public static function getAllOrders(){          //to get all the orders from admin dashboard
        $query = "select * from orders ";
        $result = self::$conn->query($query);
        if (!$result) {
            self::showAlert();
            return false;
        }
        $ordersList = array();
        $orderDetailList = array();
        $i=0;
        while($row = $result->fetch_assoc()){
            $id = $row['id'];
            $driver_id = $row['driver_id'];
            $total_price = $row['total_price'];
            $payment_mode = $row['payment_mode'];
            $status = $row['status'];
            $date = $row['date'];
            $user_id = $row['user_id'];
            $order_obj = new Order($id,$driver_id,$status,$payment_mode,$total_price,$user_id,$date);
            $ordersList[$i] = $order_obj;
            $i++;
        }
        return $ordersList;
    }

    public static function getDriverOrders($DriverId){      //to get all the orders associated to an perticular driver
        $query = "select * from orders WHERE driver_id=" .$DriverId;
        $result = self::$conn->query($query);
        if (!$result) {
            self::showAlert();
            return false;
        }
        $ordersList = array();
        $i=0;
        while($row = $result->fetch_assoc()){
            $id = $row['id'];
            $driver_id = $row['driver_id'];
            $total_price = $row['total_price'];
            $payment_mode = $row['payment_mode'];
            $status = $row['status'];
            $date = $row['date'];
            $user_id = $row['user_id'];
            $order_obj = new Order($id,$driver_id,$status,$payment_mode,$total_price,$user_id,$date);
            $ordersList[$i] = $order_obj;
            $i++;
        }
        return $ordersList;
    }

    public static function updateOrder($order){     //to update the order status
        $query = "update `orders` set `driver_id` = ". $order->getDriverId() . ", `status` = '". $order->getStatus() ."'  WHERE `orders`.`id` = ". $order->getOrderId() .";";
        echo "<script> alert('". $query . "'); </script>";
        $result = self::$conn->query($query);
        if (!$result) {
            self::showAlert();
            return false;
        }
        return true;
   
    }

    
    public static function updateOrderDriver($order){           //to update order status by the driver
        $query = "update `orders` set `status` = '". $order->getStatus() ."'  WHERE `orders`.`id` = ". $order->getOrderId() .";";
        echo "<script> alert('". $query . "'); </script>";
        $result = self::$conn->query($query);
        if (!$result) {
            self::showAlert();
            return false;
        }
        return true;
   
    }

    public static function getSingleOrderById($id){         //to get a specific order by its id
        $query = "SELECT * FROM orders WHERE `orders`.`id` = ". $id .";";
        $result = self::$conn->query($query);
        $order_obj= null;
        if(mysqli_num_rows($result) > 0){
            while($row = $result->fetch_assoc()){
                $id = $row['id'];
            $driver_id = $row['driver_id'];
            $total_price = $row['total_price'];
            $payment_mode = $row['payment_mode'];
            $status = $row['status'];
            $date = $row['date'];
            $user_id = $row['user_id'];
            $order_obj = new Order($id,$driver_id,$status,$payment_mode,$total_price,$user_id,$date);
            }
        }
        return $order_obj;
    }
    public static function showAlert()      //popup alert
    {
        echo "<script> alert('Something went wrong, Try again.'); </script>";
    }
}
