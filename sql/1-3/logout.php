<?php
session_start();
session_destroy();
header('Refresh: 2; URL= http://university.netology.ru/u/zenkin/SQL/1-3/login.php');
  echo '<h3>Вы успешно вышли</h3>';
die;
?>
