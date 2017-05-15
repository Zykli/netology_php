<?php
	$insert = "display: block;";
	$edit = "display: none;";
	$nameForEdit = "";

	$sqlUser = "SELECT * FROM user";
	$userTable = sqlRequest($db, $sqlUser);
	$userTable->execute();

	if(!empty($_GET['action'])) {
		$missionId = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);
		if($_GET['action'] == "done") {
			completeMission($db, $missionId);
		} else if ($_GET['action'] == "delete") {
			deleteMission ($db, $missionId);
		} else if ($_GET['action'] == "edit") {
			$insert = ifEdit("false");
			$edit = ifEdit("true");
			$valueForEdit = startEditMission($db, $missionId);
			$nameForEdit = $valueForEdit[0];
		}
	}

	if (!empty($_POST['missionName'])) {
		$missionDecription = filter_input(INPUT_POST, "missionName", FILTER_SANITIZE_STRING);
		$createDate = date("Y-m-d H:m:s");
		$isDone = 0;
		$autorId = $_SESSION['user']['id'];
		$newMission = array(
			'description' => $missionDecription,
			'is_done' => $isDone,
			'date_added' => $createDate,
			'user_id' => $autorId,
			'assigned_user_id' => $autorId
			);
		addMission($db, $newMission);
	}

	if (!empty($_POST['missionNameChandge'])) {
		$insert = ifEdit("true");
		$edit = ifEdit("false");
		$editId = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);
		$newMissionDecription = filter_input(INPUT_POST, "missionNameChandge", FILTER_SANITIZE_STRING);
		finishEditMission ($db, $newMissionDecription, $editId);
		header('Location: http://university.netology.ru/u/zenkin/SQL/1-3/list.php');
    	exit();
	}

	if (!empty($_POST['assigned_user_id'])) {
		$assignValue = explode("_", $_POST['assigned_user_id']);
		$assignedUser = $assignValue[1];
		$assignedMissionId = $assignValue[3];
		changeAssignedUser($db, $assignedUser, $assignedMissionId);
	}

	$user = $_SESSION['user']['id'];

	$qwe = 'user.id=task.user_id';
	$sql = "SELECT task.id, task.description, task.is_done, task.date_added, user.login, userassing.login AS assignlogin FROM task JOIN user ON user.id = task.user_id JOIN user AS userassing ON userassing.id = task.assigned_user_id WHERE user_id = :userid;";
	$statement = sqlRequest($db, $sql);
	$statement->execute(["userid" => "$user"]);

	$assignedsql = "SELECT task.id, task.description, task.is_done, task.date_added, user.login, userassing.login AS assignlogin FROM task JOIN user ON user.id = task.user_id JOIN user AS userassing ON userassing.id = task.assigned_user_id WHERE assigned_user_id = :assigneduserid AND user_id != :assigneduserid";
	$assignedlist = sqlRequest($db, $assignedsql);
	$assignedlist->execute(["assigneduserid" => "$user"]);
	
	$sql = "SELECT * FROM user";
	$userList = sqlRequest($db, $sql);
	$userList->execute();
	$userMass = $userList->fetchAll();

	$params = array(
		'activeuser' => $_SESSION['user']['login'],
		'insertfield' => $insert,
		'editfield' => $edit,
		'nameforedit' => $nameForEdit,
		'statement' => $statement,
		'assignedlist' => $assignedlist,
		'users' => $userMass);

	$template = $twig->LoadTemplate('list.php');
	$template->display($params);