<?php 
$words = array('ラー','つけ','僕、イケ');
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8"/>
    <title>test</title>
</head>
<body>
<?php 
	foreach ($words as $out) {
	echo '<p>' . $out . 'メン!</p>'."\n\n\n";
	}
?>
</body>
</html>