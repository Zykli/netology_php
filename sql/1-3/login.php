<?php
	session_start();
	$pdo = new PDO("mysql:host=localhost;dbname=zenkin;charset=utf8", "zenkin", "neto0677", [
		PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
	]);

	if(!empty($_POST['registerButton'])) {
		$userName = filter_input(INPUT_POST, "login", FILTER_SANITIZE_STRING);
		$userPass = filter_input(INPUT_POST, "password", FILTER_SANITIZE_STRING);
		$userInsert = "INSERT INTO user (login, password) VALUES (:login, :password)";
		$statement = $pdo->prepare($userInsert);
		$statement->execute(["login" => "$userName", "password" => "$userPass"]);
		echo "Регистрация успешна"ж
	}
	if(!empty($_POST['loginButton'])) {
		$userName = filter_input(INPUT_POST, "login", FILTER_SANITIZE_STRING);
		$userPass = filter_input(INPUT_POST, "password", FILTER_SANITIZE_STRING);
		$userLogin = "SELECT * FROM user";
		$statement = $pdo->prepare($userLogin);
		$statement->execute();
		foreach ($statement as $row) {
			if($row['login'] == $userName && $row['password'] == $userPass) {
				$_SESSION['user'] = $row;
				header('Location: http://university.netology.ru/u/zenkin/SQL/1-3/list.php');
				die;
			} else {
				echo "Данного пользователя не существует. Зарегистрируйтесь!";
			}
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
		<h4>Введите данные для регистрации или войдите, если уже регистрировались:</h4>
		<form method="POST">
			<label for="login">Введите логин:</label>
			<input id="login" name="login" value="" type="text">
			<br />
			<label for="password">Введите пароль:</label>
			<input id="password" name="password" type="password">
			<br />
			<input type="submit" name="loginButton" value="Войти">
			<input type="submit" name="registerButton" value="Зарегистрироваться">
		</form>
	</body>
</html>
