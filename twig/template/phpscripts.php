login

	if(!empty($_POST['registerButton'])) {
		$userName = filter_input(INPUT_POST, "login", FILTER_SANITIZE_STRING);
		$userPass = filter_input(INPUT_POST, "password", FILTER_SANITIZE_STRING);
		$userInsert = "INSERT INTO user (login, password) VALUES (:login, :password)";
		$statement = $db->prepare($userInsert);
		$statement->execute(["login" => "$userName", "password" => "$userPass"]);
		echo "Регистрация успешна";
	}
	if(!empty($_POST['loginButton'])) {
		$userName = filter_input(INPUT_POST, "login", FILTER_SANITIZE_STRING);
		$userPass = filter_input(INPUT_POST, "password", FILTER_SANITIZE_STRING);
		$userLogin = "SELECT * FROM user";
		$statement = $db->prepare($userLogin);
		$statement->execute();
		foreach ($statement as $row) {
			if($row['login'] == $userName && $row['password'] == $userPass) {
				$_SESSION['user'] = $row;
				header('Location: http://university.netology.ru/u/zenkin/twig/template/list.php');
				die;
			} else {
				echo "Данного пользователя не существует. Зарегистрируйтесь!";
			}
		}
	}
//


list
	session_start();
	$pdo = new PDO("mysql:host=localhost;dbname=zenkin;charset=utf8", "zenkin", "neto0677", [
		PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
	]);

	function getLoggedUser() {
	  return !empty($_SESSION['user']) ? $_SESSION['user'] : null;
	}
	function isLogged() {
	  return !empty($_SESSION['user']);
	}

	if(!isLogged()) {
		header('Location: http://university.netology.ru/u/zenkin/SQL/1-3/login.php');
    	exit();
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


