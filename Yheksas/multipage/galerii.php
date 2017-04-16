<?php require_once('head.html');?>

<h3>Fotod</h3>
<div id="gallery">
		
<?php 
$pildid=array(
  array("source"=>"pildid/nameless1.jpg", "alt"=>"nimetu 1", "id"=>1),
  array("source"=>"pildid/nameless2.jpg", "alt"=>"nimetu 2", "id"=>2),
  array("source"=>"pildid/nameless3.jpg", "alt"=>"nimetu 3", "id"=>3),
  array("source"=>"pildid/nameless4.jpg", "alt"=>"nimetu 4", "id"=>4),
  array("source"=>"pildid/nameless5.jpg", "alt"=>"nimetu 5", "id"=>5),
  array("source"=>"pildid/nameless6.jpg", "alt"=>"nimetu 6", "id"=>6)	
 );

foreach($pildid as $value){ 
	echo "<img src=\"".$value["source"]."\" alt=\"".$value["alt"]."\"/>";
		}; 
	?>
		
	</div>

<?php require_once('foot.html');?>