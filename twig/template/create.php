<?php


	$pdo = new PDO("mysql:host=localhost;dbname=zenkin;charset=utf8", "zenkin", "neto0677", [
		PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
	]);

	$sqlTask = "CREATE TABLE `task` (
	  `id` int(11) NOT NULL AUTO_INCREMENT,
	  `user_id` int(11) NOT NULL,
	  `assigned_user_id` int(11) DEFAULT NULL,
	  `description` text NOT NULL,
	  `is_done` tinyint(4) NOT NULL DEFAULT '0',
	  `date_added` datetime NOT NULL,
	  PRIMARY KEY (`id`)
	) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
	$statement = $pdo->prepare($sqlTask);
	$statement->execute();

	$sqlUser = "CREATE TABLE `user` (
	  `id` int(11) NOT NULL AUTO_INCREMENT,
	  `login` varchar(50) NOT NULL,
	  `password` varchar(255) NOT NULL,
	  PRIMARY KEY (`id`)
	) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
	$statementUser = $pdo->prepare($sqlUser);
	$statementUser->execute();
	echo "done";
?>