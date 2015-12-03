<?php session_start();

	//acces BD en PDO
	include_once("./params.inc.php");

	//selection par pages
	if(!isset($_GET['page'])){
		$_page=1;
	}elseif($_GET['page']<1){
		$_page=1;
	}
	else{
		$_page=$_GET["page"];
	}

	$_next_page=$_page+1;
	$_prev_page=$_page-1;

	$_nb_bid_per_page=5;
	$_fist_bid=($_page-1)*$_nb_bid_per_page;

?>

<html>
	<head>
		<?php
			include_once("./head.html");
		?>
		<title>Annonces</title>
	</head>
	<body>

	<?php
	$page_actuel = "bidlist";
	include("./header.php");
	?>

	<div class="structure">
		<div id="body">

			<aside id="right_column">
				<div id="rightbar_content">
					<a href="./newbid.php" class="add_bid_button">
						<div class="background_color_black"></div>
						<p>POSTER UNE ANNONCE</p>
					</a>
				</div>
			</aside>
			
			
			
			<section>
				<article>
				
					<form action='./bidlist.php' method="GET">
					
					<?php if(isset($_GET['search'])){ 
					
							echo "<input type='text' name='search' value='".$_GET['search']."'>";
							
					} else { ?>
					
							<input type="text" name="search">
							
					<?php } ?>

						<button type="submit">Rechercher</button>

					</form>
				
				</article>
			
				<?php

					try {
						//Data Source Name
						$dsn = 'mysql:host=' . $host . '; port=3306; dbname=' . $dbname;
						//instanciation
						$pdo = new PDO($dsn, $user, $password);
						//ici on est connecté …
					} catch (PDOException $e) {
						die("Erreur : " . $e->getMessage());
					}

					/*$req = "SELECT count(*) FROM `p1408263`.`projet-objet` ;";
					$res = $pdo->query($req);
					if ($res != FALSE) {
						$row=$res->fetch();
						$_max_page = $row['count(*)']/$_nb_bid_per_page;
					}*/
					
					if(!isset($_GET["search"]))
						$search = "";
					else
						$search = $_GET["search"];
					
					if (isset($_SESSION['admin']) && $_SESSION['admin'] == 1) {
						$req = "SELECT count(*) FROM `p1408263`.`projet-objet` WHERE `nom_objet` LIKE \"%$search%\";";
						$res = $pdo->query($req);
						if ($res != FALSE) {
							$row=$res->fetch();
							$_max_page = $row['count(*)']/$_nb_bid_per_page;
						}
					} else {
						$req = "SELECT count(*) FROM `p1408263`.`projet-objet` WHERE `nom_objet` LIKE \"%$search%\" AND `date_fin` > CURDATE() LIMIT " . $_fist_bid . ',' . $_nb_bid_per_page . ";";
						$res = $pdo->query($req);
						if ($res != FALSE) {
							$row=$res->fetch();
							$_max_page = $row['count(*)']/$_nb_bid_per_page;
						}
					}				

					if (isset($_SESSION['admin']) && $_SESSION['admin'] == 1) {
						$req = "SELECT * FROM `p1408263`.`projet-objet` WHERE `nom_objet` LIKE \"%$search%\" LIMIT " . $_fist_bid . ',' . $_nb_bid_per_page . ";";
					}else {
						$req = "SELECT * FROM `p1408263`.`projet-objet` WHERE `nom_objet` LIKE \"%$search%\" AND `date_fin` > CURDATE() LIMIT " . $_fist_bid . ',' . $_nb_bid_per_page . ";";
					}
					
					$res = $pdo->query($req);

					if(isset($_GET) && isset($_GET['delete']) && $_GET['delete']=='yes'){
						echo "<div id='delete'>";
							echo "<p class='text_color_777777'>Annonce supprimée avec succès.</p>";
						echo"</div>";
					}
					
					if ($res != FALSE) {
						if($res->rowCount()==0){
							echo "<div id='no_deal'>";
								echo "<p class='text_color_777777'>Désolé, il n'y a aucune enchère à afficher pour le moment.</p>";
							echo"</div>";
						}else{
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
						}
					} else {
						echo "fail";
					}

					//-----------------------------PAGINATION-------------------------------
					echo "<div class='body_pagination'>";
						//page suivante
						echo "<div class='right_part'>";

						if($_page>=$_max_page){
							echo "<a class='suivant opacity_not_clickable' href='javascript:;'>";
							echo "<span>Suivant</span>";
							echo "</a>";
						}

						 else {
							 echo "<a class='suivant' href='?page=$_next_page'>";
							 echo "<span>Suivant</span>";
							 echo "</a>";
						 }
							 echo "</div>";

						//page précédente
						echo "<div class='left_part'>";
						if($_page<=1){
							echo "<a class='precedent opacity_not_clickable' href='javascript:;'>";
							echo "<span>Précédent</span>";
							echo "</a>";
						}else {
							echo "<a class='precedent' href='?page=$_prev_page'>";
							echo "<span>Précédent</span>";
							echo "</a>";
						}
						echo "</div>";

						echo "<div class='center_part'>";
							echo "<a class='active' href='?page=$_page'>$_page</a>";
						echo "</div>";

					echo "</div><br><br><br><br><br><br><br><br><br>";

				?>

			</section>
		</div>
	</div>

	<?php
		include "./footer.php";
	?>

	</body>
</html>