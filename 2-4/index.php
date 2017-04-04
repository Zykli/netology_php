<?php
session_start();
require_once 'functions.php';

if (isLogged()) {
	header('Location: http://university.netology.ru/u/zenkin/PHP/2-4/list.php');
	die;
}

$errors = [];
if (isPost()) {
	if (login(getParamPost('login'), getParamPost('password'))) {
		header('Location: http://university.netology.ru/u/zenkin/PHP/2-4/list.php');
		die;
	} else {
		$errors[] = 'Логин или пароль неверны.';
	}
}
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Авторизация</title>
	</head>
	<body>
		<?php foreach ($errors as $error):?>
			<p><?= $error ?></p>
		<?php endforeach?>
		<?php if (!isLogged()): ?>
			<h4>
	  		Введите имя пользователя и пароль.
			</h4>
			<h4>
	  		Либо воспользуйтей гостевым пользователем guest.
			</h4>
		<form action="/u/zenkin/PHP/2-4/index.php" method="POST">
			<label for="login">Введите логин:</label>
			<input id="login" name="login" value="<?= (string)getParamPost('login') ?>" type="text">
			<br />
			<label for="password">Введите пароль:</label>
			<input id="password" name="password" type="password">
			<br />
			<input type="submit" value="Войти">
		</form>
		<?php endif ?>
	</body>
</html>
