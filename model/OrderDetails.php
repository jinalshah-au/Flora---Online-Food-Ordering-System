
<?php

class OrderDetails{

    public $order_id;
    public $dish_id;
    public $quantity;

    public function __construct($order_id, $dish_id, $quantity){
        $this->order_id = $order_id;
        $this->dish_id = $dish_id;
        $this->quantity = $quantity;
    }


    public function getOrder_id()
    {
        return $this->order_id;
    }

    public function getDish_id()
    {
        return $this->dish_id;
    }

    public function getQuantity()
    {
        return $this->quantity;
    }
}

?>