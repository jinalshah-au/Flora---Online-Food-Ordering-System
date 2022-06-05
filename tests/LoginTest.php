<?php

include 'controller/controller.php';
use PHPUnit\Framework\TestCase;

class LoginTest extends TestCase{
    public function testUserLogin(){
        $check = new controller;
        $result = $check->authenticateUser('jinalshah.au@gmail.com','jinal123445');        
        $this->assertInstanceOf('Customer',$result);
    }

}