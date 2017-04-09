<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Ylesanne kaheksa</title>		
		<style>
		#valikud{
			width: 200px;
			height: 100px;
			text-align: center;
			padding:10px;
			}
		</style>
		</head>
		<body>
		<?php $bg_col="#fff"; 		
			if (isset($_POST["bgcolor"]) && $_POST["bgcolor"]!="") {
   			 $bg_col=htmlspecialchars($_POST["bgcolor"]); 
			}
			
			$text="siia tuleb tekst"; 		
			if (isset($_POST["text"]) && $_POST["text"]!="") {
   			 $text=htmlspecialchars($_POST["text"]);
   			 }
   			 
   			 $text_col="#000000"; 		
			if (isset($_POST["text_color"]) && $_POST["text_color"]!="") {
   			 $text_col=htmlspecialchars($_POST["text_color"]);
   			 }
   			 
   			$line_ty="solid"; 		
			if (isset($_POST["line_type"]) && $_POST["line_type"]!="") {
   			$line_ty=htmlspecialchars($_POST["line_type"]);
   			}
   			
   			$line_w="5"; 		
			if (isset($_POST["line_width"]) && $_POST["line_width"]!="") {
   			$line_w=htmlspecialchars($_POST["line_width"]);
   			} 
   			 
   			$border_ra="10"; 		
			if (isset($_POST["border_radius"]) && $_POST["border_radius"]!="") {
   			$border_ra=htmlspecialchars($_POST["border_radius"]);
   			}
   			 
		?>
		
		<div id="valikud" style="background: <?php echo $bg_col; ?>; color: <?php echo $text_col; ?>; border: <?php echo $line_w; ?>px; border-style:  <?php echo $line_ty; ?>;  border-radius: <?php echo $border_ra; ?>px;"><?php echo $text; ?></div>
		
		
		<form action="kaheksas.php" method="POST">
		
		<p><textarea rows="3" cols="50" placeholder="Sisesta tekst" name="text"></textarea></p>
		<p><input type="color" name="bgcolor" value="00CCFF"> Taustavärvus</p>
		<p><input type="color" name="text_color" value="0000CC"> Tekstivärvus</p>
		
  		Piirjoon:<br>
  		<select name="line_ty">
  		<option value="solid">solid</option>
  		<option value="double">double</option>
 		<option value="dotted">dotted</option>
		</select><br>
		
		<p><input type="number" name="line_width" min="1" max="20">Piirjoone laius (0-20px)</p>
		<p><input type="number" name="border_radius" min="1" max="100">Nurga raadius (0-100px)</p>
 		 
 		<p><input type="submit" value="Edasta"></p>
		</form>
		
				

	</body>
</html>