<?php
	session_start();
	$pdo = new PDO("mysql:host=localhost;dbname=zenkin;charset=utf8", "zenkin", "neto0677", [
		PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
	]);

	function getLoggedUser() {
	  return !empty($_SESSION['user']) ? $_SESSION['user'] : null;
	}	

	$insert = "display: block;";
	$edit = "display: none;";
	$valueForEdit = "";

	$sqlUser = "SELECT * FROM user";
	$userTable = $pdo->prepare($sqlUser);
	$userTable->execute();

	if(!empty($_GET['action'])) {
		$missionId = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);
		if($_GET['action'] == "done") {
			$completeMission = "UPDATE task SET is_done = '1' WHERE id = :missionid";
			$statement = $pdo->prepare($completeMission);
			$statement->execute(["missionid" => "$missionId"]);
		} else if ($_GET['action'] == "delete") {
			$completeMission = "DELETE FROM task WHERE id = :missionid";
			$statement = $pdo->prepare($completeMission);
			$statement->execute(["missionid" => "$missionId"]);
		} else if ($_GET['action'] == "edit") {
			$insert = ifEdit("false");
			$edit = ifEdit("true");
			$descriptionForEdit = "SELECT description FROM task WHERE id = :missionid";
			$statement = $pdo->prepare($descriptionForEdit);
			$statement->execute(["missionid" => "$missionId"]);
			$valueForEdit = $statement->fetch();
		}
	}

	if (!empty($_POST['missionName'])) {
		$missionDecription = filter_input(INPUT_POST, "missionName", FILTER_SANITIZE_STRING);
		$createDate = date("Y-m-d H:m:s");
		$isDone = 0;
		$autorId = $_SESSION['user']['id'];
		$createMission = "INSERT INTO task (description, is_done, date_added, user_id, assigned_user_id) VALUES (:description, :isdone, :createdate, :authorid, :assigneduserid)";
		$statement = $pdo->prepare($createMission);
		$statement->execute(["description" => "$missionDecription", "isdone" => "$isDone", "createdate" => "$createDate", "authorid" => "$autorId", "assigneduserid" => "$autorId"]);
	}

	if (!empty($_POST['missionNameChandge'])) {
		$insert = ifEdit("true");
		$edit = ifEdit("false");
		$editId = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);
		$newMissionDecription = filter_input(INPUT_POST, "missionNameChandge", FILTER_SANITIZE_STRING);
		$chandgeMissionDecription = "UPDATE task SET description = :newmissiondesc WHERE id = :missionid";
		$statement = $pdo->prepare($chandgeMissionDecription);
		$statement->execute(["newmissiondesc" => "$newMissionDecription", "missionid" => "$editId"]);
		header('Location: http://university.netology.ru/u/zenkin/SQL/1-3/list.php');
    	exit();
	}

	if (!empty($_POST['assigned_user_id'])) {
		$assignValue = explode("_", $_POST['assigned_user_id']);
		$assignedUser = $assignValue[1];
		$assignedMissionId = $assignValue[3];
		$assignUpdate = "UPDATE task SET assigned_user_id = :assigneduser WHERE id = :missionid";
		$updateAssing = $pdo->prepare($assignUpdate);
		$updateAssing->execute(["assigneduser" => "$assignedUser", "missionid" => "$assignedMissionId"]);
	}	

	function ifEdit($value) {
		return $value == "true" ? "display: block;" : "display: none;";
	}

	function isDone($status) {
		return $status != 0 ? "color: green;" : "color: orange;";
	}


	$user = $_SESSION['user']['id'];
	$qwe = 'user.id=task.user_id';
	$sql = "SELECT task.id, task.description, task.is_done, task.date_added, user.login, userassing.login AS assignlogin FROM task JOIN user ON user.id = task.user_id JOIN user AS userassing ON userassing.id = task.assigned_user_id WHERE user_id = :userid;";
	$statement = $pdo->prepare($sql);
	$statement->execute(["userid" => "$user"]);

	$assignedsql = "SELECT task.id, task.description, task.is_done, task.date_added, user.login, userassing.login AS assignlogin FROM task JOIN user ON user.id = task.user_id JOIN user AS userassing ON userassing.id = task.assigned_user_id WHERE assigned_user_id = :assigneduserid AND user_id != :assigneduserid";
	$assignedlist = $pdo->prepare($assignedsql);
	$assignedlist->execute(["assigneduserid" => "$user"]);
	
	$sql = "SELECT * FROM user";
	$userList = $pdo->prepare($sql);
	$userList->execute();
	$userMass = $userList->fetchAll();
?>


<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Форма теста</title>
		<style type="text/css">
			table {
				border-collapse: collapse;
			}
			td, th {
				border: 1px solid black;
				padding: 2px 4px;
			}
			th {
				background-color: grey;
			}
			td > a {
				margin-right: 5px;
			}
		</style>
	</head>
	<body>
		<h2>Здравствуйте, <?= getLoggedUser()['login'] ?>! Вот ваш список дел:</h2>
		<form method="POST" style="margin: 50px 0px 20px 0px; <?= $insert?>">
			<span>
				<input type="text" name="missionName" placeholder="Описание задачи">
			</span>
			<span>
				<button type="submit">Добавить</button>
			</span>
		</form>
		<form method="POST" style="margin: 50px 0px 20px 0px; <?= $edit?>">
			<span>
				<input type="text" name="missionNameChandge" placeholder="Описание задачи" value="<?= $valueForEdit[0] ?>">
			</span>
			<span>
				<button type="submit">Сохранить</button>
			</span>
		</form>
		<table>
			<thead>
				<th>Описание задачи</th>
				<th>Дата добавления</th>
				<th>Статус</th>
				<th>Действия</th>
				<th>Ответственный</th>
				<th>Автор</th>
				<th>Закрепить задачу за пользователем</th>
			</thead>
			<tbody>
				<?php foreach ($statement as $row):?>
					<tr>
						<td><?= htmlspecialchars($row["description"], ENT_QUOTES) ?></td>
						<td><?= htmlspecialchars($row["date_added"], ENT_QUOTES) ?></td>
						<td style="<?= isDone(htmlspecialchars($row["is_done"], ENT_QUOTES))?>"><?= htmlspecialchars($row["is_done"], ENT_QUOTES) == 0 ? "Не выполнено" : "Выполенено" ?></td>
						<td>
							<a href="?id=<?=htmlspecialchars($row["id"])?>&action=edit">Изменить</a>
							<a href="?id=<?=htmlspecialchars($row["id"])?>&action=done">Выполнить</a>
							<a href="?id=<?=htmlspecialchars($row["id"])?>&action=delete">Удалить</a>
						</td>
						<td><?= htmlspecialchars($row["assignlogin"], ENT_QUOTES) ?></td>
						<td><?= htmlspecialchars($row["login"], ENT_QUOTES) ?></td>
						<td>
							<form method="POST">
								<select name="assigned_user_id">
									<?php for ($i=0; $i < count($userMass); $i++):?>
										<option value="user_<?= htmlspecialchars($userMass[$i]['id'])?>_task_<?= htmlspecialchars($row["id"])?>"><?= htmlspecialchars($userMass[$i]['login'])?></option>
									<?php endfor ?>
								</select>
								<button type="submit" name="assign">Переложить ответственность</button>
							</form>
						</td>
					</tr>
				<?php endforeach ?>
			</tbody>
		</table>
		<h3>Также, посмотрите, что от Вас требуют другие люди:</h3>
		<table>
			<thead>
				<th>Описание задачи</th>
				<th>Дата добавления</th>
				<th>Статус</th>
				<th>Действия</th>
				<th>Ответственный</th>
				<th>Автор</th>
			</thead>
			<tbody>
				<?php foreach ($assignedlist as $row):?>
					<tr>
						<td><?= htmlspecialchars($row["description"], ENT_QUOTES) ?></td>
						<td><?= htmlspecialchars($row["date_added"], ENT_QUOTES) ?></td>
						<td style="<?= isDone(htmlspecialchars($row["is_done"], ENT_QUOTES))?>"><?= htmlspecialchars($row["is_done"], ENT_QUOTES) == 0 ? "Не выполнено" : "Выполенено" ?></td>
						<td>
							<a href="?id=<?=htmlspecialchars($row["id"])?>&action=edit">Изменить</a>
							<a href="?id=<?=htmlspecialchars($row["id"])?>&action=done">Выполнить</a>
							<a href="?id=<?=htmlspecialchars($row["id"])?>&action=delete">Удалить</a>
						</td>
						<td><?= htmlspecialchars($row["assignlogin"], ENT_QUOTES) ?></td>
						<td><?= htmlspecialchars($row["login"], ENT_QUOTES) ?></td>
					</tr>
				<?php endforeach ?>
			</tbody>
		</table>

		<br>
		<br>
		<table>
			<?php foreach ($userTable as $rowUser):?>
				<tr>
					<td><?= htmlspecialchars($rowUser["id"], ENT_QUOTES) ?></td>
					<td><?= htmlspecialchars($rowUser["login"], ENT_QUOTES) ?></td>
					<td><?= htmlspecialchars($rowUser["password"], ENT_QUOTES) ?></td>
				</tr>
			<?php endforeach ?>
		</table>
		<br>
		<br>
		<div>
			<a href="http://university.netology.ru/u/zenkin/SQL/1-3/logout.php">Выйти</a>
		</div>
	</body>
</html>