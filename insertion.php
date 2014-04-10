<?php 
	session_start();
	include "inc/titre.inc.php";
	include "param/connexion.php";
	include "inc/fonction.php";
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
				if ($_GET['insert'] == "produit"){
			?>
				<h1 class="titre">Insertion de produit</h1>
				<form id="insertion" method="post" action="insertion.php?insert=produit" enctype="multipart/form-data">
				<fieldset>
					Nom : <input type="text" name="nom" id="nom"><br/>
					Sous-titre : <input type="text" name="sousTitre" id="sousTitre"><br/>
					Prix : <input type="text" name="prix" id="prix"><br/>
					Categorie : <input type="text" list="listeCategorie" name="categorie" id="categorie">
					<datalist id="listeCategorie" name="listeCategorie">
					<?php
					try
					{
						$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
						$connexion = new PDO('mysql:host='.$hote.';dbname='.$bdd,$user, $passwd);
						$reponse = $connexion->query('SELECT idCategorie, nomCategorie FROM categorie;');
						while ($donnees = $reponse->fetch())
						{
							echo '<option value="'.$donnees['idCategorie'].'" label="'.$donnees['nomCategorie'].'">';
						}
						$reponse->closeCursor();
					}
					catch (Exception $e)
					{
						die('Erreur : '. $e->getMessage());
					}	
					?>
					</datalist><br/>
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
					<input type="reset" name="Effacer" id="Effacer" value="Effacer">
					<input type="submit" name="Envoyer" id="Envoyer" value="Envoyer">
					
				</fieldset>
			</form>
			<?php
				if ( isset($_POST['Envoyer']) ) {
					if ( isset($_POST['nom']) && isset($_POST['sousTitre'])  && isset($_POST['prix']) && isset($_FILES['fichier']) && isset($_POST['categorie']) ) {
						$nom = $_POST['nom'];
						$sousTitre = $_POST['sousTitre'];
						$prix = $_POST['prix'];
						$image = $_FILES['fichier']['name'];
						$categorie = $_POST['categorie'];
						try {
							$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
							$bdd = new PDO('mysql:host='.$hote.';dbname='.$bdd, $user, $passwd);
							$ajoutReq = $bdd->prepare('INSERT INTO produits (nom, sous_titre, prix, image, categorie) VALUES (:nom, :sousTitre, :prix, :image, :categorie);');
							$ajoutReq->execute( array(
									'nom' => $nom,
									'sousTitre' => $sousTitre,
									'prix' => $prix,
									'image' => $image,
									'categorie' => $categorie
							));
							$dernierProduit = $bdd->lastInsertId();
							echo '<h4>Votre nouveau produit a bien été enregistré sous le numéro '.$dernierProduit.'</h4>';
						}
						catch (Exception $erreur) {
							die('Il y a une erreur avec la BDD : '.$erreur->getMessage());
						}
					}
				}
			}
			if ($_GET['insert'] == "boutique"){
			?>
			<h1 class="titre">Insertion de boutique</h1>
				<form id="insertion" method="post" action="insertion.php?insert=boutique" enctype="multipart/form-data">
				<fieldset>
					Nom : <input type="text" name="nom" id="nom"><br/>
					Rue : <input type="text" name="rue" id="rue"><br/>
					Code postal : <input type="text" name="cp" id="cp"><br/>
					Ville : <input type="text" list="listeVille" name="ville" id="ville">
					<datalist id="listeVille" name="listeVille">
					<?php
					try
					{
						$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
						$connexion = new PDO('mysql:host='.$hote.';dbname='.$bdd,$user, $passwd);
						$reponse = $connexion->query('SELECT ville FROM boutiques;');
						while ($donnees = $reponse->fetch())
						{
							echo '<option value="'.$donnees['ville'].'">';
						}
						$reponse->closeCursor();
					}
					catch (Exception $e)
					{
						die('Erreur : '. $e->getMessage());
					}	
					?>
					</datalist><br/>
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
					<input type="reset" name="Effacer" id="Effacer" value="Effacer">
					<input type="submit" name="Envoyer" id="Envoyer" value="Envoyer">
				</fieldset>
			</form>
			<?php 
				if ( isset($_POST['Envoyer']) ) {
					if ( isset($_POST['nom']) && isset($_POST['rue'])  && isset($_POST['cp']) && isset($_POST['ville']) && isset($_FILES['fichier'])) {
						$nom = $_POST['nom'];
						$rue = $_POST['rue'];
						$cp = $_POST['cp'];
						$ville = $_POST['ville'];
						$image = $_FILES['fichier']['name'];
						try {
							$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
							$bdd = new PDO('mysql:host='.$hote.';dbname='.$bdd, $user, $passwd);
							$ajoutReq = $bdd->prepare('INSERT INTO boutiques (nom, rue, cp, ville, image) VALUES (:nom, :rue, :cp, :ville, :image);');
							$ajoutReq->execute( array(
									'nom' => $nom,
									'rue' => $rue,
									'cp' => $cp,
									'ville' => $ville,
									'image' => $image
							));
							$derniereBoutique = $bdd->lastInsertId();
							echo '<h4>Votre nouvel boutique a bien été enregistrée sous le numéro '.$derniereBoutique.'</h4>';
						}
						catch (Exception $erreur) {
							die('Il y a une erreur avec la BDD : '.$erreur->getMessage());
						}
					}
				}
			}
			?>