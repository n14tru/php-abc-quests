<?php
switch (rand(0,9)) {
	case 0;
	case 1;
	case 2;
		$result = 'ごめんなさい。あなたの今日の運勢は<b>大凶</b>です。';
		break;
	case 3;
	case 4;
	case 5;
	case 6;
	case 7;
		$result = 'あなたの今日の運勢は<b>吉</b>です。';
		break;
	case 8;
	case 9;
		$result = 'おめでとうございます！あなたの今日の運勢は<b>大吉</b>です。';
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
<p><?php echo $result; ?></p>
</body>
</html>