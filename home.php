<?php session_start(); 
include_once("./params.inc.php");
?>

<html>
	<head>
		<?php
			include_once("./head.html")
		?>
		<title>Accueil</title>
	</head>
	<body>

	<?php
		$page_actuel = "home";
		include("./header.php");
	?>

	<div class="structure">
		<div id="body">
			<section>
				<article class='centre'>
					<h1>Site d'enchères consacré à Harry Potter</h1>
				</article>
				
				<article>
					<p class="artcile" style="width: 49%; text-align:justify; display: inline-block;">
					<br><br>
					<a href="https://fr.wikipedia.org/wiki/Harry_Potter" target="_blank">Harry Potter</a>
					est une suite romanesque fantasy comprenant sept romans,
					écrits par <a href="https://fr.wikipedia.org/wiki/J._K._Rowling" target="_blank">J. K. Rowling</a>
					et parus entre 1997 et 2007.<br> Elle narre les aventures d'un
					apprenti sorcier nommé Harry Potter à l'école de sorcellerie Poudlard.<br>
					L'intrigue principale de la série met en scène le combat du jeune Harry Potter
					contre un mage noir réputé invincible, Lord Voldemort.<br>
					Huit films à succès, ainsi que des jeux vidéo et de nombreux
					autres produits dérivés ont été adaptés de la série de romans.
					<br><br><br><br>
					</p>
					<img class="article" style="float: right;" width='50%'  src='./rsc/pic.jpg'>
				</article>
				
				<!-- Vos Annonces --> 
				
				<?php if (isset($_SESSION) && isset($_SESSION['login']) && isset($_SESSION['pwd'])) {
				
						try {
							//Data Source Name
							$dsn = 'mysql:host=' . $host . '; port=3306; dbname=' . $dbname;
							//instanciation
							$pdo = new PDO($dsn, $user, $password);
							//ici on est connecté …
						} catch (PDOException $e) {
							die("Erreur : " . $e->getMessage());
						}
						
						$req = "SELECT * FROM `p1408263`.`projet-objet` WHERE id_vendeur = ".$_SESSION['id'];
						$res = $pdo->query($req);
						
						if ($res != FALSE) {
							if($res->rowCount()!=0){
				
				?>
				
				<article class='centre'>
					<h1>Vos Annonces</h1>			
				</article>
				
				<?php 

				if ($res != FALSE) {
					foreach ($res as $row) {
						$date_debut = new DateTime($row['date_debut']);
						$date_fin = new DateTime($row['date_fin']);

						echo "<article class='deal_index_article'>";
							//début contener
							echo "<div class='contener_liste_deal_index'>";

								echo "<div class='price_div_deal_index'>";
									echo "<a target='_blank' href='./bid.php?id=$row[id_objet]' class='voir_le_deal background_color_button_blue'>Voir l'enchère</a>";
								echo "</div>";

								echo "<div class='image_div_deal_index'>";
									echo "<div class='image_contener'>";
										echo "<a target='_blank' href='./bid.php?id=$row[id_objet]'>";
											echo "<img style='margin-top:0px;' width='100' height='100' src='./assets/$row[photo]' rel='Image not found'>";
										echo "</a>";
										echo "<div class='price_div'>";
											echo "<div class='price_border'>";
												echo "<p class='price text_color_red'>$row[prix_actuel]€</p>";
											echo "</div>";
										echo "</div>";
									echo "</div>";
								echo "</div>";

								echo "<div class='content_div_deal_index'>";
									echo "<div class='title text_color_33333'>";
										echo "<a href='./bid.php?id=$row[id_objet]'>$row[nom_objet]</a>";
									echo "</div>";
									echo "<div class='description' style='max-height: 90px; text-align: justify'>";
										echo "<p class='text_color_777777'>";
											echo $row['description'];
										echo "</p>";
									echo "</div>";
									echo "<div class='option'>";
										echo "<p class='text_color_777777'>";
											echo "Posté le ".$date_debut->format("d/m/Y");
										echo "</p>";
									echo "</div>";
								echo "</div>";

							echo "</div>";
							//fin contener

						echo "</article>";

						}
						
					} else {
						echo "fail";
					}		
				
				} } ?>
				
				<?php
				$req = "SELECT * FROM `p1408263`.`projet-objet` WHERE id_acheteur = ".$_SESSION['id'];
				$res = $pdo->query($req);
						
				if ($res != FALSE) {
					if($res->rowCount()!=0){
							
				?>
				
				<article class='centre'>
					<h1>Vos Enchères<br><br></h1><p style="font-size: 12px;">(Ici sont affichées les annonces sur lesquelles vous avez la plus grosse enchère)</p>			
				</article>
				
				<?php
				
					if ($res != FALSE) {
					foreach ($res as $row) {
						$date_debut = new DateTime($row['date_debut']);
						$date_fin = new DateTime($row['date_fin']);

						echo "<article class='deal_index_article'>";
							//début contener
							echo "<div class='contener_liste_deal_index'>";

								echo "<div class='price_div_deal_index'>";
									echo "<a target='_blank' href='./bid.php?id=$row[id_objet]' class='voir_le_deal background_color_button_blue'>Voir l'enchère</a>";
								echo "</div>";

								echo "<div class='image_div_deal_index'>";
									echo "<div class='image_contener'>";
										echo "<a target='_blank' href='./bid.php?id=$row[id_objet]'>";
											echo "<img style='margin-top:0px;' width='100' height='100' src='./assets/$row[photo]' rel='Image not found'>";
										echo "</a>";
										echo "<div class='price_div'>";
											echo "<div class='price_border'>";
												echo "<p class='price text_color_red'>$row[prix_actuel]€</p>";
											echo "</div>";
										echo "</div>";
									echo "</div>";
								echo "</div>";

								echo "<div class='content_div_deal_index'>";
									echo "<div class='title text_color_33333'>";
										echo "<a href='./bid.php?id=$row[id_objet]'>$row[nom_objet]</a>";
									echo "</div>";
									echo "<div class='description' style='max-height: 90px; text-align: justify'>";
										echo "<p class='text_color_777777'>";
											echo $row['description'];
										echo "</p>";
									echo "</div>";
									echo "<div class='option'>";
										echo "<p class='text_color_777777'>";
											echo "Posté le ".$date_debut->format("d/m/Y");
										echo "</p>";
									echo "</div>";
								echo "</div>";

							echo "</div>";
							//fin contener

						echo "</article>";

						}
						
					} else {
						echo "fail";
					}		
				
				}}}
				
				?>
			</section>
		</div>
	</div>


	<?php
		include "./footer.php";
	?>

	</body>
</html>