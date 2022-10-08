<?php
	$titre = "/modificationStandAttributions";
	include("_debut.inc.php");
	include("_gestionBase.inc.php"); 
	include("_controlesEtGestionErreurs.inc.php");

	echo "<table width='80%' cellpadding='0' cellspacing='0' align='center'>
   			<tr>
   				<td align='center'><a href='index.php'>Accueil ></a> <a href='consultationStand.php'> consultationStand ></a> modificationStandAttributions</td>
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

// MODIFIER L'ATTRIBUTION D'UN STAND
	$id=$_REQUEST['idGroupe'];
	$action=$_REQUEST['action'];

	if ($action=='demanderModifEtab')
	{
		$req=obtenirDetailGroupe($connexion, $id);
		foreach ($req as $row) {
	      $stand=$row['stand'];
	   	}
	}
	else
	{
	    $stand=$_REQUEST['stand'];

	    if (nbErreurs()==0)
		{
			modifierStand($connexion, $id, $stand);
		}
	}

	echo "
	<form method='POST' action='modificationStandAttributions.php?'>
   <input type='hidden' value='validerModifEtab' name='action'>
   <table width='85%' cellspacing='0' cellpadding='0' align='center' 
   class='tabNonQuadrille'>
   
      <tr class='enTeteTabNonQuad'>
         <td colspan='3'>($id)</td>
      </tr>
      <tr>
         <td><input type='hidden' value='$id' name='idGroupe'></td>
      </tr>";

    echo '
      <tr class="ligneTabNonQuad">
         <td> Stand*: </td>
         <td><input type="text" value="'.$stand.'" name="stand"></td>
      </tr>';

    echo "
   <table align='center' cellspacing='15' cellpadding='0'>
      <tr>
         <td align='right'><input type='submit' value='Valider' name='valider'>
         </td>
         <td align='left'><input type='reset' value='Annuler' name='annuler'>
         </td>
      </tr>
      <tr>
         <td colspan='2' align='center'><a href='consultationStand.php'>Retour</a>
         </td>
      </tr>
   </table>
	</form>";

if ($action=='validerModifEtab')
{
   if (nbErreurs()!=0)
   {
      afficherErreurs();
   }
   else
   {
      echo "
      <h5><center>La modification de l'établissement a été effectuée</center></h5>";
   }
}
?>