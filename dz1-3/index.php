<?php
  $animals = array(
    "Africa" => array('Arthroleptis stridens', 'Mantophasmatodea', 'Osteolaemus tetraspis'),
    "Australia" => array('Tiliqua', 'Tachyglossus aculeatus', 'Phascolarctos cinereus'),
    "Asia" => array('Varanus nuchalis', 'Ramphotyphlops braminus', 'Zamenis longissimus'),
    "SouthAmerica" => array('Dasyprocta', 'Euryzygomatomys', 'Phyllobates vittatus')
  );

  echo "<h4>"."Начальный массив животных"."</h4>";
  echo "<br>";
  $secondWordAnimals = array();
  foreach ($animals as $key => $value) {
    echo "<b>".$key."</b>";
    echo "<br>";
    foreach ($value as $nameAnimal) {
      echo $nameAnimal."<br>";
      $pos = strpos($nameAnimal, " ");
      if ($pos > 0) {
        array_push($secondWordAnimals, $nameAnimal);
      }
    }
    echo "<br>";
  }

  $FirstNameAnimal = array();
  $LastNameAnimal = array();

  for ($i=0; $i < count($secondWordAnimals); $i++) {
    $exploadName = explode(" ", $secondWordAnimals[$i]);
    array_push($FirstNameAnimal, $exploadName[0]);
    array_push($LastNameAnimal, $exploadName[1]);
  }

  shuffle ($FirstNameAnimal);
  shuffle ($LastNameAnimal);

  $fantasyEnimalsArray = array();
   for ($i=0; $i < count($FirstNameAnimal); $i++) {
     $fantasyEnimals = $FirstNameAnimal[$i]." ".$LastNameAnimal[$i];
     array_push($fantasyEnimalsArray, $fantasyEnimals);
   }
   echo "<h5>"."Массив получившихся фантастических животных:"."</h5>";
   echo "<br>";
   for ($i=0; $i < count($fantasyEnimalsArray) ; $i++) {
     echo $fantasyEnimalsArray[$i];
     echo "<br>";
   }

   //Дополнительное задание
  $FantasyAnimalArea = array();
  foreach ($animals as $key => $value) {
  $keyArray = array();
    foreach ($value as $nameAnimal) {
      for ($i=0; $i < count($fantasyEnimalsArray) ; $i++) {
        $exploadNameFantasy = explode(" ", $fantasyEnimalsArray[$i]);
        $search = strstr($nameAnimal, $exploadNameFantasy[0]);

        if (!(empty($search))) {
          array_push($keyArray, $fantasyEnimalsArray[$i]);
          break;
        }
      }
    }
    $FantasyAnimalArea[$key] = $keyArray;
  }
  echo "<br>";
  echo "<br>";
  echo "<h4>"."Дополнительное задание: распределение придуманных животных по их изначальным регионам"."</h4>";
  foreach ($FantasyAnimalArea as $key => $nameValue) {
    echo "<h2>".$key."</h2>";
    echo "<br>";
    for ($i=0; $i < count($nameValue) ; $i++) {
      echo $nameValue[$i];
      if ($i<(count($nameValue)-1)) {
        echo ", ";
      } else {
        echo ".";
      }
    }
  }
