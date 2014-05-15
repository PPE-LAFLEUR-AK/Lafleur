<?php 
	session_start();
	include 'inc/titre.inc.php';
	include 'param/connexion.php';
?>
	<body>
			<div class="centre">
				<div class="fleur1">
					<img src="img/fleur.jpg"/>
				</div>
				<?php 
					include 'inc/menu.inc.php';
				?>
				<div class="c3">
				<h1 class="titre">Nos produits</h1>
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
						$connexion = new PDO('mysql:host='.$hote.';dbname='.$bdd,$user, $passwd);
						if(isset($_GET['categorieglobale'])){
							$categorie =$_GET['categorieglobale'];

								$reponse = $connexion->query('SELECT * FROM produits, categorie WHERE produits.categorie=categorie.idCategorie AND nomCategorie LIKE "'.$categorie.'%"');
							}
							else if (isset($_GET['categorie'])){
								$categorie=$_GET['categorie'];
								$reponse = $connexion->query('SELECT * FROM produits WHERE categorie='.$categorie.'');
							}
						echo '<table>';
						echo '<tr><th>Photos</th><th>Nom</th><th>Prix</th>';
						if(isset($_SESSION['login']) ){
							if ($_SESSION['statut'] == "A" || $_SESSION['statut'] == "C") {
								echo '<th>Action</th></tr>';
							}
						}
						while ($donnees = $reponse->fetch())
						{
							echo '<tr>';
							echo '<td>'.'<img src="img/'.$donnees['image'].'"/></td>';
							echo '<td>'.$donnees['sous_titre'].'</td>';
							echo '<td>'.$donnees['prix'].' €</td>';
							if ( isset($_SESSION['login']) ) {
								if ($_SESSION['statut'] == "A") {
									echo '<td><a href="modification.php?idModif='.$donnees['produit_id'].'"><img src="img/crayon.jpg" alt="modifier"/></a>';
								}
							}
							if ( isset($_SESSION['login']) ) {
								if ($_SESSION['statut'] == "A") {
									echo '<td><a href="modification.php?idEfface='.$donnees['produit_id'].'"><img src="img/delete.png" alt="effacer"/></a>';
								}
							}
							if ( isset($_SESSION['login']) ) {
								if ($_SESSION['statut'] == "C") {
										echo '<td><a href="commande.php?idProduit='.$donnees['produit_id'].'"><img src="img/panier.jpg" alt="Ajouter au panier"/></a>';
								}
							}
							echo '</tr>';
						}
						$reponse->closeCursor();
						echo '</table>';
					}
					catch (Exception $erreur)
					{
						die('Erreur : '.$erreur->getMessage());
					}
				?>
				<!--<div class="pagination">
					$reponse = $connexion->query('SELECT count(id) as compteur FROM boutiques');
					$count = $reponse->fetch();
					$nbPages = $count["compteur"] / $limit;
					$cpt = 1;
					while ($cpt <= $nbPages){
						echo '<a class="page" href="composition.php?page='.$cpt.'"> Page '.$cpt.' | </a>';
						$cpt++;
					}
				</div>-->
			</div>
			<div class="fleur2">
				<img src="img/fleur.jpg"/>
			</div>
		</div>
	</body>
</html>