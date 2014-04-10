<?php
session_start();
include "inc/titre.inc.php";
include 'param/connexion.php';
include 'inc/fonction.php';
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
				// MODIFICATION DES PRODUITS -----------------------------------------------------------------------------
				if ( isset($_GET['idModif']) ){
						$idModif = $_GET['idModif'];
						try {
							$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
							$bdd = new PDO('mysql:host='.$hote.';dbname='.$bdd, $user, $passwd);
							$reponse = $bdd->prepare('SELECT * FROM produits, categorie WHERE produits.categorie=categorie.idCategorie AND produit_id = :id');
							$reponse->execute( array(
									'id' => $idModif
							));
							$donnees = $reponse->fetch();
				?>				
							<h1 class="h1"> Modification de produit </h1>
							<form action="modification.php" method="post" name="formulaire" id="formulaire" enctype="multipart/form-data">
								<fieldset>
									<img src="img/<?php echo $donnees['image'] ?>"/><br/>
									<input type="hidden" name="id" id="id" value="<?php echo $donnees['produit_id']; ?>">
									Nom : <input type="text" name="nom" id="nom" value="<?php echo $donnees['nom']; ?>"> <br/>
									Sous-titre : <input type="text" name="sous_titre" id="sous_titre" value="<?php echo $donnees['sous_titre']; ?>"/> <br/>
									Prix : <input type="text" name="prix" id="prix" value="<?php echo $donnees['prix']; ?>"/><br/>
									Image : <input type="text" name="image" id="image" value="<?php echo $donnees['image']; ?>"/><br/>
									<?php 
										if(isset($_FILES['fichier'])==0){
									?>
											Choisir une image : <input name="fichier" type="file" id="fichier" ><br/>
									<?php
										}
										else {
											$listeExt = array('jpg','jpeg','png','gif');
											upload($_FILES['fichier'], $listeExt, 'img/');
										} 
									?>
									Catégorie : 
									<select id="categorie" name="categorie">
									<?php
											$reponse2 = $bdd->query('SELECT * FROM categorie');
											while ($donnees2 = $reponse2->fetch())
											{
												echo '<option value="'.$donnees2['idCategorie'].'" > '.$donnees2['nomCategorie'].'</option>';
											}
											$reponse2->closeCursor();
												
									?>
									</select>
									<input type="reset" name="Effacer" value="Effacer"/>
									<input type="submit" name="Modifier" value="Modifier"/>
								</fieldset>	
							</form>
						<?php 
						}
						catch (Exception $erreur) {
							die('Il y a une erreur avec la BDD : '.$erreur->getMessage());
						}	
					}
					if ( isset($_POST['Modifier']) ) {
						if ( isset($_POST['nom']) && isset($_POST['sous_titre'])  && isset($_POST['prix']) && isset($_POST['categorie'])) {
							$idProduit = $_POST['id'];
							$nomProduit = $_POST['nom'];
							$sous_titreProduit = $_POST['sous_titre'];
							$prixProduit = $_POST['prix'];
							if ($_FILES['fichier']['error']==0) {
								$imageProduit = $_FILES['fichier']['name'];
							}
							else {
								if (isset($_POST['image'])) {
									$imageProduit = $_POST['image'];
								}
							}
							$categorieProduit = $_POST['categorie'];
							try {
								$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
								$bdd = new PDO('mysql:host='.$hote.';dbname='.$bdd, $user, $passwd);
								$ajoutReq = $bdd->prepare('UPDATE produits SET nom=:nom, sous_titre=:sous_titre,  prix=:prix, image=:image, categorie=:categorie WHERE produit_id=:id');
								$ajoutReq->execute( array(
										'nom' => $nomProduit,
										'sous_titre' => $sous_titreProduit,
										'prix' => $prixProduit,
										'image' => $imageProduit,
										'categorie' => $categorieProduit,
										'id' => $idProduit
								));
								$dernierProduit = $bdd->lastInsertId();
								echo '<h4>Ce produit a bien été modifié</h4>';
							}
							catch (Exception $erreur) {
								die('Il y a une erreur avec la BDD : '.$erreur->getMessage());
							}
						}
					}
					
					?>
					<?php 
						if ( isset($_GET['idEfface']) ) {
							$idProduit = $_GET['idEfface'];
							try {
								$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
								$bdd = new PDO('mysql:host='.$hote.';dbname='.$bdd, $user, $passwd);
								$ajout = $bdd->prepare('DELETE FROM produits WHERE produit_id=:id');
								$ajout->execute( array(
										'id' => $idProduit
								));
								$dernierProduit = $bdd->lastInsertId();
								echo '<h4>Ce produit a bien été effacé</h4>';
							}
							catch (Exception $erreur) {
								die('Il y a une erreur avec la BDD : '.$erreur->getMessage());
							}
						}
				?>
				<?php
				// MODIFICATION DES MAGASINS -----------------------------------------------------------------------------
				if ( isset($_GET['idModifB']) ){
						$idModif = $_GET['idModifB'];
						try {
							$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
							$bdd = new PDO('mysql:host='.$hote.';dbname='.$bdd, $user, $passwd);
							$reponse = $bdd->prepare('SELECT * FROM boutiques, categorie WHERE id = :id');
							$reponse->execute( array(
									'id' => $idModif
							));
							$donnees = $reponse->fetch();
				?>				
							<h1 class="h1"> Modification des boutiques </h1>
							<form action="modification.php" method="post" name="formulaire" id="formulaire" enctype="multipart/form-data">
								<fieldset>
									<img src="img/<?php echo $donnees['image'] ?>"/><br/>
									<input type="hidden" name="id" id="id" value="<?php echo $donnees['id']; ?>">
									Nom : <input type="text" name="nom" id="nom" value="<?php echo $donnees['nom']; ?>"> <br/>
									Rue : <input type="text" name="rue" id="rue" value="<?php echo $donnees['rue']; ?>"/> <br/>
									Code Postal : <input type="text" name="cp" id="cp" value="<?php echo $donnees['cp']; ?>"/><br/>
									Ville :
									<select id="ville" name="ville">
									<?php
												$reponse2 = $bdd->query('SELECT * FROM boutiques');
												while ($donnees2 = $reponse2->fetch())
												{
													if($donnees2['ville']==$donnees['ville']){
														echo '<option value="'.$donnees2['ville'].'" selected="selected">'.$donnees2['ville'].'</option>';
													}
													else
													{
														echo '<option value="'.$donnees2['ville'].'">'.$donnees2['ville'].'</option>';
													}
												
												}
												$reponse2->closeCursor();
									?>
									</select><br/>
									Image : <input type="text" name="image" id="image" value="<?php echo $donnees['image']; ?>"/><br/>
									<?php 
										if(isset($_FILES['fichier'])== 0){
									?>
											Choisir une image : <input name="fichier" type="file" id="fichier" ><br/>
									<?php
										}
										else{
											$listeExt = array('jpg','jpeg','png','gif');
											upload($_FILES['fichier'], $listeExt, 'img/');
										}
									?>
									<input type="reset" name="Effacer" value="Effacer"/>
									<input type="submit" name="Modifier" value="Modifier"/>
								</fieldset>	
							</form>
						<?php 
						}
						catch (Exception $erreur) {
							die('Il y a une erreur avec la BDD : '.$erreur->getMessage());
						}	
					}
					if ( isset($_POST['Modifier']) ) {
						if ( isset($_POST['nom']) && isset($_POST['rue'])  && isset($_POST['cp']) && isset($_POST['ville'])) {
							$idBoutique = $_POST['id'];
							$nomBoutique = $_POST['nom'];
							$rueBoutique = $_POST['rue'];
							$cpBoutique = $_POST['cp'];
							$villeBoutique = $_POST['ville'];
							if ($_FILES['fichier']['error']==0) {
								$imageBoutique = $_FILES['fichier']['name'];
							}
							else {
								if (isset($_POST['image'])) {
									$imageBoutique = $_POST['image'];
								}
							}
							try {
								$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
								$bdd = new PDO('mysql:host='.$hote.';dbname='.$bdd, $user, $passwd);
								$ajoutReq = $bdd->prepare('UPDATE boutiques SET nom=:nom, rue=:rue, cp=:cp, ville=:ville, image=:image WHERE id=:id');
								$ajoutReq->execute( array(
										'nom' => $nomBoutique,
										'rue' => $rueBoutique,
										'cp' => $cpBoutique,
										'ville' => $villeBoutique,
										'image' => $imageBoutique,
										'id' => $idBoutique
								));
								$dernierProduit = $bdd->lastInsertId();
								echo '<h4>Cette boutique a bien été modifié</h4>';
							}
							catch (Exception $erreur) {
								die('Il y a une erreur avec la BDD : '.$erreur->getMessage());
							}
						}
					}
					
					?>
					<?php 
						if ( isset($_GET['idEfface']) ) {
							$idBoutique = $_GET['idEfface'];
							try {
								$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
								$bdd = new PDO('mysql:host='.$hote.';dbname='.$bdd, $user, $passwd);
								$ajout = $bdd->prepare('DELETE FROM boutiques WHERE id=:id');
								$ajout->execute( array(
										'id' => $idBoutique
								));
								$dernierProduit = $bdd->lastInsertId();
								echo '<h4>Ce produit a bien été effacé</h4>';
							}
							catch (Exception $erreur) {
								die('Il y a une erreur avec la BDD : '.$erreur->getMessage());
							}
						}
				?>
			</div>
			<div class="fleur2">
				<img src="img/fleur.jpg"/>
			</div>
		</div>
	</body>
</html>