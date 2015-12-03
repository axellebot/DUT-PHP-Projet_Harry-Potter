<?php session_start();
//print_r($_FILES);
//print_r($_POST);
?>

<html>
	<head>
		<?php
		//include_once("./head.html")
		?>
		<title>Traitement Nouvelle Annonce</title>
	</head>

	<body>
	<?php
		#vérification du forms

		foreach ($_POST as $input => $value) {
			echo $input." -> ";
			echo $value."<br>";
			if (empty($value)) {
				header('location:./newbid.php?fail=yes');
				exit();
			}
		}

		if (floatval($_POST['prix'])<1) {
			header('location:./newbid.php?fail=prix');
			exit();
		}
		/*
		$acceptable_date= strtotime(date("Y-m-d 00:00:00", strtotime("tomorrow")));

		if ($_POST['date_fin'] <= date("Y-m-d",$acceptable_date)) {
			header('location:./newbid.php?fail=date');
			exit();
		}
		*/

		if (empty($_FILES) || empty($_FILES['image_objet']['name'])) {
			header('location:./newbid.php?fail=missing_image');
			exit();
		}
		

		#Genération nom unique de fichier
		$nom_fichier = md5(uniqid(rand(), true));
		$extension = strtolower(substr(strrchr($_FILES['image_objet']['name'], '.'), 1));
		$target_dir = "./assets";
		$target_file = $target_dir . '/' . $nom_fichier . '.' . $extension;


		#acces BD en PDO
		include_once("params.inc.php");

		try {
			// Data Source Name
			$dsn = 'mysql:host=' . $host . '; port=3306; dbname=' . $dbname;
			// instanciation
			$pdo = new PDO($dsn, $user, $password);
			// ici on est connecté …
		} catch (PDOException $e) {
			die("Erreur : " . $e->getMessage());
			exit();
		}


		//$req = "INSERT INTO `p1408263`.`projet-objet` (`id_objet`, `nom_objet`,`description`, `photo`, `prix_debut`,`prix_actuel`, `date_debut`, `date_fin`) VALUES (NULL,'" . $_POST['nom_objet'] . "','".$_POST['description']."','" . $nom_fichier . '.' . $extension . "', '" . $_POST['prix'] . "','".$_POST['prix']."','".date("Y-m-d H:i:s",time())."', '');";
		$req = 'INSERT INTO `p1408263`.`projet-objet`  (`id_objet`, `nom_objet`,`description`, `photo`, `prix_debut`,`prix_actuel`, `date_debut`, `date_fin`, `id_vendeur`, `id_acheteur`) 
												VALUES (NULL,"' . htmlspecialchars($_POST['nom_objet']) . '","' . htmlspecialchars($_POST['description']) . '","' . $nom_fichier . "." . $extension . '", "' . $_POST['prix'] . '","'.$_POST['prix'].'","'.date('Y-m-d').'","'.$_POST['date_fin'].'","'.$_SESSION['id'].'", "0");';
		$res = $pdo->exec($req);

		echo $req . "<br>";
		var_dump($res); echo "<br>";
		echo $res;

		if ($res != FALSE && $res !=0) {
			echo "Requete réussite<br>";
			#upload image
			$error = move_uploaded_file($_FILES["image_objet"]["tmp_name"], $target_file);
			if ($error) {
				echo "Transfert réussi !<br>";
				echo $target_file;
				header('Location:./bidlist.php');
			} else {
				echo "Erreur de transfert n°" . $_FILES["image_objet"]["error"] . "<br>";
				header('Location:./newbid.php?fail=image_transfert');

			}
		}
		if ($res == FALSE){
			header('Location:./newbid.php?fail=yes');
		}

		?>
	</body>
</html>