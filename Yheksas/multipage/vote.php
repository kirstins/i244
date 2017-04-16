<?php require_once('head.html');?>
	<h3>Vali oma lemmik :)</h3>
	<form action="tulemus.php" method="GET">

<?php 
$pildid=array(
  array("source"=>"pildid/nameless1.jpg", "alt"=>"nimetu 1", "id"=>1),
  array("source"=>"pildid/nameless2.jpg", "alt"=>"nimetu 2", "id"=>2),
  array("source"=>"pildid/nameless3.jpg", "alt"=>"nimetu 3", "id"=>3),
  array("source"=>"pildid/nameless4.jpg", "alt"=>"nimetu 4", "id"=>4),
  array("source"=>"pildid/nameless5.jpg", "alt"=>"nimetu 5", "id"=>5),
  array("source"=>"pildid/nameless6.jpg", "alt"=>"nimetu 6", "id"=>6)	
  );

 foreach($pildid as $value): {
	<p>
	<label for="p<?php echo $value['id'] ?>">
				<img src="<?php echo $value['source'] ?>" alt="<?php echo $value['alt'] ?>" height="100" />
	</label>
		<input type="radio" value="<?php echo $value['id'] ?>" id="p<?php echo $value['id'] ?>" name="pilt"/>		
	</p>
	} 
?>

	
	<br/>
	<input type="submit" value="Valin!"/>
</form>
<?php require_once('foot.html');?>