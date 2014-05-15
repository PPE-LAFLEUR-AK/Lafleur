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
				<table>
					<tr><th>Photos</th><th>Prix</th><th>Quantité</th></tr>
					<tr><td> </td><td> </td><td> </td></tr>
				</table>
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
