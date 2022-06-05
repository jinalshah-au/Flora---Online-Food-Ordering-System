<?php

class Dish{
    public $id;
    public $price;
    public $title;
    public $description;
    public $category;
    public $cholestrol;
    public $protein;
    public $carbs;
    public $avg_health;
    public $image;

    function __construct($id,$price,$title,$description,$category,$cholestrol,$protein,$carbs,$avg_health,$image){
        $this->id = $id;
        $this->price = $price;
        $this->title = $title;
        $this->description = $description;
        $this->category = $category;
        $this->cholestrol = $cholestrol;
        $this->protein = $protein;
        $this->carbs = $carbs;
        $this->avg_health = $avg_health;
        $this->image = $image;

    }

    function getId(){
        return $this->id;
    }

    function getPrice(){
        return $this->price;
    }

    function getImage(){
        return $this->image;
    }

    function getTitle(){
        return $this->title;
    }

    function getDescription(){
        return $this->description;
    }

    function getCategory(){
        return $this->category;
    }

    function getCholestrol(){
        return $this->cholestrol;
    }

    function getProtein(){
        return $this->protein;
    }


    function getCarbs(){
        return $this->carbs;
    }

    function getAvgHealth(){
        return $this->avg_health;
    }
    
    public function setId($id)
    {
        $this->id = $id;
    }

    public function setPrice($price)
    {
        $this->price = $price;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function setCategory($category)
    {
        $this->category = $category;
    }

    public function setCholestrol($cholestrol)
    {
        $this->cholestrol = $cholestrol;
    }

    public function setProtein($protein)
    {
        $this->protein = $protein;
    }

    public function setCarbs($carbs)
    {
        $this->carbs = $carbs;
    }

    public function setAvg_health($avg_health)
    {
        $this->avg_health = $avg_health;
    }

    public function setImage($image)
    {
        $this->image = $image;
    }
}

?>