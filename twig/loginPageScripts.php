<?php

	$params = array(
		'hello'=> 'Введите данные для регистрации или войдите, если уже регистрировались:'
	);
	if(!empty($_POST['registerButton'])) {
		$userName = filter_input(INPUT_POST, "login", FILTER_SANITIZE_STRING);
		$userPass = filter_input(INPUT_POST, "password", FILTER_SANITIZE_STRING);
		$userInsert = "INSERT INTO user (login, password) VALUES (:login, :password)";
		$statement = sqlRequest($db, $userInsert);
		$statement->execute(["login" => "$userName", "password" => "$userPass"]);
		echo "Регистрация успешна";
		}
	if(!empty($_POST['loginButton'])) {
		$userName = filter_input(INPUT_POST, "login", FILTER_SANITIZE_STRING);
		$userPass = filter_input(INPUT_POST, "password", FILTER_SANITIZE_STRING);
		$userLogin = "SELECT * FROM user";
		$statement = sqlRequest($db, $userLogin);
		$statement->execute();
		foreach ($statement as $row) {
			if($row['login'] == $userName && $row['password'] == $userPass) {
				$_SESSION['user'] = $row;
				header("Location: index.php");
			} else {
				echo "Данного пользователя не существует. Зарегистрируйтесь!";
			}
		}
	}
	$template = $twig->LoadTemplate('login.php');
	$template->display($params);