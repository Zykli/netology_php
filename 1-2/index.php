<?php
  $x = rand(0, 100);
  echo "Число x=".$x;
  $y1 = 1;
  $y2 = 1;
  while (true) {
    if ($y1 > $x) {
      echo "задуманное число НЕ входит в числовой ряд";
      break;
    } else {
      if ($y1 == $x) {
        echo "задуманное число входит в числовой ряд";
        break;
      } else {
        echo " ".$y2." ";
        $y3 = $y1;
        $y1 += $y2;
        $y2 = $y3;
      }
    }
  }
