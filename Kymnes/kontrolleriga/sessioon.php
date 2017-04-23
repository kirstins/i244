<?php
if(isset($_COOKIE[session_name()])) 
	{setcookie(session_name(), '',time()-42000, '/');
}
$_SESSION = array();
session_destroy();
header("Location: kontroller.php?page=vote");
?>