<?php
  $content = file_get_contents('phonebook.json');
  $phoneBook = json_decode($content, true);
  $firstName = $phoneBook[0]['firstName'];
  $lastName = $phoneBook[0]['lastName'];
  echo "<div style='position: relative;'>";
  echo "<h2>Телефоннкая книга</h2>";
    echo "<table>";
      echo "<thead>";
        echo "<td>";
          echo "Имя";
        echo "</td>";
        echo "<td>";
          echo "Фамилия";
        echo "</td>";
        echo "<td>";
          echo "Адресс";
        echo "</td>";
        echo "<td>";
          echo "Номер телефона";
        echo "</td>";
      echo "</thead>";
      echo "<tbody>";
      for ($i=0; $i < count($phoneBook) ; $i++) {
        echo "<tr>";
          echo "<td>";
            echo $phoneBook[$i]['firstName'];
          echo "</td>";
          echo "<td>";
            echo $phoneBook[$i]['lastName'];
          echo "</td>";
          echo "<td>";
            echo $phoneBook[$i]['address'];
          echo "</td>";
          echo "<td>";
            echo $phoneBook[$i]['phoneNumber'];
          echo "</td>";
        echo "</tr>";
      }
      echo "</tbody>";
    echo "</table>";
  echo "</div>";
