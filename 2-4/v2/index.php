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

// if (empty($_SERVER['PHP_AUTH_USER']) && empty($_SERVER['PHP_AUTH_PW'])) {
// 	header('WWW-Authenticate: Basic realm="myrealm"');
// 	die;
// }
//
// $user = getUser($_SERVER['PHP_AUTH_USER']);
// if(!$user || $user['password'] != $_SERVER['PHP_AUTH_PW']) {
// 	http_response_code(403);
// 	die;
// }
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

<!-- <!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Форма отправки</title>
  </head>
  <body>

	  // if (isset($error)) {
  	// 	foreach ($error as $error) {
  	// 	echo '<p>'.$error.'</p>';
	  	}
  	}
  	?>
	<form enctype="multipart/form-data" action="/u/zenkin/PHP/2-3/index.php" method="POST">
		<label for="user-name">Введите логин:</label>
		<input id="user-name" name="user-name" type="text" placeholder="2+2">
		<br />
		<label for="password">Введите пароль:</label>
		<input id="password" name="password" type="text">
		<br />
		<input type="submit" value="Войти">
	</form>
  </body>
</html> -->
