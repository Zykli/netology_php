<?php
class Car {
  public function __construct($producer, $enginePower, $color, $price) {
    $this->producer = $producer;
    $this->enginePower = $enginePower;
    $this->color = $color;
    $this->price = $price;
  }
  public function show() {
    foreach ($this as $key => $value) {
      echo $key." : ". $value."<br>";
    }
    echo "<br>";
  }
}

echo "Car<br>";
$carAudi = new Car('Audi', '75', 'White', '50000');
echo $carAudi->show();

$carBmw = new Car('BMW', '99', 'Black', '75000');
echo $carBmw->show();

class Tv {
  public function __construct($producer, $diagonal, $price) {
    $this->producer = $producer;
    $this->diagonal = $diagonal;
    $this->price = $price;
  }
  public function show() {
    foreach ($this as $key => $value) {
      echo $key." : ". $value."<br>";
    }
    echo "<br>";
  }
}

echo "<br>";
echo "TV<br>";
$tvSamsung = new Tv('Samsung', '40', '20000');
echo $tvSamsung->show();

$tvSony = new Tv('Sony', '32', '5000');
echo $tvSony->show();


class BallPen {
  public function __construct($producer, $color, $price) {
    $this->producer = $producer;
    $this->color = $color;
    $this->price = $price;
  }
  public function show() {
    foreach ($this as $key => $value) {
      echo $key." : ". $value."<br>";
    }
    echo "<br>";
  }
}

echo "<br>";
echo "Ball Pen<br>";
$ballPenErichKrause = new BallPen('ErichKrause', 'Blue', '100');
echo $ballPenErichKrause->show();

$ballPenKrita = new BallPen('Krita', 'Red', '67');
echo $ballPenKrita->show();


class Duck {
  public function __construct($race, $age, $sex, $price) {
  $this->race = $race;
  $this->age = $age;
  $this->sex = $sex;
  $this->price = $price;
  }
  public function show() {
    foreach ($this as $key => $value) {
      echo $key." : ". $value."<br>";
    }
    echo "<br>";
  }
}

echo "<br>";
echo "Duck<br>";
$duckCayuga = new Duck('Cayuga', '2', 'female', '2000');
echo $duckCayuga->show();

$duckDuclair = new Duck('Duclair', '4', 'male', '1500');
echo $duckDuclair->show();

class Product{
  public function __construct($producer, $name, $size, $material, $color, $price) {
  $this->producer = $producer;
  $this->name = $name;
  $this->size = $size;
  $this->material = $material;
  $this->color = $color;
  $this->price = $price;
  }
  public function show() {
    foreach ($this as $key => $value) {
      echo $key." : ". $value."<br>";
    }
    echo "<br>";
  }
}

echo "<br>";
echo "Product<br>";
$productPants = new Product('China', 'Pants', '48', 'cotton', 'Black', '1500');
echo $productPants->show();

$productSkirt = new Product('Paris', 'Skirt', '42', 'silk', 'Green', '3000');
echo $productSkirt->show();
