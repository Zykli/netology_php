<?php
session_start();
require_once 'functions.php';
if(!isLogged()) {
	header('Location: http://university.netology.ru/u/zenkin/PHP/2-4/index.php');
	die;
}
	$fileDataName = __DIR__ . '/data.json';
	$data = json_decode(file_get_contents($fileDataName), true);
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Форма списка тестов</title>
  </head>
  <body>
		<div class="">
			<h4>
	  		Пользователь: <?= getLoggedUser()['name'] ?>
			</h4>
			<a href="http://university.netology.ru/u/zenkin/PHP/2-4/logout.php">Выйти</a>
		</div>
  	<ul>
  		<?php for ($i=0; $i < count($data) ; $i++):?>
  		<?php $href = 'test.php?name='.$data[$i]["name"]?>
  			<li>
  				<a href=<?=$href?>><?= $data[$i]["nameTest"]?></a>
  			</li>
  		<?php endfor;?>
		</ul>
		<div class="buttons">
			<a class="insert-button" style="<?= hide() ?> margin-right: 25px;" href="http://university.netology.ru/u/zenkin/PHP/2-4/admin.php">Добавить тест</a>
		</div>
  </body>
</html>
