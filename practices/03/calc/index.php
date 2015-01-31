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
	<input type="text" name="left" value="<?php echo $_GET["left"]?>" required autofocus/>
	<select name="operator">
		<option value="+" <?php if($_GET["operator"] == '+') { echo "selected"; } ?>>+</option>
		<option value="-" <?php if($_GET["operator"] == '-') { echo "selected"; } ?>>-</option>
		<option value="*" <?php if($_GET["operator"] == '*') { echo "selected"; } ?>>*</option>
		<option value="/" <?php if($_GET["operator"] == '/') { echo "selected"; } ?>>/</option>
	</select>
	<input type="text" name="right" value="<?php echo $_GET["right"]?>" required/>
	<input type="submit" value="計算する">
</form>

<p><?php echo $_GET["left"].$_GET["operator"].$_GET["right"]."=".$answer; ?></p>
</body>
</html>
