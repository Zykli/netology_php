<?php
session_start();
session_destroy();
header('Refresh: 2; URL= http://university.netology.ru/u/zenkin/twig/index.php');
  echo '<h3>Вы успешно вышли</h3>';
die;
?>
