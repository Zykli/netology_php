<?php

	function getLoggedUser() {
	  return !empty($_SESSION['user']) ? $_SESSION['user'] : null;
	}

	function isLogged() {
	  return !empty($_SESSION['user']);
	}

	function sqlRequest($db, $request) {
		return $db->prepare($request);
	}

	function ifEdit($value) {
		return $value == "true" ? "display: block;" : "display: none;";
	}

	function addMission($db, $params){
		$sth = $db->prepare("INSERT INTO task (description, is_done, date_added, user_id, assigned_user_id) VALUES (:description, :isdone, :createdate, :authorid, :assigneduserid)");
		$sth->bindValue(':description', $params['description'], PDO::PARAM_STR);
		$sth->bindValue(':isdone', $params['is_done'], PDO::PARAM_BOOL);
		$sth->bindValue(':createdate', $params['date_added'], PDO::PARAM_INT);
		$sth->bindValue(':authorid', $params['user_id'], PDO::PARAM_INT);
		$sth->bindValue(':assigneduserid', $params['assigned_user_id'], PDO::PARAM_INT);
		return $sth->execute();
	}

	function deleteMission($db, $params) {
		$sth = $db->prepare("DELETE FROM task WHERE id = :missionid");
		$sth->bindValue(':missionid', $params, PDO::PARAM_STR);
		return $sth->execute();
	}

	function completeMission($db, $params) {
		$sth = $db->prepare("UPDATE task SET is_done = '1' WHERE id = :missionid");
		$sth->bindValue(':missionid', $params, PDO::PARAM_STR);
		return $sth->execute();
	}

	function startEditMission($db, $params) {
		$sth = $db->prepare("SELECT description FROM task WHERE id = :missionid");
		$sth->bindValue(':missionid', $params, PDO::PARAM_STR);
		$sth->execute();
		return $sth->fetch();
	}

	function finishEditMission($db, $newDesc, $id) {
		$sth = $db->prepare("UPDATE task SET description = :newmissiondesc WHERE id = :missionid");
		$sth->bindValue(':newmissiondesc', $newDesc, PDO::PARAM_STR);
		$sth->bindValue(':missionid', $id, PDO::PARAM_STR);
		return $sth->execute();
	}

	function changeAssignedUser($db, $user, $id) {
		$sth = $db->prepare("UPDATE task SET assigned_user_id = :assigneduser WHERE id = :missionid");
		$sth->bindValue(':assigneduser', $user, PDO::PARAM_STR);
		$sth->bindValue(':missionid', $id, PDO::PARAM_STR);
		return $sth->execute();
	}