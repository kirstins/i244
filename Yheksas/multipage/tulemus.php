<?php require_once('head.html');?>
<h3>Valiku tulemus</h3>
	<?php 


	$valitud="";
	if (isset($_GET["pilt"]) &&!empty($_GET["pilt"])) {
	$valitud=$_GET["pilt"];
	$uusarray=$pildid[$valitud-1];
	echo "Valisid selle pildi:<br/>";
	echo "<img src=\"".$uusarray["source"]."\" alt=\"".$uusarray"alt"]."\"/>";
	
	}  else {
		echo "Vali palun uuesti";}
	?>
<?php require_once('foot.html');?>


