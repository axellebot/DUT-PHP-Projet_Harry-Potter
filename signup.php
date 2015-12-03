<?php session_start();

include_once "./expiring_session.php";

/*if ($_SESSION['login'] == NULL && $_SESSION['pwd'] == NULL) {
   HEADER("location:./home.php");
}*/


?>

<!DOCTYPE html>
<html>
	<head>
		<?php
			include_once("./head.html")
		?>
		<title>S'INSCRIRE</title>
	</head>
	<body>

	<?php
		$page_actuel = "signup";
		include "./header.php";
	?>
	<div class="structure">
		<div id="body">
			<section>
				<article class="centre">
					<h1>Inscrivez-vous</h1>
				</article>
				<article>

					 <?php
						 if(isset($_GET['target'])){
							 echo "<form action='./treat-signup.php?target=" . $_GET['target'] . "' method=POST >";
						 }else{
							 echo "<form action='./treat-signup.php' method=POST >";
						 }
					 ?>
						
						<label>Prénom : </label><input type="text" name="prenom" size="30" maxlength="40" value=""><br><br>
						<label>Nom : </label><input type="text" name="nom" size="30" maxlength="40" value=""><br><br>

						<input type="radio" name="genre" value="H" checked> Homme<br>
						<input type="radio" name="genre" value="F"> Femme<br><br>

						<label>E-mail : </label><input type="email" name="mail" size="30" maxlength="40" value=""><br><br>
						<label>Password : </label><input type="password" name="pwd" size="30" maxlength="40" value=""><br><br>

						<button type="reset">Effacer</button>
						<button type="submit">S'inscrire</button>

					</form>
					<?php
					if (!empty($_GET['fail'])) {
						echo "<br>";
						if ($_GET['fail'] == "yes") {
							echo "Vous vous êtes mal enregistré ou l'email que vous avez entré est déjà enregistré";
						}
					}
					?>
				</article>
			</section>
		</div>
	</div>

	<?php
		include "./footer.php";
	?>
	<body>
<html>