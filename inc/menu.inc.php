<div class="c1">
	<img src="img/lafleur.gif">
</div>
<div class="c2">
	<h3 class="h3">Menu :</h3>
	<ul>
		<li>
			<a class="c1" href="index.php"> Accueil </a>
		</li><br/>
		<li class="lien-menu">
			<a class="c1" href="produit.php?categorieglobale=compositions"> Nos compositions </a>
			<ul class="sous-menu">
				<li>
					<a class="c1" href="produit.php?categorie=1"> Les classiques </a>
				</li>
				<li>
					<a class="c1" href="produit.php?categorie=2"> Les prestigieuses </a>
				</li>
			</ul>
		</li><br/>
		<li class="lien-menu">
			<a class="c1 lien-menu" href="produit.php?categorieglobale=fleurs"> Nos fleurs </a>
			<ul class="sous-menu">
				<li>
					<a class="c1" href="produit.php?categorie=3"> Fleurs classiques </a>
				</li>
				<li>
					<a class="c1" href="produit.php?categorie=4"> Fleurs multicolores </a>
				</li>
			</ul>
		</li><br/>
		<li class="lien-menu">
			<a class="c1 lien-menu" href="produit.php?categorieglobale=plantes"> Nos plantes </a>
			<ul class="sous-menu">
				<li>
					<a class="c1" href="produit.php?categorie=6"> Plantes en pot </a>
				</li>
				<li>
					<a class="c1" href="produit.php?categorie=5"> Plantes en coupe </a>
				</li>
			</ul>
		</li><br/>
		<li class="lien-menu">
			<a class="c1 lien-menu" href="boutiques.php"> Nos magasins </a>
		</li><br/>
		<?php 
		if ( isset($_SESSION['login']) ) {
		if ($_SESSION['statut'] == "A") {
		?>
		<li class="lien-menu">
			<a class="c1 lien-menu" href="insertion.php?insert=produit"> Insérer un produit </a>
		</li><br/>
		<li class="lien-menu">
			<a class="c1 lien-menu" href="insertion.php?insert=boutique"> Insérer une boutique </a>
		</li><br/>
		<li class="lien-menu">
			<a class="c1 lien-menu" href="insertion.php?insert=categorie"> Insérer une catégorie </a>
		</li><br/>
		<?php } ?>
		<li class="lien-menu">
			<a class="c1 lien-menu" href="moncompte.php"> Accèder à mon compte </a>
		</li><br/>
		<?php
		}
		if(isset($_SESSION['login'])){
			?>
			<form id="deco" name="deco" method="post" action="index.php">
				<input name="deconnexion" type="submit" value="deconnexion"/>
			</form>
			
			<?php 
		}
		?>
			
	</ul>
</div>
