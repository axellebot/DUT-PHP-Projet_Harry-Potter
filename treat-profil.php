<?php session_start();

	mb_internal_encoding('UTF-8');

	include_once("params.inc.php");
	$id = mysqli_connect($host, $user, $password, $dbname);

	if (!$id) {
		die("Erreur de Connexion(" . mysqli_connect_errno() . ') ' . mysqli_connect_error());
	} else {

		print_r($_SESSION);
		echo "<br>";

		if (empty($_POST["prenom"]) || empty($_POST["nom"]) || empty($_POST["genre"]) || empty($_POST["mail"]) || empty($_POST["pwd"])) {

			header('location:./profil.php?update=fail');

		} else {

			$req = "update `projet-personne` set
					`prenom` = \"" . $_POST["prenom"] . "\",
					`nom` = \"" . $_POST["nom"] . "\",
					`genre` = \"" . $_POST["genre"] . "\",
					`mail` = \"" . $_POST["mail"] . "\",
					`mdp` = \"" . $_POST["pwd"] . "\"
					where `mail` like \"" . $_SESSION["login"] . "\"
					and `mdp` like \"" . $_SESSION["pwd"] . "\"";

			$_SESSION["login"] = $_POST["mail"];
			$_SESSION["pwd"] = $_POST["pwd"];

			$result = mysqli_query($id, $req);
			$donnees = mysqli_fetch_assoc($result);

			print_r($donnees);

			mysqli_free_result($result);
			mysqli_close($id);

			header('location:./profil.php?update=succes');
		}
	}
?>

