<?php
	header("Content-type: image/png");
	$im     = imagecreatefrompng("img/certificate_template.png");
	imagealphablending($im, true);
	imageSaveAlpha($im, true);
	$orange = imagecolorallocate($im, 220, 210, 60);
	$black = imagecolorallocate($im, 0, 0, 0);

	switch ($_GET['result']) {
		case '3':
			$result = 'Удовлетворительно';
			$result_color = imagecolorallocate($im, 70, 70, 0);
			break;

		case '4':
			$result = 'Хорошечно!';
			$result_color = imagecolorallocate($im, 0, 95, 0);
			break;

		case '5':
			$result = 'Отлично!';
			$result_color = imagecolorallocate($im, 0, 70, 70);
			break;
		
		default:
			$result = 'Не обнаружен!';
			$result_color = imagecolorallocate($im, 127, 0, 0);
			break;
	}
	$fio = $_GET['fio'];
	$string2 = 'О прохождении теста "'.$_GET['testname'].'" получил(а):';

	$c_blue = imagecolorallocate($im, 64, 64, 255);
	$c_heading = 'СЕРТИФИКАТ';
	imagettftext($im, 20, 0, 333, 128, $c_blue, 'fonts/Helvetica Neue Condensed Bold.ttf', $c_heading);

	$c_text_blue = imagecolorallocate($im, 64, 64, 255);
	$string2_px = (imagesx($im) - 4 * mb_strlen($string2)) / 2;
	imagettftext($im, 12, 0, $string2_px, 186, $c_text_blue, 'fonts/Helvetica Neue Condensed Bold.ttf', $string2);

	$fio_px = (imagesx($im) - 4 * mb_strlen($fio)) / 2;
	imagettftext($im, 12, 0, $fio_px, 256, $black, 'fonts/Helvetica Neue Condensed Bold.ttf', $fio);

	imagettftext($im, 12, 0, 370, 330, $c_text_blue, 'fonts/Helvetica Neue Condensed Bold.ttf', 'Результат:');

	$result_px = (imagesx($im) - 4 * mb_strlen($result)) / 2;
	imagettftext($im, 12, 0, $result_px, 400, $result_color, 'fonts/Helvetica Neue Condensed Bold.ttf', $result);

	imagepng($im);
	imagedestroy($im);