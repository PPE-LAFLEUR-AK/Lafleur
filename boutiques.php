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
				<h1 class="titre">Nos magasins</h1>
				<?php 
				/*$limit = 2;
				if( isset($_GET{'page'} ) )
				{
				   $page = $_GET{'page'} - 1;
				   $offset = $limit * $page ;
				}
				else
				{
				   $page = 0;
				   $offset = 0;
				}*/
					try
					{
						$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
						$connexion = new PDO('mysql:host='.$hote.';dbname='.$bdd, $user, $passwd);
						//LIMIT '.$offset.','.$limit)
						$reponse = $connexion->query('SELECT * FROM boutiques');
						echo '<table>';
						echo '<tr><th>Photos</th><th>Nom</th><th>Rue</th><th>Code postal</th><th>Ville</th><th>Action</th></tr>';
						while ($donnees = $reponse->fetch()) {
							echo '<tr>';
							echo '<td><img src="img/'.$donnees['image'].'"/></td>';
							echo '<td>' .$donnees['nom']. '</td>';
							echo '<td>' .$donnees['rue']. '</td>';
							echo '<td>' .$donnees['cp']. '</td>';
							echo '<td>' .$donnees['ville']. '</td>';
						if ( isset($_SESSION['login']) ) {
								if (($_SESSION['statut'] == "A") || ($_SESSION['statut'] == "G")) {
									echo '<td><a href="modification.php?idModifB='.$donnees['id'].'"><img src="img/crayon.jpg" alt="modifier"/></a>';
								}
							}
							if ( isset($_SESSION['login']) ) {
								if ($_SESSION['statut'] == "A") {
									echo '<td><a href="modification.php?idEffaceB='.$donnees['id'].'"><img src="img/delete.png" alt="effacer"/></a>';
								}
							}
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
				<!-- <div class="pagination">
					<?php
					/*$reponse = $connexion->query('SELECT count(id) as compteur FROM boutiques');
					$count = $reponse->fetch();
					$nbPages = $count["compteur"] / $limit;
					$cpt = 1;
					while ($cpt <= $nbPages){
						echo '<a class="page" href="boutiques.php?page='.$cpt.'"> Page '.$cpt.' | </a>';
						$cpt++;
					}*/
					?>
				</div>-->
			</div>
			<div class="fleur2">
				<img src="img/fleur.jpg"/>
			</div>
		</div>
	</body>