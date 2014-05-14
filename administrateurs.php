<?php
	session_start(); 
	include "inc/titre.inc.php";
	include "param/connexion.php";
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
				<h1 class="titre">Les administrateurs de boutiques</h1>
					<?php
					try
						{
							$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
							$connexion = new PDO('mysql:host='.$hote.';dbname='.$bdd, $user, $passwd);
							//LIMIT '.$offset.','.$limit)
							$reponse = $connexion->query('SELECT * FROM user WHERE statutUser="G"');
							echo '<table class="ad">';
							echo '<tr class="ad"><th class="ad">Login</th><th class="ad">Statut</th><th class="ad">Boutique</th>';
							while ($donnees = $reponse->fetch()) {
								echo '<tr class="ad">';
								echo '<td class="ad">'.$donnees['loginUser'].'</td>';
								echo '<td class="ad">' .$donnees['statutUser']. '</td>';
								echo '<td class="ad">' .$donnees['idBoutique']. '</td>';
								echo '</tr>';
							}
							echo '</table>';
							$reponse->closeCursor();
						}
						catch (Exception $erreur)
						{
							die('Erreur : ' . $erreur->getMessage());
						}
					?>
				</div>
			</div>
	</body>
</html>