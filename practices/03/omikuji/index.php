<?php
switch (rand(0,9)) {
	case 0;
	case 1;
	case 2;
		$result = '大凶';
		break;
	case 3;
	case 4;
	case 5;
	case 6;
	case 7;
		$result = '吉';
		break;
	case 8;
	case 9;
		$result = '大吉';
		break;
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset='UTF-8'/>
	<title>omikuji_test</title>
</head>
<body>
<p>あなたの今日の運勢は<b><?php echo $result; ?></b>です。</p>
</body>
</html>