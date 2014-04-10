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
				<p class="p1"> Bienvenue chez LAFLEUR. <br/> <br/>
				Vous pourrez découvrir nos gammes variées de plantes, de fleurs et de compositions.<br/><br/>
				Retrouvez aussi nos divers magasins implantés dans toute la France dans la rubrique "Nos magasins".<br/><br/>
				Merci de votre visite. </p>
				
				<?php
				if(!isset($_SESSION['login'])){
				?>
				<fieldset>
				<form id="formLogin" name="formLogin" method="post" action="index.php">
					Login <input type="text" id="login" name="login" required="required"/><br/>
					Mot de passe <input type="password" id="password" name="password" required="required"/><br/>
					<input type="reset" id="boutonReset" name="boutonReset" value="Effacer"/>
					<input type="submit" id="boutonSubmit" name="boutonSubmit" value="Se connecter"/><br/>
				</form>
				</fieldset>
				<?php 
				}
				else
				{
					echo 'Vous êtes connecté en tant que '.$_SESSION['login'];
				}
				if (isset($_POST['deconnexion'])){
					session_destroy();
					header('Location: index.php');
				}
				if (isset($_POST['login']) && isset($_POST['password']))
				{
					$login = $_POST['login'];
					$motdepasse = $_POST['password'];
					try
					{
						$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
						$bdd = new PDO('mysql:host='.$hote.';dbname='.$bdd, $user, $passwd);
						$reponse = $bdd->prepare('SELECT * FROM user WHERE loginUser=:login AND mdpUser=MD5(:mdp);');
						$reponse->execute(array(
								'login' => $login,
								'mdp' => $motdepasse
						));
						$nbLignes = $reponse -> rowCount();
						$donnes = $reponse->fetch();
						$statut = $donnes['statutUser'];
						if ($nbLignes >= 1)
						{
							$_SESSION['login'] = $login;
							$_SESSION['statut'] = $statut;
								
							header('Location: index.php');
						}
						else
						{
							echo 'User inconnu';
							header('Location: index.php');
						}
						$reponse->closeCursor();
					}
					catch (Exception $e)
					{
						die('Erreur :'. $e->getMessage());
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
