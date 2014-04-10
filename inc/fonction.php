<?php

function upload($fichier, $ListeextAutorise, $repDestination){
	if ( isset($fichier)){
		if ($fichier['error']==0){
			$typeFichier = $fichier['type'];
			$nomFichier = $fichier['name'];
			$detailFichier = pathinfo($fichier['name']);
			$extFichier = $detailFichier['extension'];
			$extAutorisee = $ListeextAutorise;

			if ( in_array($extFichier, $extAutorisee) == 1 ) {
				$dossierDestination = $repDestination;
				$fichierDepose = move_uploaded_file($fichier['tmp_name'], $dossierDestination.$nomFichier);
				if ( $fichierDepose == 1 ) {
					echo 'Votre image est bien en ligne.';
				}
				else {
					echo '<h4>Erreur</h4>';
				}
			}
			else {
				echo '<h4>Extension non autorisée</h4>';
			}
		}
		else {
			echo '<h4>Erreur d\'envoi</h4>';
		}
	}
	else {
		echo '<h4>Selectionnez une image !</h4>';
	}
}

?>