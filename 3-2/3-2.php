<?php
mb_internal_encoding("UTF-8");

class Car extends Product implements ForAll {
  public function __construct($producer, $name, $color, $price, $enginePower) {
    parent::__construct($producer, $name, $color, $price);
    $this->enginePower = $enginePower;
  }
}

echo "Car<br>";
$carAudi = new Car('USA', 'Audi', 'White', '50000', '75');
echo $carAudi->show();

$carBmw = new Car('Germany','BMW', 'Black', '75000', '99');
echo $carBmw->show();

class Tv extends Electronics implements ForAll {
  public function __construct($name, $producer, $diagonal, $price) {
    parent::__construct($name, $producer, $price);
    $this->diagonal = $diagonal;
  }
}

echo "<br>";
$tvSamsung = new Tv('TV' ,'Samsung', '40', '20000');
echo $tvSamsung->show();

$tvSony = new Tv('TV' ,'Sony', '32', '5000');
echo $tvSony->show();


class BallPen extends Pen implements ForAll {
  public function __construct($producer, $type, $color, $price) {
    parent::__construct($producer, $color, $price);
    $this->type = $type;
  }
}

echo "<br>";
echo "Pen<br>";
$ballPenErichKrause = new BallPen('ErichKrause', 'ball', 'Blue', '100');
echo $ballPenErichKrause->show();

$ballPenKrita = new BallPen('Krita', 'gel', 'Red', '67');
echo $ballPenKrita->show();


class Duck extends Bird implements BirdInt{
  public function show() {
    foreach ($this as $key => $value) {
      if($key != 'voice') {
      echo $key." : ". $value."<br>";
      }
    }
  }
  public function Say() {
    $check = mb_strtolower($this->voice);
    if($check === 'кря') {
      echo 'Говорит: '.$this->voice.'<br>';
    } else {
      echo 'Странно, но все же говорит: '.$this->voice.'<br>';
    }
    echo "<br>";
  }
}

echo "<br>";
echo "Duck<br>";
$duckCayuga = new Duck('Cayuga', '2', 'female', 'Кря', '2000');
echo $duckCayuga->show();
echo $duckCayuga->Say();

$duckDuclair = new Duck('Duclair', '4', 'male', 'Гав', '1500');
echo $duckDuclair->show();
echo $duckDuclair->Say();


//поменял название с Product на Clothes
class Clothes extends Product implements ForAll {
  public function __construct($manufacturerCountry, $name, $size, $material, $color, $price) {
  parent::__construct($manufacturerCountry, $name, $color, $price);
  $this->size = $size;
  $this->material = $material;
  }
}

echo "<br>";
echo "Product<br>";
$productPants = new Clothes('China', 'Pants', '48', 'cotton', 'Black', '1500');
echo $productPants->show();

$productSkirt = new Clothes('Paris', 'Skirt', '42', 'silk', 'Green', '3000');
echo $productSkirt->show();


//Суперклассы
class ElementShow
{
  public function show() {
    foreach ($this as $key => $value) {
      echo $key." : ". $value."<br>";
    }
    echo "<br>";
  }
}

class Product extends ElementShow
{
  public function __construct($manufacturerCountry, $name, $color, $price) {
    $this->manufacturerCountry = $manufacturerCountry;
    $this->name = $name;
    $this->color = $color;
    $this->price = $price;
  }
}

class Electronics extends ElementShow
{
  public function __construct($name, $producer, $price)
  {
    $this->name = $name;
    $this->producer = $producer;
    $this->price = $price;
  }
}

class Pen extends ElementShow
{
  public function __construct($producer, $color, $price)
  {
    $this->producer = $producer;
    $this->color = $color;
    $this->price = $price;
  }
}

class Bird extends ElementShow
{
  public function __construct($race, $age, $sex, $voice, $price)
  {
    $this->race = $race;
    $this->age = $age;
    $this->sex = $sex;
    $this->voice = $voice;
    $this->price = $price;
  }
}

//Интерфейсы
interface ForAll
{
  public function show();
}
interface BirdInt
{
  public function show();
  public function say();
}
