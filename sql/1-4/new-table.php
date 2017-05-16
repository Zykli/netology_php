<?php
	$pdo = new PDO("mysql:host=localhost;dbname=zenkin;charset=utf8", "zenkin", "neto0677", [
		PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
	]);

	if (!empty($_GET['name'])) {
		echo $_GET['name'];
	}


	if (!empty($_POST['name'])) {
		echo "asdasdasd";
	}



?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Задание SQL #4</title>
		<script src="jquery-3.1.1.js"></script>
		<script type="text/javascript">
		function numberRow() {
			var item = document.getElementsByClassName('row-item');
			for (var i = 0; i < item.length; i++) {
				item[i].innerHTML = i+1;
			}
		}
		$(document).ready(function () {
			numberRow();
			$('.newRow').click(function () {
				var row = document.getElementsByClassName('row');
				var newRowInsert = row[0].cloneNode(true);
				var number
				var table = document.getElementById('tableBody');
				$('#tableBody').append(newRowInsert);
				numberRow();
			});
		});
			
		</script>
	</head>
	<body>
		<h4>Создание новой таблицы: <?= filter_input(INPUT_GET, "name", FILTER_SANITIZE_STRING) ?></h4>
		<form method="post">
			<input type="text" name="name" placeholder="название поля">
			<select name="type">
				<option value="INT">INT</option>
				<option value="TINYINT">TINYINT</option>
				<option value="CHAR">CHAR</option>
				<option value="VARCHAR">VARCHAR</option>
				<option value="DECIMAL">DECIMAL</option>
			</select>
			<input type="text" name="">
			<input type="checkbox" name="">
			<button type="submit" name="create" style="display: block">Создать таблицу</button>
		</form>
		<form method="POST">
			<table>
				<thead>
					<th>№</th>
					<th>Имя</th>
					<th>Тип</th>
					<th>Длинна значения</th>
					<th>Не нулевое значение</th>
					<th>Автоматическое заполнение</th>
					<th>Primary key</th>
				</thead>
				<tbody id="tableBody">
						<tr class="row">
							<td class="row-item"></td>
							<td>
								<input type="text" name="name">
							</td>
							<td>
								<select name="type">
									<option value="INT">INT</option>
									<option value="TINYINT">TINYINT</option>
									<option value="CHAR">CHAR</option>
									<option value="VARCHAR">VARCHAR</option>
									<option value="DECIMAL">DECIMAL</option>
								</select>
							</td>
							<td>
								<input type="text" name="typeLength">
							</td>
							<td>
								<input type="checkbox" name="notNull">
							</td>
							<td>
								<input type="checkbox" name="autoIncrement">
							</td><td>
								<input type="checkbox" name="primaryKey">
							</td>
						</tr>
						<tr class="row">
							<td class="row-item"></td>
							<td>
								<input type="text" name="name">
							</td>
							<td>
								<select name="type">
									<option value="INT">INT</option>
									<option value="TINYINT">TINYINT</option>
									<option value="CHAR">CHAR</option>
									<option value="VARCHAR">VARCHAR</option>
									<option value="DECIMAL">DECIMAL</option>
								</select>
							</td>
							<td>
								<input type="text" name="typeLength">
							</td>
							<td>
								<input type="checkbox" name="notNull">
							</td>
							<td>
								<input type="checkbox" name="autoIncrement">
							</td><td>
								<input type="checkbox" name="primaryKey">
							</td>
						</tr>
						<tr class="row">
							<td class="row-item"></td>
							<td>
								<input type="text" name="name">
							</td>
							<td>
								<select name="type">
									<option value="INT">INT</option>
									<option value="TINYINT">TINYINT</option>
									<option value="CHAR">CHAR</option>
									<option value="VARCHAR">VARCHAR</option>
									<option value="DECIMAL">DECIMAL</option>
								</select>
							</td>
							<td>
								<input type="text" name="typeLength">
							</td>
							<td>
								<input type="checkbox" name="notNull">
							</td>
							<td>
								<input type="checkbox" name="autoIncrement">
							</td><td>
								<input type="checkbox" name="primaryKey">
							</td>
						</tr>
				</tbody>
			</table>
			<input type="button" class="newRow" value="Добавить строку" style="display: block">
			<button type="submit" name="create" style="display: block">Создать таблицу</button>
		</form>
	</body>
</html>