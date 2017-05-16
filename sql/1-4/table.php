<?php
	$pdo = new PDO("mysql:host=localhost;dbname=zenkin;charset=utf8", "zenkin", "neto0677", [
		PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
	]);
	$editName = "display: none;";
	$editType = "display: none;";

	function ifEdit($value) {
		return $value == "true" ? "display: block;" : "display: none;";
	}

	if (!empty($_GET['name'])) {
		$tableName = filter_input(INPUT_GET, "name", FILTER_SANITIZE_STRING);
		$sql = "DESCRIBE $tableName";
		$table = $pdo->prepare($sql);
		$table->execute();
	} else {
		header('Location: http://university.netology.ru/u/zenkin/SQL/1-4/index.php');
    	exit();
	}


	if (!empty($_GET['action'])) {
		if ($_GET['action'] == "chandgeName") {
			$editName = ifEdit("true");
			$valueForEdit = filter_input(INPUT_GET, "itemName", FILTER_SANITIZE_STRING);
		} else if ($_GET['action'] == "chandgeType") {
			$editType = ifEdit("true");
			$fiedlTypeForEdit = filter_input(INPUT_GET, "itemType", FILTER_SANITIZE_STRING);
			$typeMass = split('[()]', $fiedlTypeForEdit);
		} else if ($_GET['action'] == "detele") {
			$filedlForDelete = filter_input(INPUT_GET, "itemName", FILTER_SANITIZE_STRING);
			$deleteField = "ALTER TABLE $tableName DROP COLUMN $filedlForDelete";
			$statement = $pdo->prepare($deleteField);
			$statement->execute();
			header('Location: http://university.netology.ru/u/zenkin/SQL/1-4/table.php?name='.$tableName);
    		exit();
		}
	}

	if (!empty($_POST['fieldNameChandge'])) {
		$edit = ifEdit("false");
		$newFieldName = filter_input(INPUT_POST, "fieldNameChandge", FILTER_SANITIZE_STRING);
		$fieldForEdit = filter_input(INPUT_GET, "itemName", FILTER_SANITIZE_STRING);
		$fieldTypeEditableField = filter_input(INPUT_GET, "itemType", FILTER_SANITIZE_STRING);
		$chandgeMissionDecription = "ALTER TABLE $tableName CHANGE $fieldForEdit $newFieldName $fieldTypeEditableField NOT NULL";
		$statement = $pdo->prepare($chandgeMissionDecription);
		$statement->execute();
		header('Location: http://university.netology.ru/u/zenkin/SQL/1-4/table.php?name='.$tableName);
    	exit();
	}

	if (isset($_POST['submitNewType'])) {
		$editType = ifEdit("false");
		$field = filter_input(INPUT_GET, "itemName", FILTER_SANITIZE_STRING);
		$newFieldType = filter_input(INPUT_POST, "typeForEdit", FILTER_SANITIZE_STRING);
		if ($newFieldType != "date") {
			$newFieldTypeLength = filter_input(INPUT_POST, "fieldTypeLengthChandge", FILTER_SANITIZE_STRING);
		$newTypeForSqlRquest = $newFieldType."(".$newFieldTypeLength.")";
		} else {
			$newTypeForSqlRquest = $newFieldType;
		}
		$chandgeMissionDecription = "ALTER TABLE $tableName MODIFY $field $newTypeForSqlRquest NOT NULL";
		$statement = $pdo->prepare($chandgeMissionDecription);
		$statement->execute();
		header('Location: http://university.netology.ru/u/zenkin/SQL/1-4/table.php?name='.$tableName);
    	exit();
	}

	
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Задание SQL #4</title>
		<script src="jquery-3.1.1.js"></script>
		<script type="text/javascript">
			$(document).ready(function () {
				$('#typeForEdit').change(function() {
					var curcolor = $('#typeForEdit :selected').val();
					if(curcolor == "date") {
						document.getElementById('fieldTypeLengthChandge').style.display = "none";
					} else {
						document.getElementById('fieldTypeLengthChandge').style.display = "inline-block";
					}
				});
			});
		</script>
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
		<h4>Таблица <?= $tableName?></h4>
		<table>
			<thead>
				<th>Field</th>
				<th>Type</th>
				<th>Null</th>
				<th>Key</th>
				<th>Dafault</th>
				<th>Extra</th>
				<th>Actions</th>
			</thead>
			<tbody>
				<?php foreach ($table as $key => $value):?>
				<tr>
					<?php 
						$fieldName = $value[0];
						$fieldType = $value[1];
					?>
					<?php foreach ($value as $name => $valueData):?>
						<?php if (is_string($name)):?>
							
							<td><?= $valueData?></td>
						<?php endif ?>
					<?php endforeach ?>
					<td>
						<a href="?name=<?=htmlspecialchars($tableName)?>&itemName=<?=htmlspecialchars($fieldName)?>&action=detele">Удалить</a>
						<a href="?name=<?=htmlspecialchars($tableName)?>&itemName=<?=htmlspecialchars($fieldName)?>&itemType=<?=htmlspecialchars($fieldType)?>&action=chandgeType">Изменить тип</a>
						<a href="?name=<?=htmlspecialchars($tableName)?>&itemName=<?=htmlspecialchars($fieldName)?>&itemType=<?=htmlspecialchars($fieldType)?>&action=chandgeName">Изменить название</a>
					</td>
				</tr>
				<?php endforeach ?>
			</tbody>
		</table>
		<form method="POST" style="margin: 50px 0px 20px 0px; <?= $editName?>">
			<span>
				<input type="text" name="fieldNameChandge" placeholder="Введите новое название поля" value="<?= $valueForEdit ?>"required>
			</span>
			<span>
				<button type="submit">Сохранить</button>
			</span>
		</form>
		<form method="POST" style="margin: 50px 0px 20px 0px; <?= $editType?>">
			<select name="typeForEdit" id="typeForEdit">
				<option value="int">INT</option>
				<option value="decimal">DECIMAL</option>
				<option value="varchar">VARCHAR</option>
				<option value="date">DATE</option>
			</select>
			<span>
				<input type="text" name="fieldTypeLengthChandge" id="fieldTypeLengthChandge" placeholder="Длинна/Значения" value="<?= $typeMass[1] ?>">
			</span>
			<span>
				<button type="submit" name="submitNewType">Сохранить</button>
			</span>
		</form>
		<a href="http://university.netology.ru/u/zenkin/SQL/1-4/index.php">Обратно к списку</a>
	</body>
</html>