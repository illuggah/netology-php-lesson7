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

	$tr_answers = json_decode(file_get_contents('uploaded_tests/'.$_GET['testfile']), true)['answers'];
	$primary_message = '';
	$total_count = 0;
	$passed_count = 0;
	$certificate_result = 0;

	if (!empty($_POST['fio'])) {
		if (isset($_POST['user_answers'])) {
			foreach ($_POST['user_answers'] as $us_key => $us_value) {
				$total_count++;
				if ($us_value == $tr_answers[$us_key]) {
					$passed_count++;
				}
			}

			$primary_message = 'Ваш результат:';
			$passed_count = $passed_count . ' / ';

			if ($total_count == 0) {$total_count = .1;}

			if (($passed_count/$total_count)*100 < 45) {
				$primary_message = '';
				$secondary_message = '<h3 class="text-danger">Тест не пройден</h3>';
				$passed_count = '';
				$total_count = '';}
			elseif (($passed_count/$total_count)*100 < 75) {
				$secondary_message = '<h3 class="text-warning">Удовлетворительно</h3>';
				$certificate_result = 3;}
			elseif (($passed_count/$total_count)*100 < 90) {
				$secondary_message = '<h3 class="text-success">Хорошо</h3>';
				$certificate_result = 4;}
			elseif (($passed_count/$total_count)*100 > 90) {
				$secondary_message = '<h3 class="text-success">Отлично!</h3>';
				$certificate_result = 5;}

			if (count($tr_answers) > count($_POST['user_answers'])) {
				$primary_message = '';
				$secondary_message = '<h3 class="text-danger">Ответьте на все вопросы!</h3>';
				$passed_count = '';
				$total_count = '';
				$certificate_result = 0;}
		} else {
			$primary_message = '';
			$secondary_message = '<h3 class="text-danger">Ответьте на все вопросы!</h3>';
			$passed_count = '';
			$total_count = '';
		}		
	} else {
		$secondary_message = '<h3 class="text-danger">Введите ФИО!</h3>';
		$passed_count = '';
		$total_count = '';
	}

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
	<div style="text-align: center;" class="container">
		<h2><?=$_GET['testname']?></h2><br><br>
		<h3><?=$primary_message?></h3>
		<?=$secondary_message?>
		<h3><?php echo $passed_count . $total_count; ?></h3><br><br>
		
		<?php 
			if ($certificate_result !== 0) {
				echo ('<img src="certificate.php?testname='.$_GET['testname'].'&result='.$certificate_result.'&fio='.$_POST['fio'].'" alt="certificate">');
			}
		?><br><br>

		<?php echo '<a href="test.php?testfile=' . $_GET['testfile'] . '" class="bg-warning">Вернуться к тесту</a>'?><br>
		<a href="list.php" class="bg-success">Вернуться к списку тестов</a><br>
		<a href="admin.php" class="bg-info">Загрузить файл теста</a>
	</div>
	<div class="row" style="height: 40px;"></div>
	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</body>
</html>