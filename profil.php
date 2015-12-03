<?php
// On démarre la session (ceci est indispensable dans toutes les pages de notre section membre)
session_start();


include_once "./expiring_session.php";


if ($_SESSION['login'] == NULL && $_SESSION['pwd'] == NULL) {
    HEADER("location:./login.php?target=login");
}




include_once("./params.inc.php");
?>

<html>
<head>
    <?php
    include_once("./head.html")
    ?>
    <title>Profil</title>
</head>

	<body>
	<?php
	$page_actuel = "profil";
	include("./header.php");
	?>

	<?php
	$id = mysqli_connect($host, $user, $password, $dbname);

	if (!$id) {
		die("Erreur de Connexion(" . mysqli_connect_errno() . ') ' . mysqli_connect_error());
	} else {

		$req = "SELECT * FROM `projet-personne` WHERE mail LIKE '" . $_SESSION["login"] . "'AND mdp LIKE '" . $_SESSION["pwd"] . "'";

		$result = mysqli_query($id, $req);
		$donnees = mysqli_fetch_assoc($result);

		mysqli_free_result($result);
		mysqli_close($id);
	}
	?>

	<?php
	// On récupère nos variables de session
	if (isset($_SESSION['login']) && isset($_SESSION['pwd'])) {
		?>

		<div class="structure">
			<div id="body">
				<section>
					<article class="centre">
						<h1>Modifiez votre profil</h1>
					</article>
					<article>
						<form action='./treat-profil.php' method="POST">

							<?php

							echo "<label>Prénom : </label><input type=\"firstname\" name=\"prenom\" size=\"30\" maxlength=\"40\" value='" . htmlspecialchars($donnees["prenom"]) . "'><br><br>";
							echo "<label>Nom : </label><input type=\"lastname\" name=\"nom\" size=\"30\" maxlength=\"40\" value='" . htmlspecialchars($donnees["nom"]) . "'><br><br>";

							if ($donnees["genre"] == "H") {
								echo "<input type=\"radio\" name=\"genre\" value=\"Homme\" checked> Homme<br>";
								echo "<input type=\"radio\" name=\"genre\" value=\"Femme\"> Femme<br>";
							} else {
								echo "<input type=\"radio\" name=\"genre\" value=\"Homme\"> Homme<br>";
								echo "<input type=\"radio\" name=\"genre\" value=\"Femme\" checked> Femme<br>";
							}

							echo "<br><label>E-mail : </label><input type=\"email\" name=\"mail\" size=\"30\" maxlength=\"40\" value=" . htmlspecialchars($donnees["mail"]) . "><br><br>";
							echo "<label>Password : </label><input type=\"password\" name=\"pwd\" size=\"30\" maxlength=\"40\" value=" . htmlspecialchars($donnees["mdp"]) . "><br><br>";

							?>

							<button type="submit">Mettre à jour</button>
							<br>

							<?php

							if (!empty($_GET["update"])) {
								echo "<br>";
								if ($_GET["update"] == "succes")
									echo "Profil mis à jour";
								elseif ($_GET["update"] == "fail")
									echo "Impossible de mettre à jour le profil";
							}
							?>

						</form>
					</article>
				</section>
			</div>
		</div>

	<?php
	} else
		header('location:./login.php?' . "target=" . $_GET['target']);
	?>

	<?php
		include "./footer.php";
	?>

	</body>
</html>