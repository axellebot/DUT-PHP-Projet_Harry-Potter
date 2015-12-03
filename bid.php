<?php session_start();

	include_once "./expiring_session.php";

	if (empty($_SESSION['login']) && empty($_SESSION['pwd'])) {
		HEADER("location:./login.php?target=bid");
	}

	if(empty($_GET['id'])){
		HEADER("location:./bidlist.php");
	}

	#acces BD en PDO
	include_once("params.inc.php");
	try {
		// Data Source Name
		$dsn = 'mysql:host=' . $host . '; port=3306; dbname=' . $dbname;
		// instanciation
		$conn = new PDO($dsn, $user, $password);
		// ici on est connecté …
	} catch (PDOException $e) {
		die("Erreur : " . $e->getMessage());
	}
	
	include_once("./params.inc.php");
	
	$link = mysqli_connect($host, $user, $password, $dbname);

	if (!$link) {
		die("Erreur de Connexion(" . mysqli_connect_errno() . ') ' . mysqli_connect_error());
	} else {

		$req = "SELECT `id_vendeur` FROM `projet-objet` WHERE `id_objet` = ".$_GET['id'];
		$result = mysqli_query($link, $req);
		$donnees = mysqli_fetch_row($result);
		
		$id_vnd=$donnees[0];
	
	}

?>

<html>
	<head>

		<?php
			include_once("./head.html");
		?>
		<title>Annonce</title>
		
	</head>
	<body>

	<?php
	$page_actuel = "bid";
	include "./header.php";
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
				<marquee id=error behavior='scroll' bgcolor='red' loop='-1' width='100%' scrollamount='10' style='color:#ffffff;  font-weight: bold; font-size: x-large'></marquee>
				<article>

					<?php


					$sql = "SELECT * FROM `p1408263`.`projet-objet` po INNER JOIN `p1408263`.`projet-personne` pp on po.id_vendeur=pp.id_personne where `id_objet`=$_GET[id];";

					$res = $conn->query($sql)->fetchAll();
					//var_dump($res);
					if ($res != FALSE) {
						//echo"REQUEST SUCCED";
						foreach ($res as $row) {
							$prix_actuel=$row['prix_actuel'];
							$date_debut = new DateTime($row['date_debut']);
							$date_fin = new DateTime($row['date_fin']);
							$remaining = $date_fin->getTimestamp() - time();
							$days_remaining = floor($remaining / 86400);
							$hours_remaining = floor(($remaining % 86400) / 3600);
							$minutes_remaining=floor(($remaining % 3600)/60);
							$secondes_remaining=floor($remaining%60);
							echo "<div id='title_contener'>";
								echo "<div class='right_part_contener'>";
									echo "<div class='padding_part_contener'>";
										if($_SESSION['id']!=$id_vnd){
											echo "<a onclick='overbid()' class='encherir background_color_button_blue'>Enchérir</a>";
										} else {
											echo "<a onclick=\"document.location.href='./delete_bid.php?id=".$_GET['id']."'\" class='encherir background_color_button_red'>Supprimer</a>";
										}
									echo "</div>";
								echo "</div>";
								echo "<div class='center_part_contener'>";
									echo "<div class='padding_part_contener'>";
										echo "<h1 class='text_color_333333'>".$row['nom_objet']."</h1>";
										if($_SESSION['id']!=$id_vnd){
											echo "<p class='dates_deal text_color_b4b4b4'>"."<b>Posté</b> le ".$date_debut->format("d/m/Y")." par </b>".$row['prenom']." ".$row['nom']."</p>";
										} else {
											echo "<p class='dates_deal text_color_b4b4b4'>"."<b>Posté</b> le ".$date_debut->format("d/m/Y")." par </b>vous</p>";
										}
									echo "</div>";
								echo "</div>";

							echo "</div>";
							echo "<div id='description_contener'>";
								echo "<div class='right_part_contener' style='float:left'>";
									echo "<div class='padding_part_contener no_padding_top'>";

										echo "<div class='contener_image_deal'>";
                                            echo "<a href='./assets/$row[photo]'>";
											echo "<img style='margin-top:0px;' width='150' height='150' src='./assets/$row[photo]' rel='".$row['nom_objet']." à ".$row['prix_actuel']."'>";
										    echo "</a>";
										echo "</div>";

										echo "<div class='price_div'>";
											echo "<div class='price_border'>";
												echo "<p class='price text_color_red'>$row[prix_actuel]€</p>";
											echo "</div>";
										echo "</div>";
									echo "</div>";
								echo "</div>";
								echo "<div class='center_part_contener'>";
									echo "<div class='padding_part_contener no_padding_left_right no_padding_top'>";
										echo "<div class='info_sup_div'>";
											echo "<p class='info_sup' style='margin-right:35px;'>";
												echo "<img style='margin-top:1px;' src='./rsc/icon_deal_expiredate.png'>";
												echo "<b>Se termine le : </b>";
												echo $date_fin->format("d/m/Y")." à ".$date_fin->format("H:i:s");
												echo "<br><br>";
												echo "<img style='margin-top:1px;' src='./rsc/icon_deal_expire-countdown.png'>";
												echo "<b>Il reste : </b>";

												if ($days_remaining>=1){

													if($days_remaining==1){
														echo $days_remaining." jour, ";
													}else {
														echo $days_remaining . " jours, ";
													}

													echo $hours_remaining;
													if($hours_remaining>1) {
														echo " heures et ";
													}else{
														echo " heure et ";
													}

													echo $minutes_remaining;
													if($minutes_remaining>1) {
														echo " minutes";
													}else{
														echo " minutes";
													}
												} else {

													if($hours_remaining>1) {
														echo $hours_remaining;
														echo " heures, ";
													}elseif($hours_remaining==1){
														echo $hours_remaining;
														echo " heure, ";
													}

													if($minutes_remaining>1) {
														echo $minutes_remaining;
														echo " minutes et ";
													}elseif($minutes_remaining==1){
														echo " minutes et ";
													}

													if($secondes_remaining>1) {
														echo $secondes_remaining;
														echo " secondes";
													}elseif($secondes_remaining>=0){
														echo $secondes_remaining;
														echo " seconde";
													}
												}



											echo "</p>";
										echo "</div>";
										echo "<div class='description text_color_333333'>";
											echo $row['description'];
										echo "</div>";
									echo "</div>";
								echo "</div>";
							echo "</div>";
							
							if(isset($_GET['fail']) && $_GET['fail']=='yes'){
								echo "Enchère impossible.";
							}
						}
					}

					?>


				</article>
			</section>
		</div>
	</div>

	<script>
	
		
	
		function overbid() {
			<?php
				$i=1;
					
				echo "var prix = prompt('Combien proposez vous ? (en €)','".($prix_actuel+$i)."');";
	
			?>
				//var prix = prompt("Combien proposez vous ?", "");

				//if (prix >0) {
			<?php
				echo "if (prix >$prix_actuel){
					window.location = './treat-overbid.php?id_objet=".$_GET['id']."&id_acheteur=".$_SESSION['id']."&prix='+prix";
			?>
					}else{
						if(prix!=null) {
							<?php
								echo "document.getElementById('error').innerHTML ='Votre enchère doit être supérieur à $prix_actuel €';";
							?>
						}else {
							<?php
								echo "document.getElementById('error').innerHTML ='';";
							?>
						}
					}
		}
		
		
	</script>

	<?php
	
		mysqli_free_result($result);
		mysqli_close($link);
		
		include "./footer.php";
	?>
	</body>
</html>