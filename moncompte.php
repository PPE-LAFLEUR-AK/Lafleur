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
					if(isset($_GET['modif'])){ 
					$idModif = $_SESSION['login'];
					try {
						$reponse = $bdd->prepare('SELECT * FROM user WHERE 	loginUser=:id');
						$reponse->execute( array(
								'id' => $idModif
						));
						$donnees = $reponse->fetch();
					?>
						<h1 class="titre">Modification de mot de passe: </h1>
						<form id="modifmdp" method="post" action="moncompte.php?modif=mdp">
						<fieldset>
						<input type="hidden" name="id" id="id" value="<?php echo $donnees['idUser']; ?>">
						Votre ancien mot de passe : <input type="password" name="ancienMdp" id="ancienMdp"><br/>
						Taper votre nouveau mot de passe : <input type="password" name="newMdp" id="newMdp"><br/>
						Veuillez retapez votre nouveau mot de passe : <input type="password" name="newMdp2" id="newMdp2"><br/>
						<input type="reset" name="Effacer" id="Effacer" value="Effacer">
						<input type="submit" name="Modifier" id="Modifier" value="Modifier">
						</fieldset>
						</form>
					<?php
					}
					catch (Exception $erreur) {
						die('Il y a une erreur avec la BDD : '.$erreur->getMessage());
					}
					if ( isset($_POST['Modifier']) ) {
						if ( isset($_POST['ancienMdp']) && isset($_POST['newMdp'])  && isset($_POST['newMdp2']) && $_POST['newMdp']==$_POST['newMdp2']) {
							$id = $_POST['id'];
							$ancienMdp = $_POST['ancienMdp'];
							$newMdp = $_POST['newMdp'];
							$newMdp2 = $_POST['newMdp2'];
							try {
								//$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
								//$bdd = new PDO('mysql:host='.$hote.';dbname='.$bdd, $user, $passwd);
								$ajoutReq = $bdd->prepare('UPDATE user SET mdpUser=MD5(:mdp) WHERE idUser=:id');
								$ajoutReq->execute( array(
										'id' => $id,
										'mdp' => $newMdp
								));
								$dernierProduit = $bdd->lastInsertId();
								echo '<h4>Le mot de passe a bien été modifié</h4>';
							}
							catch (Exception $erreur) {
								die('Il y a une erreur avec la BDD : '.$erreur->getMessage());
							}
						}
					}
					}
					else {
					?>
					<p class="p1"> Voici les informations de votre compte : <br/><br/><br/>
					Vous possedez un compte : <?php echo $_SESSION['login']; ?> <br/><br/><br/>
					Votre login est: <?php echo $_SESSION['login']; ?> <br/><br/><br/>
					Je veux changer mon <a href="moncompte.php?modif=mdp">mot de passe </a> !
					</p>
					<?php }?>
				</div>
				<div class="fleur2">
					<img src="img/fleur.jpg"/>
				</div>
			</div>
	</body>
</html>