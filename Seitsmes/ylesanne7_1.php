<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Ülesanne 7.1</title>
</head>
<body>
<?php
	$sona = "veebirakendused";
	$length = strlen($sona);
	for ($i = $length-1; $i >= 0; $i--) {
	global $sona2;
	$sona2=$sona2.$sona[$i];
	}            
echo $string2;
?>

</body>
</html>