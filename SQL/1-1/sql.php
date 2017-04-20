<?php 
$pdo = new PDO("mysql:host=localhost;dbname=global;charset=utf8", "zenkin", "neto0677", [
		PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
	]);
$pdo ->exec("SET NAMES utf8");
	$sql = "SELECT * FROM books";
	$statement = $pdo->prepare($sql);
	$statement->execute();

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
		</style>
	</head>
	<body>
		<form action="/u/zenkin/SQL/1-1/sql.php" method="GET" style="margin: 50px 0px 20px 0px">
			<span></span>
				<label for="">ISBN</label>
				<input id="ISBN" type="text" name="ISBN" placeholder="ISBN">
			</span>
			<span>
				<label for="">Название</label>
				<input id="name" type="text" name="name" placeholder="Название книги">
			</span>
			<span>
				<label for="">Автор</label>
				<input id="author" type="text" name="author" placeholder="Автор книги">
			</span>
			<span>
				<button type="submit">Поиск</button>
			</span>
		</form>
		<table>
			<thead>
				<th>№</th>
				<th>Название</th>
				<th>Автор</th>
				<th>Год выпуска</th>
				<th>Жанр</th>
				<th>ISBN</th>
			</thead>
			<tbody>
				<?php foreach ($statement as $row):?>
				<tr>
					<td><?= htmlspecialchars($row["id"], ENT_QUOTES) ?></td>
					<td><?= htmlspecialchars($row["name"], ENT_QUOTES) ?></td>
					<td><?= htmlspecialchars($row["author"], ENT_QUOTES) ?></td>
					<td><?= htmlspecialchars($row["year"], ENT_QUOTES) ?></td>
					<td><?= htmlspecialchars($row["genre"], ENT_QUOTES) ?></td>
					<td><?= htmlspecialchars($row["isbn"], ENT_QUOTES) ?></td>
				</tr>
				<?php endforeach ?>
			</tbody>
		</table>
	</body>
</html>
