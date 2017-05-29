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

function login(){
    global $connection;
 
    if (!empty($_SESSION['user'])){
        header("Location: ?mode=overview");
    }
    else {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $errors = array();

            if(empty($_POST["user"])) {
			$errors[]="Palun sisesta kasutajanimi!";
			}
		
			if(empty($_POST["pass"])) {
			$errors[]="Palun sisesta parool!";
			} 

            if (empty($errors)) {
                $kasutaja = mysqli_real_escape_string($connection, $_POST["user"]);
                $parool = mysqli_real_escape_string($connection, $_POST["pass"]);
                $sql = "SELECT id, usern  FROM ksaluvee_kasutajad WHERE usern = '$kasutaja' and passw= SHA1('$parool')";
                $result = mysqli_query($connection, $sql) or die ("ei saa parooli ja kasutajat kontrollitud".mysqli_error($connection));
                if ($result && $kasutaja = mysqli_fetch_assoc($result)){
                    $_SESSION['user'] = $kasutaja;
                    header("Location: ?mode=overview");
                } else {
                    header("Location: ?mode=login");
                }
            }
        }
    }
    include_once('views/login.html');
}

function logout ()
{
    $_SESSION = array ();
    session_destroy ();
    header ( "Location: ?" );
}


function view_costs(){
    global $connection;
    if (empty($_SESSION['user'])) {
        header("Location: ?mode=login");
    }
    
    $costs = array();
    $uid = mysqli_real_escape_string($connection, $_SESSION['user']['id']);
    $sql = "SELECT * FROM ksaluvee_kulud WHERE userid = '$uid' ORDER BY costdate DESC";
    $result_costs = mysqli_query($connection, $sql) or die ("Andmeid ei õnnestunud andmebaasist saada!");
    while ($result_cost = mysqli_fetch_assoc($result_costs)){
        $costs[] = $result_cost;
    }
    include_once('views/costhistory.html');
}

function view_income(){
    global $connection;
    if (empty($_SESSION['user'])) {
        header("Location: ?mode=login");
    }
    
    $incomes = array();
    $uid = mysqli_real_escape_string($connection, $_SESSION['user']['id']);
    $sql = "SELECT * FROM ksaluvee_tulud WHERE userid = '$uid' ORDER BY incomedate DESC";
    $result_incomes = mysqli_query($connection, $sql) or die ("Andmeid ei õnnestunud andmebaasist saada!");
    while ($result_income = mysqli_fetch_assoc($result_incomes)){
        $incomes[] = $result_income;
    }
    include_once('views/incomehistory.html');
}


function addcost(){
    global $connection;
    global $categories;
    $categories = array("Toit", "Elamiskulud", "Vaba aeg", "Muu");
    if (empty($_SESSION['user'])) {
        header("Location: ?mode=login");
        exit(0);
    }
    if(!empty($_POST)){
        $errors=array();
        if (empty($_POST['datec'])){
            $errors[]="Lisa kuupäev!";
        }
        if (empty($_POST['cat'])){
            $errors[]="Vali kulu kategooria!";
        }
        if (empty($_POST['sum'])){
            $errors[]="Lisa kulutuse summa!";
        }
        if (empty($errors)){
            $date=mysqli_real_escape_string($connection ,$_POST['datec']);
            $kategooria=mysqli_real_escape_string($connection,$_POST['cat']);
            $summa=mysqli_real_escape_string($connection,$_POST['sum']);
			$uid=mysqli_real_escape_string($connection, $_SESSION['user']['id']);

            $sql="INSERT INTO ksaluvee_kulud (userid, costdate, categorie, sum) VALUES ($uid, '$date', '$kategooria', $summa)";
            $result = mysqli_query($connection, $sql);
            if ($result){
                $id = mysqli_insert_id($connection);
                $_SESSION['message']="Kulu lisatud!";
                header("Location: ?");
                exit(0);
            } else {
                $errors[]="Kulu lisamine ei õnnestunud";
            }
        }
    }
    include_once('views/addcost.html');
}


function addincome(){
    global $connection;
    global $categories;
    $categories = array("Palk", "Muu");
    if (empty($_SESSION['user'])) {
        header("Location: ?mode=login");
        exit(0);
    }
    if(!empty($_POST)){
        $errors=array();
        if (empty($_POST['datec'])){
            $errors[]="Lisa kuupäev!";
        }
        if (empty($_POST['cat'])){
            $errors[]="Vali sissetuleku kategooria!";
        }
        if (empty($_POST['sum'])){
            $errors[]="Lisa sissetuleku suurus!";
        }
        if (empty($errors)){
            $date=mysqli_real_escape_string($connection ,$_POST['datec']);
            $kategooria=mysqli_real_escape_string($connection,$_POST['cat']);
            $summa=mysqli_real_escape_string($connection,$_POST['sum']);
            $uid=mysqli_real_escape_string($connection, $_SESSION['user']['id']);

            $sql="INSERT INTO ksaluvee_tulud (userid, incomedate, categorie, sum) VALUES ($uid, '$date', '$kategooria', $summa)";
            $result = mysqli_query($connection, $sql);
            if ($result){
                $id = mysqli_insert_id($connection);
                $_SESSION['message']="Tulu lisatud!";
                header("Location: ?");
                exit(0);
            } else {
                $errors[]="Sissetuleku lisamine ei õnnestunud";
            }
        }
    }
    include_once('views/addincome.html');
}
function register(){
	global $connection;

	if(!empty($_POST)){
		$errors=array();
		if (empty($_POST['user'])){
			$errors[]="Kasutajanimi puudu!";
		}
		if (empty($_POST['pass'])){
			$errors[]="Parool lisamata!";
		}
		if (empty($_POST['pass'])){
			$errors[]="Parooli pole lisatud 2 korda!";
		}
         //kontroll, kas paroolid on samad
		if(!empty($_POST['pass']) && !empty($_POST['pass2']) && $_POST['pass']!=$_POST['pass2']) {
			$errors[]="Paroolid ei ole samad!";
		}
		//kontroll, kas valitud kasutajanime juba pole
		if(!empty($_POST['user'])){
			$kasutaja = mysqli_real_escape_string($connection, $_POST["user"]);
			$sql = "SELECT * FROM ksaluvee_kasutajad Where usern = '$kasutaja'";
        	$result = mysqli_query ( $connection, $sql );
        	if ( mysqli_num_rows ($result) == 1 ) {
        	$errors[]="Selline kasutaja on juba olemas!";
			}
		}
		if (empty($errors)){
			$kasutaja=mysqli_real_escape_string($connection,$_POST['user']);
			$parool=mysqli_real_escape_string($connection,$_POST['pass']);
			
			$sql="INSERT INTO ksaluvee_kasutajad (usern, passw) VALUES ('$kasutaja', SHA1('$parool'))";
			$result = mysqli_query($connection, $sql);
			if ($result){
				header("Location: ?");
				exit(0);
			} else {
				$errors[]="Registreerumine ei õnnestunud. Proovi mõne aja pärast uuesti!";
			}
		}
	}

	include_once('views/register.html');
}
?>