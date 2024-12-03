<?php 
	$sourcePath = $_FILES['file']['tmp_name']; 
	$targetPath = "photo/".$_FILES['file']['name']; 
	move_uploaded_file($sourcePath,$targetPath) ; 
	echo "<img id='image_preview' class=' ' src='photo/" . $_FILES["file"]["name"] . "' width='133px' style='margin: auto;padding-top: 6px'>";

 ?>