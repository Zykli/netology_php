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
		<br>
		<br>
		<h2>Здравствуйте, {{activeuser}}! Вот ваш список дел:</h2>
		<form method="POST" style="margin: 50px 0px 20px 0px; {{ insertfield }}">
			<span>
				<input type="text" name="missionName" placeholder="Описание задачи">
			</span>
			<span>
				<button type="submit">Добавить</button>
			</span>
		</form>
		<form method="POST" style="margin: 50px 0px 20px 0px; {{ editfield }}">
			<span>
				<input type="text" name="missionNameChandge" placeholder="Описание задачи" value="{{nameforedit}}">
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
				{% for row in statement %}
					<tr>
						<td>{{row.description}}</td>
						<td>{{row.date_added}}</td>
						<td style="{% if row.is_done == 0 %}
							    color:orange;
							{% else %}
							    color:green;
							{% endif %}">
							{% if row.is_done == 0 %}
							    Не выполнено
							{% else %}
							    Выполнено
							{% endif %}
						</td>
						<td>
							<a href="?id={{row.id}}&action=edit">Изменить</a>
							<a href="?id={{row.id}}&action=done">Выполнить</a>
							<a href="?id={{row.id}}&action=delete">Удалить</a>
						</td>
						<td>{{row.assignlogin}}</td>
						<td>{{row.login}}</td>
						<td>
							<form method="POST">
								<select name="assigned_user_id">
									{% for person in users %}
										<option value="user_{{person.id}}_task_{{row.id}}">{{ person.login }}</option>
									{% endfor %}
								</select>
								<button type="submit" name="assign">Переложить ответственность</button>
							</form>
						</td>
					</tr>
				{% endfor %}
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
				{% for row in assignedlist %}
					<tr>
						<td>{{row.description}}</td>
						<td>{{row.date_added}}</td>
						<td>{{row.is_done}}</td>
						<td>
							<a href="?id={{row.id}}&action=edit">Изменить</a>
							<a href="?id={{row.id}}&action=done">Выполнить</a>
							<a href="?id={{row.id}}&action=delete">Удалить</a>
						</td>
						<td>{{row.assignlogin}}</td>
						<td>{{row.login}}</td>
					</tr>
				{% endfor %}
			</tbody>
		</table>
		<div>
			<a href="http://university.netology.ru/u/zenkin/twig/template/logout.php">Выйти</a>
		</div>
	</body>
</html>