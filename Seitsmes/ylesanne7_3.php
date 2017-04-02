<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>Koerad/title>
</head>
<body>
<?php $koerad= array( 
		array("nimi"=>"Muki", "toug"=>"krants", "värv"=>"kollane", "vanus"=> 8), 
		array("nimi"=>"Bob", "toug"=>"buldog", "värv"=>"beež", "vanus"=> 3),
		array("nimi"=>"Rex", "toug"=>"Saksa lambakoer", "värv"=>"must", "vanus"=> 5),
		array("nimi"=>"Tiku", "toug"=>"taks", "värv"=>"pruun", "vanus"=> 1),
		array("nimi"=>"Donna", "toug"=>"dogi", "värv"=>"valge", "vanus"=> 10),
	);
foreach ($koerad as $koer) {
    include 'seitsmes.html';
}
?>
</body>
</html>