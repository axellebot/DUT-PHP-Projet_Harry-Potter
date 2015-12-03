<?php session_start();

	include_once "./expiring_session.php";

	if ($_SESSION['login'] == NULL && $_SESSION['pwd'] == NULL) {
		HEADER("location:./login.php?target=newbid");
	}



	//acces BD en PDO
	include_once("./params.inc.php");

?>

<html>
	<head>
		<?php
		include_once("./head.html")
		?>
		<title>Nouvelle Annonce</title>
	</head>
	<body>


	<?php
	$page_actuel = "login";
	include "./header.php";
	?>

	<div class="structure">
		<div id="body">
			<section>
				<article class="centre">
					<h1>Nouvelle Annonce</h1>
				</article>
				<article>
					<form action='./treat-newbid.php' method="POST" enctype='multipart/form-data'>

						<label>Nom de l'objet : </label><input type="text" name="nom_objet" size="30" maxlength="40"
															   value=""><br><br>
						<label>Prix souhaité : </label><input class="prix" type="number" name="prix" value="1" min="1" step="0.01" value="" style="width:100px; text-align:right">€<br><br>
						<label>Date de fin : </label>
						<?php
						//echo strtotime(date("Y-m-d 00:00:00", strtotime("tomorrow")));
						$acceptable_date= strtotime(date("Y-m-d 00:00:00", strtotime("tomorrow")));
						//echo date("Y-m-d 00:00:00", strtotime("tomorrow"));

						echo "<input type='date' value='".date("Y-m-d",$acceptable_date) ."' min='".date("Y-m-d",$acceptable_date)."'name='date_fin' style='text-align:center''><br><br>";
						?>

						<label>Photo : </label><input type="file" name="image_objet" accept="image/*"><br><br>
						<label>Description : </label><textarea id="descri" type="text" name="description"  style='text-align: justify;'></textarea><br><br>
						<button type="reset">Effacer</button>
						<button type="submit">Envoyer</button>

					</form>

					<?php
					if (!empty($_GET['fail'])){
						if ($_GET['fail'] == "missing_image") {
							echo "Merci de mettre une image.<br>";
							echo "<script type='text/javascript'>alert('Image manquante.');</script>";
						}
						if ($_GET['fail'] == "prix") {
							echo "Prix trop faible.<br>";
							echo "<script type='text/javascript'>alert('Prix trop faible !');</script>";
						}
						if ($_GET['fail'] == "yes") {
							echo "Votre annonce n'a pas été publiée.<br>";
							echo "<script type='text/javascript'>alert('Votre annonce n\'a pas été publiée !');</script>";
						}
						if ($_GET['fail'] == "no") {
							echo "Votre annonce a été publiée avec succès.<br>";
							echo "<script type='text/javascript'>alert('Votre annonce a été publiée avec succès !');</script>";

						}
						if ($_GET['fail'] == "image_transfert") {
							echo "La photo n'a pas pu être transférée mais l'annonce à été créee.<br>";
							echo "<script type='text/javascript'>alert('La photo na pas pu être transféré mais lannonce à été crée !');</script>";
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