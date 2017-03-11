<?php
  $name = 'Миша';
  $age = '27';
  $email = 'ZykliZen@gmail.com';
  $location = 'Москва';
  $about = 'начинающий backend разработчик)';
?>
<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
    <title></title>
    <style>
      p {
        display: table-row;
      }
      span {
        display: table-cell;
        padding: 0px 15px;
      }
    </style>
  </head>
  <body>
    <h1>Страница пользователя <?php echo $name?></h1>
    <p>
      <span>Имя</span>
      <span><?php echo $name?></span>
    </p>
    <p>
      <span>Возраст</span>
      <span><?php echo $age?></span>
    </p>
    <p>
      <span>Адрес электронной почты</span>
      <span>
        <a href="#"><?php echo $email?></a>
      </span>
    </p>
    <p>
      <span>Город</span>
      <span><?php echo $location?></span>
    </p>
    <p>
      <span>О себе</span>
      <span><?php echo $about?></span>
    </p>
  </body>
</html>
