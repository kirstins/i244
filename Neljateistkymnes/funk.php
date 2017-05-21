<?php


function connect_db(){
	global $connection;
	$host="localhost";
	$user="test";
	$pass="t3st3r123";
	$db="test";
	$connection = mysqli_connect($host, $user, $pass, $db) or die("ei saa ühendust mootoriga- ".mysqli_error());
	mysqli_query($connection, "SET CHARACTER SET UTF8") or die("Ei saanud baasi utf-8-sse - ".mysqli_error($connection));
}


function logi(){
	global $connection;
    if (!empty($_SESSION['user'])){
        header("Location: ?page=loomad");
     }else {

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
     	$errors=array();
		if(empty($_POST["user"])) {
		$errors[]="kasutajanimi puudu!";
		}
		
		if(empty($_POST["pass"])) {
		$errors[]="parool puudu!";
		} 

		if (empty($errors)) {
            $kasutaja = mysqli_real_escape_string($connection, $_POST["user"]);
			$parool = mysqli_real_escape_string($connection, $_POST["pass"]);
			$sql = "SELECT id FROM ksaluvee_kylastajad WHERE username = '$kasutaja' AND passw = SHA1('$parool')";
			$result = mysqli_query($connection, $sql);
			$arv = mysqli_num_rows($result);
			$role = mysqli_fetch_assoc($result);
               
                if ($arv) {
                    $_SESSION['user'] = $_POST['user'];
                    $_SESSION["role"] = $role["roll"];
                    header("Location: ?page=loomad");
                } else {
                    header("Location: ?page=login");
     } 
 	 }
     }
     }

	include_once('views/login.html');
}

function logout(){
	$_SESSION=array();
	session_destroy();
	header("Location: ?");
}

function upload($name){
	$allowedExts = array("jpg", "jpeg", "gif", "png");
	$allowedTypes = array("image/gif", "image/jpeg", "image/png","image/pjpeg");
	$extension = end(explode(".", $_FILES[$name]["name"]));

	if ( in_array($_FILES[$name]["type"], $allowedTypes)
		&& ($_FILES[$name]["size"] < 100000)
		&& in_array($extension, $allowedExts)) {
    // fail õiget tüüpi ja suurusega
		if ($_FILES[$name]["error"] > 0) {
			$_SESSION['notices'][]= "Return Code: " . $_FILES[$name]["error"];
			return "";
		} else {
      // vigu ei ole
			if (file_exists("pildid/" . $_FILES[$name]["name"])) {
        // fail olemas ära uuesti lae, tagasta failinimi
				$_SESSION['notices'][]= $_FILES[$name]["name"] . " juba eksisteerib. ";
				return "pildid/" .$_FILES[$name]["name"];
			} else {
        // kõik ok, aseta pilt
				move_uploaded_file($_FILES[$name]["tmp_name"], "pildid/" . $_FILES[$name]["name"]);
				return "pildid/" .$_FILES[$name]["name"];
			}
		}
	} else {
		return "";
	}
}

function lisa(){

	if (empty($_SESSION["user"])){ 		
		header("Location: ?page=login");

	}else{
		if ($_SESSION["role"] == 'admin') {

	if ($_SERVER["REQUEST_METHOD"] == "POST"){
		global $connection;
		$errors=array();
	
		if(empty($_POST["nimi"])) {
		$errors[]="looma nimi puudu!";
		}
		
		if(empty($_POST["puur"])) {
		$errors[]="puurinr puudu!";
		} 
		
		if (empty($errors)) {
		upload('liik');
		$loomanimi = mysqli_real_escape_string($connection, $_POST["nimi"]);
		$puuri_nr = mysqli_real_escape_string($connection, $_POST["puur"]);
		$liik = mysqli_real_escape_string($connection, "pildid/".$_FILES["liik"]["name"]);
        $sql = "INSERT INTO ksaluvee_loomaaed (nimi, puur, liik) VALUES ('{$loomanimi}','{$puuri_nr}', '{$liik}')";
		$result = mysqli_query($connection, $sql); 
			
		$nr = mysqli_insert_id($connection);
		if ($nr){
		header("Location: ?page=loomad");
		} else {
		header("Location: ?page=lisa");
			}
		}		
	}

	}else{
			header("Location: ?page=loomad");
		}	
	
	include_once('views/loomavorm.html');
	
}

function kuva_puurid(){
	global $connection;
	if (empty($_SESSION["user"])){ 		
		header("Location: ?page=login");
	$p= mysqli_query($connection, "select distinct(puur) as puur from loomaaed order by puur asc");
	$puurid=array();
	while ($r=mysqli_fetch_assoc($p)){
		$l=mysqli_query($connection, "SELECT * FROM ksaluvee_loomaaed WHERE  puur=".mysqli_real_escape_string($connection, $r['puur']));
		while ($row=mysqli_fetch_assoc($l)) {
			$puurid[$r['puur']][]=$row;
		}
	}
	include_once('views/puurid.html');
	
}
function hangi_loom($id){
	global $connection;
	$sql= "SELECT * FROM ksaluvee_loomaaed WHERE id = ".$id;
	$result = mysqli_query($connection, $sql);
	$number= mysqli_num_rows($result);
	$vastus = mysqli_fetch_array($result);
	if($number<1) {
	header("Location: ?page=loomad");
	}
	return $vastus;	
}
function muuda(){

	global $connection;

	if (empty($_SESSION["user"])){ 		
		header("Location: ?page=login");

	}else{
		if ($_SESSION["role"] == 'admin') {

		if ($_SERVER["REQUEST_METHOD"] == "POST"){
			if($_POST["id"] == ''){
			header("Location: ?page=loomad");
			}else{
			$muutuja = hangi_loom($_POST["id"]);
			$tid= $_POST["id"];
	
			upload('liik');

			$loomanimi = mysqli_real_escape_string($connection, $_POST["nimi"]);
			$puuri_nr = mysqli_real_escape_string($connection, $_POST["puur"]);
			$liik = mysqli_real_escape_string($connection, "pildid/".$_FILES["liik"]["name"]);
        	$sql = "UPDATE ksaluvee_loomaaed SET nimi='$nimi', PUUR ='$puur', liik = '$liik' WHERE id='tid'";
			$result = mysqli_query($connection, $sql); 
			
			$nr = mysqli_insert_id($connection);
			if ($nr){
			header("Location: ?page=loomad");
			} else {
			header("Location: ?page=muuda");
			}
		}	
	}

	}else{
			header("Location: ?page=loomad");
		}	
	include_once('views/editvorm.html');

}
?>