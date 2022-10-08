<?php
   $titre="/detailEtablissement";
   include("_debut.inc.php");
   include("_gestionBase.inc.php"); 
   include("_controlesEtGestionErreurs.inc.php");

   echo "<table width='80%' cellpadding='0' cellspacing='0' align='center'>
   <tr>
   <td align='center'><a href='index.php'>Accueil ></a> <a href='listeEtablissements.php'> listeEtablissements ></a> detailEtablissement</td>
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
   /*if (!selectBase($connexion))
   {
      ajouterErreur("La base de données festival est inexistante ou non accessible");
      afficherErreurs();
      exit();
   }*/

   $id=$_REQUEST['idEtab']; //fait ref à idEtab dans le bouton voir détail dans listeEtablissement

// OBTENIR LE DÉTAIL DE L'ÉTABLISSEMENT SÉLECTIONNÉ

   $req=obtenirDetailEtablissement($connexion, $id);

   foreach ($req as $row) {
      $nom=$row['nom'];
      $adresseRue=$row['adresseRue'];
      $codePostal=$row['codePostal'];
      $ville=$row['ville'];
      $tel=$row['tel'];
      $adresseElectronique=$row['adresseElectronique'];
      $type=$row['type'];
      $civiliteResponsable=$row['civiliteResponsable'];
      $nomResponsable=$row['nomResponsable'];
      $prenomResponsable=$row['prenomResponsable'];
      $nombreChambresOffertes=$row['nombreChambresOffertes'];

   echo "
   <table width='60%' cellspacing='0' cellpadding='0' align='center' 
   class='tabNonQuadrille'>
      
      <tr class='enTeteTabNonQuad'>
         <td colspan='3'>$nom</td>
      </tr>
      <tr class='ligneTabNonQuad'>
         <td  width='20%'> Id: </td>
         <td>$id</td>
      </tr>
      <tr class='ligneTabNonQuad'>
         <td> Adresse: </td>
         <td>$adresseRue</td>
      </tr>
      <tr class='ligneTabNonQuad'>
         <td> Code postal: </td>
         <td>$codePostal</td>
      </tr>
      <tr class='ligneTabNonQuad'>
         <td> Ville: </td>
         <td>$ville</td>
      </tr>
      <tr class='ligneTabNonQuad'>
         <td> Téléphone: </td>
         <td>$tel</td>
      </tr>
      <tr class='ligneTabNonQuad'>
         <td> E-mail: </td>
         <td>$adresseElectronique</td>
      </tr>
      <tr class='ligneTabNonQuad'>
         <td> Type: </td>";
   }
         if ($type==1)
         {
            echo "<td> Etablissement scolaire </td>";
         }
         else
         {
            echo "<td> Autre établissement </td>";
         }
      echo "
      </tr>
      <tr class='ligneTabNonQuad'>
         <td> Responsable: </td>
         <td>$civiliteResponsable&nbsp; $nomResponsable&nbsp; $prenomResponsable
         </td>
      </tr> 
      <tr class='ligneTabNonQuad'>
         <td> Offre: </td>
         <td>$nombreChambresOffertes&nbsp;chambre(s)</td>
      </tr>
   </table>
   <table align='center'>
      <tr>
         <td align='center'><a href='listeEtablissements.php'>Retour</a>
         </td>
      </tr>
   </table>";
?>