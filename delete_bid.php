<?php

	include_once("./params.inc.php");
	
	$link = mysqli_connect($host, $user, $password, $dbname);

	if (!$link) {
		die("Erreur de Connexion(" . mysqli_connect_errno() . ') ' . mysqli_connect_error());
	} else {
	
		$req = "DELETE FROM `projet-objet` WHERE `id_objet` = ".$_GET['id'];
		$result = mysqli_query($link, $req);			
		header('location:./bidlist.php?delete=yes');
		
		mysqli_free_result($result);
		mysqli_close($link);
	}
	
?>