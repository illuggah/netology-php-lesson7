<?php
	foreach (scandir('uploaded_tests/') as $key => $value) {
		if ('uploaded_tests/'.$value == 'uploaded_tests/'.$_GET['testfile']) {
			$request_check = true;
		}
	}

	if ($request_check !== true) {
		header("HTTP/1.0 404 Not Found");
		echo '<h1 style="text-align: center; font-size: 40pt;">404</h1><h1 style="text-align: center;">Страница не найдена</h1>';
		exit;
	}

	$test_contents = json_decode(file_get_contents('uploaded_tests/'.$_GET['testfile']), true);
?>

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
		<h2 style="text-align: center;"><?=$test_contents['testname']?></h2><br><br>
		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-8">
				<?php echo '<form action="answer_handler.php?testname=' . $test_contents['testname'] . '&testfile=' . $_GET['testfile'] . '" method="post">'; ?>
				<?php
					foreach ($test_contents as $pri_key => $pri_value) {
						if ($pri_key !== 'testname' && $pri_key !== 'answers') {
						echo '<div class="panel panel-info">';
							foreach ($pri_value as $se_key => $se_value) {
								if ($se_key == 'question') {echo '<div class="panel-heading"><h4>' . $pri_key . '. ' . $se_value . '</h4></div>';}
								elseif ($se_key == 'variants') {
									echo '<div class="panel-body"><div class="form-control">'. PHP_EOL;
									foreach ($se_value as $ter_key => $ter_value) {
										echo '<div class="radio-inline"><label><input type="radio" name="user_answers['.$pri_key.']"id="'.$pri_key.$ter_key.'"value="'.$ter_key.'">'.$ter_value.'</label></div>'. PHP_EOL;
									}
									echo '</div></div>'. PHP_EOL;
								}
							}
						echo '</div>'. PHP_EOL;
						}	
					}
				?>
					<div class="form-group">
						<label for="fio" class="control-label col-md-4 col-sm-4">ФИО: </label>
						<div class="col-md-4 col-sm-4">
							<input name="fio" type="text" placeholder="Введите ФИО" class="form-control" size="50">
						</div>
					</div>
					<button class="btn-success btn-block">Проверить!</button>
				</form>
			</div>
			<div class="col-md-2"></div>
		</div>
	</div>
	<div class="row" style="height: 40px;"></div>
	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</body>
</html>