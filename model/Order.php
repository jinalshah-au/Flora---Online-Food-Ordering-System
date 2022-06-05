<?php

class Order{
    public $order_id;
    public $driver_id;
    public $status;
    public $payment_mode;
    public $totalPrice;
    public $user_id;
    public $date;

    function __construct($order_id,$driver_id,$status,$payment_mode,$totalPrice,$user_id,$date){
        $this->order_id = $order_id;
        $this->driver_id = $driver_id;
        $this->status = $status;
        $this->payment_mode = $payment_mode;
        $this->totalPrice = $totalPrice;
        $this->user_id = $user_id;
        $this->date = $date;
    }

    function getOrderId(){
        return $this->order_id;
    }

    function getDriverId(){
        return $this->driver_id;
    }

    function getStatus(){
        return $this->status;
    }

    function getPaymentMode(){
        return $this->payment_mode;
    }

    public function setOrder_id($order_id)
    {
        $this->order_id = $order_id;
    }

    public function setDriver_id($driver_id)
    {
        $this->driver_id = $driver_id;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function setPayment_mode($payment_mode)
    {
        $this->payment_mode = $payment_mode;
    }

    public function getTotalPrice()
    {
        return $this->totalPrice;
    }

    public function getUser_id()
    {
        return $this->user_id;
    }

    public function getDate()
    {
        return $this->date;
    }
}

?>