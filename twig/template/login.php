<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Авторизация</title>
	</head>
	<body>
		<h4>{{hello}}</h4>
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