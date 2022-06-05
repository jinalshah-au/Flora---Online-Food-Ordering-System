<?php

class Driver{
   
    public $name;
    public $phone;
    public $license_no;
    public $image;
    public $address;
    function __construct($id,$name,$phone,$license_no){
        $this->id = $id;
        $this->name = $name;
        $this->phone = $phone;
        $this->license_no = $license_no;
    }


    function getAddress(){     
        return $this->address;
    }
    function setAddress($address){
        $this->address=$address;
    }


    function getName(){
        return $this->name;
    }

    function getPhone(){
        return $this->phone;
    }

    function getLicenseNo(){
        return $this->license_no;
    }
    function getImage(){
        return $this->image;
    }

    public function setImage($image)
    {
        $this->image = $image;
    }



    public function setName($name)
    {
        $this->name = $name;
    }

    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    public function setLicense_no($license_no)
    {
        $this->license_no = $license_no;
    }
}
