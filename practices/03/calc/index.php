﻿<?php
$left = isset($_GET['left']) ? $_GET['left'] : null;
$operator = isset($_GET['operator']) ? $_GET['operator'] : '+';
$right = isset($_GET['right']) ? $_GET['right'] : null;
$ip = $_SERVER['REMOTE_ADDR'];

if(!is_null($left) && !is_null($right) ) {
	switch ($operator) {
		case '+':
			$answer = $left + $right;
			break;
		case '-':
			$answer = $left - $right;
			break;
		case '*':
			$answer = $left * $right;
			break;
		case '/':
			$answer = $left / $right;
			break;
		default:
			$result ='予期せぬエラー！';
			break;
	}
	$result = "{$left} {$operator} {$right} = {$answer}";
	
	// 設定ファイル読み込み
	$settings = require __DIR__ . '/../../secret-settings.php';
	
	// 計算結果をメールで送信
    mb_language('ja');
    mb_internal_encoding('UTF-8');
    mb_send_mail($settings['email'], '計算結果', $result.' IP_Adress'.$ip, 'From: ' . mb_encode_mimeheader('簡易電卓プログラム') . ' <no-reply@example.com>');
	
} else {
	$answer = -1;	//初期表示用
	$result = "計算結果なしお";
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8"/>
    <title>calc_test</title>
</head>

<body>
<form action="index.php" method="GET">
	<input type="text" name="left" value="<?php echo $left; ?>" required autofocus/>
	<select name="operator">
		<option value="+" <?php if($operator == '+') { echo 'selected'; } ?>>+</option>
		<option value="-" <?php if($operator == '-') { echo 'selected'; } ?>>-</option>
		<option value="*" <?php if($operator == '*') { echo 'selected'; } ?>>*</option>
		<option value="/" <?php if($operator == '/') { echo 'selected'; } ?>>/</option>
	</select>
	<input type="text" name="right" value="<?php echo $right; ?>" required/>
	<input type="submit" value="計算する">
</form>

<p><?php echo $result; ?></p>

<form action="index.php" method="POST">
	<?php 
	// 100の倍数時のみ出現
	if($answer%100 == 0) { echo '<input type="submit" value="計算結果を送信する">'; } 
	?>
	
</form>

</body>
</html>
