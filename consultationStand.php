<?php
	$titre = "/consultationStand";
	include("_debut.inc.php");
	include("_gestionBase.inc.php"); 
	include("_controlesEtGestionErreurs.inc.php");

	echo "<table width='80%' cellpadding='0' cellspacing='0' align='center'>
   <tr>
   <td align='center'><a href='index.php'>Accueil ></a> consultationStand</td>
   </tr>
</table>
<br>";

// CONNEXION AU SERVEUR MYSQL PUIS SÉLECTION DE LA BASE DE DONNÉES festival

	$connexion=connect();
	if (!$connexion)
	{
   		ajouterErreur("Echec de la connexion au serveur MySql");
   		afficherErreurs();
   		exit();
	}

	$nbStand=obtenirNbrStandAttribues($connexion);
	if ($nbStand!=0)
	{
		$req=obtenirStand();
		$rsStand=$connexion->query($req);
		$lgStand=$rsStand->fetchAll();

		echo"<table class = 'tabQuadrille' width = 40% cellspacing='0' cellpadding='0' align = 'center'> 
			<tr class = 'enTeteTabQuad'> 
			<td align = 'left' width = 70%> <strong>groupe</strong></td>
			<td align = 'center'> <strong>a un stand</Strong></td>
			<td align = 'center'> <strong></Strong></td></tr>";

		foreach ($lgStand as $row) {
			$id = $row['id'];
			$nomGroupe=$row['nom'];
			$stand=$row['stand'];

			echo "<tr class = 'ligneTabNonQuad'>
				<td width='52%' > $nomGroupe 
				</td>";

			// Si le groupe a un stand associé, affiche oui sinon non
			if($stand) {	
				echo "<td align = 'center' width = 70% > Oui </td>";
			}
			else {
				echo "<td align = 'center' width = 70% > Non </td>";
			}

			echo "<td width='16%' align='center'>
					<a href='modificationStandAttributions.php?action=demanderModifEtab&amp;idGroupe=$id'> Modifier</a>
				</td>";
		}
	}
?>