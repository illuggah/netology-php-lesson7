<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>JSON TEST form</title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body style="background-color: #d5deed">
	<nav class="navbar navbar-inverse">
		<div class="container">
			<div class="navbar-header">
				<button class="navbar-toggle" data-toggle="collapse" data-target=".navbar-top">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a href="#" class="navbar-brand">JSON TEST form</a>
			</div>
			<div class="navbar-collapse navbar-top collapse">
				<ul class="nav navbar-nav navbar-right">
					<li><a href="admin.php">ЗАГРУЗИТЬ ТЕСТ</a></li>
					<li><a href="list.php">СПИСОК ТЕСТОВ</a></li>
				</ul>
			</div>
		</div>
	</nav>
	<div class="container">
		<h2 style="text-align: center;">Здесь вы можете загрузить JSON файл теста</h2><br><br>
		<form enctype="multipart/form-data" method="POST" action="upload_handler.php" class="form-horizontal">
			<div class="form-group">
				<label for="fio" class="control-label col-md-4 col-sm-4">ФИО: </label>
				<div class="col-md-4 col-sm-4">
					<input name="fio" type="text" placeholder="Введите ФИО" class="form-control" size="50">
				</div>
			</div>
			<div class="form-group">
				<label for="userfile" class="control-label col-md-4 col-sm-4">Файл теста: </label>
				<div class="col-md-4 col-sm-4">
					<input name="userfile" type="file" />
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-4 col-sm-4"></div>
				<div class="col-md-4 col-sm-4">
					<button type="submit" value="Отправить" class="btn-success">Отправить</button>
				</div>
			</div>
		</form>
	</div>
	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</body>
</html>