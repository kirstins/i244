<?php
session_start();
$user = "test";
$pass = "t3st3r123";
$db = "test";
$host = "localhost";
$link = mysqli_connect($host, $user, $pass, $db) or die("ei saanud ühendatud");
$connection = mysqli_connect($host, $user, $pass, $db) or die("ei saa ühendust mootoriga- ".mysqli_error());
mysqli_query($connection, "SET CHARACTER SET UTF8") or die("Ei saanud baasi utf-8-sse - ".mysqli_error($connection));

if (isset($_GET['pakkumine'])){
	$pakkumised=array();

    if (isset($_POST['nupp'])){
		$bid=mysqli_real_escape_string($connection, $_POST["sum"]);
		$ip=$_SERVER['REMOTE_ADDR'];

		$sql="INSERT INTO ksaluvee_pakkumised (kasutajaip, pakkumine) VALUES ('$ip', '$bid')";

		if ($connection->query($sql) === TRUE) { 
   	 	echo "<br> Sinu pakkumine on kirjas! <br> <br>";
		} else {
    	echo "Viga: " . $sql . "<br>" . $connection->error;
		}

		$query="SELECT kasutajaip, MAX(pakkumine) AS max FROM ksaluvee_pakkumised GROUP BY kasutajaip";
		$result = mysqli_query($connection, $query) or die("$query - ".mysqli_error($connection));
		while($rida = mysqli_fetch_assoc($result)){
		$pakkumised[]=$rida;	
		}
	}

 }

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Enampakkumine</title>
</head>

<body>
<div>

<h2> Sinu pakkumine: </h2>
<form action="?pakkumine" method="POST">

<input type="number" name="sum" value = "<?php if (!empty($_POST['sum'])) echo htmlspecialchars($_POST['sum']);?>"/><br/><br>
<input type="submit" name="nupp" value="Tee pakkumine!"/><br><br>

</form>

<?php if(!empty($pakkumised)):
	foreach($pakkumised as $p):?>
			<p>Parim tehtud pakkumine on: <?php echo $p['max']; ?></p> 
			<p>Parima pakkumise tegi kasutaja, kelle IP-aadress on järgmine: <?php echo $p['kasutajaip']; ?></p> 
		<?php	endforeach; endif; ?>

</div>
</body>

</html>