<?php


	$pdo = new PDO("mysql:host=localhost;dbname=zenkin;charset=utf8", "zenkin", "neto0677", [
		PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
	]);

	$sqlUser = "CREATE TABLE `testTwo` (
	  `id` int(11) NOT NULL AUTO_INCREMENT,
	  `login` varchar(50) NOT NULL,
	  `password` varchar(255) NOT NULL,
	  PRIMARY KEY (`id`)
	) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
	$statementUser = $pdo->prepare($sqlUser);
	$statementUser->execute();
	echo "done";
?>