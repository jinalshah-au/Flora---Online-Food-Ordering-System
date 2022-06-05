<?php
require_once ('model/Account.php');
class Customer extends Account{ 
    public $id;
    public $email;
    public $name;
    public $image;
    public $phone;
    public $password;
    public $address;

    function __construct($id,$email,$name,$image,$phone,$password,$address){
        $this->id = $id;
        $this->email = $email;
        $this->name = $name;
        $this->image = $image;
        $this->phone = $phone;
        $this->password = $password;
        $this->address = $address;
    }

 

    function getAddress(){
        return $this->address;
    }

    function getName(){
        return $this->name;
    }

   

    function getImage(){
        return $this->image;
    }

    function getPhone(){
        return $this->phone;
    }

   
    
 

    public function setAddress($address)
    {
        $this->address = $address;
    }

 

    public function setName($name)
    {
        $this->name = $name;
    }

    public function setImage($image)
    {
        $this->image = $image;
    }

    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    
}

?>