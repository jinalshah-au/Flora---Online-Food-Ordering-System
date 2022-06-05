<?php 
class Cart{

    public $user_id;
    public $dish_id;
    public $quantity;

    public function __construct($user_id, $dish_id,$quantity){
        $this->user_id = $user_id;
        $this->dish_id = $dish_id;
        $this->quantity = $quantity;
    }

    public function getUser_id()
    {
        return $this->user_id;
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