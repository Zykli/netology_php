<link rel="stylesheet" type="text/css" href="master.css" />

<?php
  $content = file_get_contents('http://api.openweathermap.org/data/2.5/weather?q=Moscow&appid=8a409801ea46a9bfa88f74a2b1abe873');

  $weatherData = json_decode($content, true);
  $cityName = $weatherData['name'];
  $cityWeather = $weatherData['weather'][0]['main'];
  $cityWind = $weatherData['wind']['speed'];
  $cityTemp = $weatherData['main']['temp'] - 273.15;
  $cityWeather = $weatherData['weather'][0]['main'];
  echo "<header>";
  echo "</header>";
  echo "<div style='position: relative;'>";
    echo "<span>";
    echo 'City: '.$cityName;
    echo "</span>";
    echo "<span>";
    echo 'Weather: '.$cityWeather;
    echo "</span>";
    echo "<span>";
    echo 'Wind: '.$cityWind.' m/h';
    echo "</span>";
    echo "<span>";
    echo 'Tempareture: '.$cityTemp.'C';
    echo "</span>";
    $imagesWeather = 'imgWeather/'.$cityWeather.'.png';
    echo '<img src = "'.$imagesWeather.'">';
  echo "</div>";
