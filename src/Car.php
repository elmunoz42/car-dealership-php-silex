<?php
class Car
{
  private $make_model;
  private $price;
  private $miles;

  function __construct($car_type, $car_price, $car_miles)
  {
      $this->make_model = $car_type;
      $this->price = $car_price;
      $this->miles = $car_miles;
  }

  function getPrice()
  {
      return $this->price;
  }

  function getModel()
  {
      return $this->make_model;
  }

  function getMiles()
  {
      return $this->miles;
  }

  function save() {
      array_push($_SESSION['car_list'], $this);
  }

  static function getAll() {
      return $_SESSION['car_list'];
  }

  static function deleteAll() {
      $_SESSION['car_list'] = array();
  }
}
?>
