<?php
	$pdo = new PDO("mysql:host=localhost;dbname=zenkin;charset=utf8", "zenkin", "neto0677", [
		PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
	]);
	if (!empty($_POST['newTableName'])) {
		$newTableName = filter_input(INPUT_POST, "newTableName", FILTER_SANITIZE_STRING);
		header('Location: http://university.netology.ru/u/zenkin/SQL/1-4/new-table.php?name='.$newTableName);
    	exit();
	}

	$sql = "SHOW TABLES";
	$userList = $pdo->prepare($sql);
	$userList->execute();
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Задание SQL #4</title>
	</head>
	<body>
		<h4>Таблицы базы данных</h4>
		<ul>
		<?php foreach($userList as $row => $value):?>
			<li>
				<a href="table.php?name=<?=$value[0]?>"><?=$value[0]?></a>
			</li>
		<?php endforeach ?>
		</ul>
	</body>
</html>
