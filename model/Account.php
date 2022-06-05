<?php

class Account{
    public $id;
    public $email;
    public $password;

    function __construct($id,$email,$password){
        $this->id = $id;
        $this->email = $email;
        $this->password = $password;
    }

    function getId(){
        return $this->id;
    }

    function getEmail(){
        return $this->email;
    }

    function getPassword(){
        return $this->password;
    }

    function setId($id){
        $this->id = $id;
    }

    function setEmail($email){
        $this->email = $email;
    }

    function setPassword($password){
        $this->password = $password;
    }
    
}
?>