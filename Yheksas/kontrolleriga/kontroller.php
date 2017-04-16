<?php 
$pildid=array(
  array("source"=>"pildid/nameless1.jpg", "alt"=>"nimetu 1", "id"=>1),
  array("source"=>"pildid/nameless2.jpg", "alt"=>"nimetu 2", "id"=>2),
  array("source"=>"pildid/nameless3.jpg", "alt"=>"nimetu 3", "id"=>3),
  array("source"=>"pildid/nameless4.jpg", "alt"=>"nimetu 4", "id"=>4),
  array("source"=>"pildid/nameless5.jpg", "alt"=>"nimetu 5", "id"=>5),
  array("source"=>"pildid/nameless6.jpg", "alt"=>"nimetu 6", "id"=>6)	
 );
require_once "head.html";
 
$mode="pealeht"; 		
	if (isset($_GET["mode"]) && $_GET["mode"]!="") {
   	 $mode=htmlspecialchars($_GET["mode"]); 
	}
	
switch ($mode) {
    case "pealeht":
		include "pealeht.html";
        break;
    case "galerii":
		include "galerii.html";
        break;
    case "vote":
		include "vote.html";
        break;
    case "tulemus":
		include "tulemus.html";
        break;
    default:
		include "pealeht.html";
        break;
}	
require_once "foot.html";	
 	
?>