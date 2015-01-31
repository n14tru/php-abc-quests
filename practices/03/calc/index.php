<?php
if(isset($_GET['operator'])) {
	switch ($_GET['operator']) {
		case '+':
			$answer = $_GET['left'] + $_GET['right'];
			break;
		case '-':
			$answer = $_GET['left'] - $_GET['right'];
			break;
		case '*':
			$answer = $_GET['left'] * $_GET['right'];
			break;
		case '/':
			$answer = $_GET['left'] / $_GET['right'];
			break;
		default:
			$answer ='予期せぬエラー！';
			break;
	}
} else {
	$answer = "計算結果なしお";
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
	<input type="text" name="left"required autofocus/>
	<select name="operator">
		<option value="+" selected>+</option>
		<option value="-">-</option>
		<option value="*">×</option>
		<option value="/">÷</option>
	</select>
	<input type="text" name="right" required/>
	<input type="submit" value="計算する">
</form>

<p><?php echo $answer; ?></p>
</body>
</html>
