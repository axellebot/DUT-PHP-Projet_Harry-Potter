<?php //suppression des objet dont la date est passée
	
	include_once("./params.inc.php");
	
	$link = mysqli_connect($host, $user, $password, $dbname);

	if (!$link) {
		die("Erreur de Connexion(" . mysqli_connect_errno() . ') ' . mysqli_connect_error());
	} else {

		$req = "SELECT `date_fin`, `id_objet` FROM `projet-objet`";
		$result = mysqli_query($link, $req);
		
		while($donnees = mysqli_fetch_row($result)){
			$date=$donnees[0];
			$id=$donnees[1];
			
			if($date<date('Y-m-d')){			
				$req2 = "DELETE FROM `projet-objet` WHERE `id_objet`=".$id;
				$result2 = mysqli_query($link, $req2);
			}
		}	
		
		mysqli_free_result($result);
		mysqli_close($id);
	}
	
	header('location:./home.php');
	
?>