<?php
session_start();
require_once 'functions.php';
logOut();
header('Refresh: 2; URL= https://university.netology.ru/u/zenkin/PHP/2-4/index.php');
  echo '<h3>Вы успешно вышли</h3>';
die;
?>
