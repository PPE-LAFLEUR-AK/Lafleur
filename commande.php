<?php
session_start();
include "inc/titre.inc.php";
include "param/connexion.php";
include "inc/fonction.php";
$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
$bdd = new PDO('mysql:host='.$hote.';dbname='.$bdd, $user, $passwd);
?>
	<body>
		<div class="centre">
			<div class="fleur1">
				<img src="img/fleur.jpg"/>
			</div>
			<?php 
				include "inc/menu.inc.php";
			?>
			<div class="c3">
				<?php 
				if(isset($_SESSION['login'])){
					if($_SESSION['statut']=='C'){
				?>
					$idProduit = $_GET['idProduit'];
					<form id="insertion" method="post" action="commande.php" enctype="multipart/form-data">
						<input type="hidden" name="id" id="id" value="<?php echo $donnees['produit_id']; ?>">
						Quantité :<input type="text" name="quantite" id="quantite" size="4">
						<input type="hidden" name="prix" id="prix" value="<?php echo $donnees['prix'];?>
					</form>
					
				<?php 		
					}
				}
				else {
					echo '<h1>Vous devez être connecté pour accéder à votre panier.</h1>';
				}
			?>
			</div>
			<div class="fleur2">
				<img src="img/fleur.jpg"/>
			</div>
		</div>
	</body>
</html>