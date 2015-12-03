<?php session_start();

	include_once("params.inc.php");
	$id = mysqli_connect($host, $user, $password, $dbname);

	if (!$id) {
		die("Erreur de Connexion(" . mysqli_connect_errno() . ') ' . mysqli_connect_error());
		
	} else {
	
		if (empty($_GET["prix"]) || empty($_GET["id_objet"])) {	
			header('location:./bid.php?'.$_GET['id_objet'].'&fail=yes');
			exit();
		} else {
		
		$prix = $_GET['prix']; //money_format('%.2n', $_GET['prix']);
		echo $prix;
	
		$req="	update `projet-objet` set
				`prix_actuel` = ".$prix.",
				`id_acheteur` = ".$_GET['id_acheteur']."
				where `id_objet` = ".$_GET['id_objet'];
				
		$res = mysqli_query($id, $req);
		
		echo "<br>".$_GET['id_objet']."<br>";
		
		if($res){
		
			header('location:./bid.php?id='.$_GET['id_objet']);
		
		} else {
		
			header('location:./bid.php?id='.$_GET['id_objet'].'&fail=yes');
		
		}
		
		mysqli_free_result($res);
		mysqli_close($id);
		
		}
	}
		
?>
