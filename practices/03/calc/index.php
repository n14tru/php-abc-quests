<?php
$left = isset($_GET['left']) ? $_GET['left'] : null;
$operator = isset($_GET['operator']) ? $_GET['operator'] : '+';
$right = isset($_GET['right']) ? $_GET['right'] : null;

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
} else {
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
</body>
</html>
