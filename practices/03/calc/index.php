<?php
session_start();
$left = isset($_GET['left']) ? $_GET['left'] : null;
$operator = isset($_GET['operator']) ? $_GET['operator'] : '+';
$right = isset($_GET['right']) ? $_GET['right'] : null;
$result = "計算結果なしお";

// 設定ファイル読み込み（送信アドレス）
$settings = require __DIR__ . '/../../secret-settings.php';

// IPアドレス読み込み
$ip = $_SERVER['REMOTE_ADDR'];

switch(strtolower($_SERVER['REQUEST_METHOD'])) {
	case 'post';
		if (!isset($_POST['token']) || !checkCsrfkey($_POST['token'])) {
			echo 'あなた、不正ね！';
			exit;
		}
		if(isset($_POST['result'])) {
			$body = 
				"簡易電卓プログラムからのお知らせ".
				"\n".
				"計算内容：{$_POST['result']}\n".
				"IPアドレス：{$ip}\n"
			;
			
				// 計算結果をメールで送信
				mb_language('ja');
				mb_internal_encoding('UTF-8');
				mb_send_mail($settings['email'], '簡易電卓プログラムからのお知らせ', $body, 'From: ' . mb_encode_mimeheader('簡易電卓プログラム') . ' <no-reply@example.com>');
		}
		break;
		
	case 'get':
	default:
		if(!is_null($left) && !is_null($right) ) {
			switch ($operator) {
				case '-':
					$answer = $left - $right;
					break;
				case '*':
					$answer = $left * $right;
					break;
				case '/':
					$answer = $left / $right;
					break;
				case '+':
				default:
					$answer = $left + $right;
					break;
			}
			$result = "{$left} {$operator} {$right} = {$answer}";
		}
		break;
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
	<input type="submit" value="計算！（GET）">
</form>
<form action="index.php" method="POST">
	<?php 
		// 100の倍数時のみ出現
		if(isset($answer) && $answer%100 === 0) { 
			echo '<input type="hidden" name="result" value='.$result.'>';
			
			// ワンタイムトークン出力
			echo '<input type="hidden" name="token" value='.generateCsrfKey().'>';
			
			echo '<input type="submit" value="送信！（POST）">'; 
		} 
	?>
</form>


<p><?php //echo 'REQUEST_METHOD：　'.$_SERVER['REQUEST_METHOD']; ?></p>
<p><?php //echo 'left：　'.$left; ?></p>
<p><?php //echo 'operator：　'.$operator; ?></p>
<p><?php //echo 'right：　'.$right; ?></p>
<p><?php //echo 'answer：　'.$answer; ?></p>
<p><?php //echo '1time_token：　'.$token; ?></p>

<p><?php echo 'result：　'.htmlspecialchars($result,ENT_QUOTES); ?></p>

</body>
</html>

<?php
//ワンタイムトークン作成＆セッション保存
function generateCsrfKey()
{
	return $_SESSION['csrf_key'] = sha1(uniqid(mt_rand(),true));
}

//ワンタイムトークンチェック
function checkCsrfkey($key)
{
	if(!isset($key) || !isset($_SESSION['csrf_key']) || $_SESSION['csrf_key'] !== $key) {
		return false;
	}
	return true;	
}

?>