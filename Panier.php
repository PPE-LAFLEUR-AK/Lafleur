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
				<table>
					<tr><th>Photos</th><th>Prix</th><th>Quantité</th></tr>
					
				</table>
			</div>
		</div>
	</body>
</html>
