<?php

// FONCTIONS DE CONNEXION

function connect()
{
   //$hote="localhost";
   $login="root";
   $mdp="";
   //return mysql_connect($hote, $login, $mdp);
   $dsn='mysql:host=localhost;dbname=festival';
   try {
        $dbh= new PDO($dsn, $login, $mdp);
        $dbh->exec("set names utf8"); //commande coder en utf8
        return $dbh;
     } catch (PDOException $e) {
        print"Erreur! :".$e->getMessage()."<br/>";
        die();
     }  
}

//Inutile car la connexion se fait déjà dans la fonction connect()
/*function selectBase($connexion)
{
   $bd="festival";
   $query="SET CHARACTER SET utf8";
   // Modification du jeu de caractères de la connexion
   $res=mysql_query($query, $connexion);
   $ok=mysql_select_db($bd, $connexion);
   return $ok;
}*/

// FONCTIONS DE GESTION DES ÉTABLISSEMENTS

function obtenirReqEtablissements()
{
   $req="select id, nom, nombreChambresOffertes from Etablissement order by id";
   return $req;
}

function obtenirReqEtablissementsOffrantChambres()
{
   $req="select id, nom, nombreChambresOffertes from Etablissement where 
         nombreChambresOffertes!=0 order by id";
   return $req;
}

function obtenirReqEtablissementsAyantChambresAttribuées()
{
   $req="select distinct id, nom, nombreChambresOffertes from Etablissement, 
         Attribution where id = idEtab order by id";
   return $req;
}

function obtenirDetailEtablissement($connexion, $id)
{
   $req="select * from Etablissement where id=:id";
   $rsEtab=$connexion->prepare($req);
   $lgEtab=$rsEtab->execute(['id'=>$id]);
   return $rsEtab->fetchAll();
}

function supprimerEtablissement($connexion, $id)
{
   $Statement =$connexion->prepare("delete from Etablissement where id= :id");
   $Statement->execute(['id'=>$id]);
}
 
function modifierEtablissement($connexion, $id, $nom, $adresseRue, $codePostal, 
                               $ville, $tel, $adresseElectronique, $type, 
                               $civiliteResponsable, $nomResponsable, 
                               $prenomResponsable, $nombreChambresOffertes)
{  
   $nom=str_replace("'", "''", $nom);
   $adresseRue=str_replace("'","''", $adresseRue);
   $ville=str_replace("'","''", $ville);
   $adresseElectronique=str_replace("'","''", $adresseElectronique);
   $nomResponsable=str_replace("'","''", $nomResponsable);
   $prenomResponsable=str_replace("'","''", $prenomResponsable);
  
   $req="update Etablissement set nom='$nom',adresseRue='$adresseRue',
         codePostal='$codePostal',ville='$ville',tel='$tel',
         adresseElectronique='$adresseElectronique',type='$type',
         civiliteResponsable='$civiliteResponsable',nomResponsable=
         '$nomResponsable',prenomResponsable='$prenomResponsable',
         nombreChambresOffertes='$nombreChambresOffertes' where id='$id'";
   
   $connexion->query($req);
}

function creerEtablissement($connexion, $id, $nom, $adresseRue, $codePostal, 
                            $ville, $tel, $adresseElectronique, $type, 
                            $civiliteResponsable, $nomResponsable, 
                            $prenomResponsable, $nombreChambresOffertes)
{ 
   $nom=str_replace("'", "''", $nom);
   $adresseRue=str_replace("'","''", $adresseRue);
   $ville=str_replace("'","''", $ville);
   $adresseElectronique=str_replace("'","''", $adresseElectronique);
   $nomResponsable=str_replace("'","''", $nomResponsable);
   $prenomResponsable=str_replace("'","''", $prenomResponsable);
   
   $req="insert into Etablissement values ('$id', '$nom', '$adresseRue', 
         '$codePostal', '$ville', '$tel', '$adresseElectronique', '$type', 
         '$civiliteResponsable', '$nomResponsable', '$prenomResponsable',
         '$nombreChambresOffertes')";
   
   $connexion->query($req);
}


function estUnIdEtablissement($connexion, $id)
{
   $req="select * from Etablissement where id='$id'";
   $rsEtab=$connexion->query($req);
   return $rsEtab->fetchAll();
}

function estUnNomEtablissement($connexion, $mode, $id, $nom)
{
   $nom=str_replace("'", "''", $nom);
   // S'il s'agit d'une création, on vérifie juste la non existence du nom sinon
   // on vérifie la non existence d'un autre établissement (id!='$id') portant 
   // le même nom
   if ($mode=='C')
   {
      $req="select * from Etablissement where nom='$nom'";
   }
   else
   {
      $req="select * from Etablissement where nom='$nom' and id!='$id'";
   }
   $rsEtab=$connexion->query($req);
   return $rsEtab->fetchAll();
}

function obtenirNbEtab($connexion)
{
   $req="select count(*) as nombreEtab from Etablissement";
   $rsEtab=$connexion->query($req);
   $lgEtab=$rsEtab->fetchAll();
   foreach($lgEtab as $row)
   {
         $nombreEtab = $row['nombreEtab'];
   }
   return $nombreEtab;
}

function obtenirNbEtabOffrantChambres($connexion)
{
   $req="select count(*) as nombreEtabOffrantChambres from Etablissement where 
         nombreChambresOffertes!=0";
   $rsEtabOffrantChambres=$connexion->query($req);
   $lgEtabOffrantChambres=$rsEtabOffrantChambres->fetchAll();
   foreach ($lgEtabOffrantChambres as $row)
   {
      $EtabOffrantChambres = $row['nombreEtabOffrantChambres'];
   }
   return $EtabOffrantChambres;
}

// Retourne false si le nombre de chambres transmis est inférieur au nombre de 
// chambres occupées pour l'établissement transmis 
// Retourne true dans le cas contraire
function estModifOffreCorrecte($connexion, $idEtab, $nombreChambres)
{
   $nbOccup=obtenirNbOccup($connexion, $idEtab);
   return ($nombreChambres>=$nbOccup);
}

function ChambresMax($connexion, $idEtab)
{
   $req = "SELECT nombreChambresOffertes FROM Etablissement WHERE id = '$idEtab'";
   $rsEtab = $connexion->query($req);
   $lgEtab = $rsEtab->fetchAll();
   foreach($lgEtab as $row)
   {
      $nbrMax = $row['nombreChambresOffertes'];
   }
   return $nbrMax;
}

// FONCTIONS RELATIVES AUX GROUPES

function obtenirReqIdNomGroupesAHeberger()
{
   $req="select id, nom, nomPays from Groupe where hebergement='O' order by id";
   return $req;
}

function obtenirNomGroupe($connexion, $id)
{
   $req="select nom from Groupe where id='$id' order by nom";
   $rsGroupe=$connexion->query($req);
   $lgGroupe=$rsGroupe->fetchAll();
   foreach ($lgGroupe as $row)
   {
      $nomGroupe=$row['nom'];
   }
   return $nomGroupe;
}

function obtenirDetailGroupe($connexion, $id)
{
   $req="select * from Groupe where id=:id";
   $rsGroupe=$connexion->prepare($req);
   $lgGroupe=$rsGroupe->execute(['id'=>$id]);
   return $rsGroupe->fetchAll();
}

// FONCTIONS RELATIVES AUX ATTRIBUTIONS

// Teste la présence d'attributions pour l'établissement transmis    
function existeAttributionsEtab($connexion, $id)
{
   $req="select * From Attribution where idEtab='$id'";
   $rsAttrib=$connexion->query($req);
   return $rsAttrib->fetchAll();
}

// Retourne le nombre de chambres occupées pour l'id étab transmis
function obtenirNbOccup($connexion, $idEtab)
{
   $req="select IFNULL(sum(nombreChambres), 0) as totalChambresOccup from
        Attribution where idEtab='$idEtab'";
   $rsOccup=$connexion->query($req);
   $lgOccup=$rsOccup->fetchAll();
   foreach ($lgOccup as $row) 
   {
      $chambre = $row['totalChambresOccup'];
   }
   return $chambre;
}

// Met à jour (suppression, modification ou ajout) l'attribution correspondant à
// l'id étab et à l'id groupe transmis
function modifierAttribChamb($connexion, $idEtab, $idGroupe, $nbChambres)
{
   $req="select count(*) as nombreAttribGroupe from Attribution where idEtab=
        '$idEtab' and idGroupe='$idGroupe'";
   $rsAttrib=$connexion->query($req);
   $lgAttrib=$rsAttrib->fetchAll();
   foreach($lgAttrib as $row)
   {
      $nombreAttribGroupe = $row['nombreAttribGroupe'];
   }
   if ($nbChambres==0)
      $req="delete from Attribution where idEtab='$idEtab' and idGroupe='$idGroupe'";
   else
   {
      if ($nombreAttribGroupe!=0)
         $req="update Attribution set nombreChambres=$nbChambres where idEtab=
              '$idEtab' and idGroupe='$idGroupe'";
      else
         $req="insert into Attribution values('$idEtab','$idGroupe', $nbChambres)";
   }
   $connexion->query($req);
}

// Retourne la requête permettant d'obtenir les id et noms des groupes affectés
// dans l'établissement transmis
function obtenirReqGroupesEtab($id)
{
   $req="select distinct Groupe.id, Groupe.nom, nomPays from Groupe, Attribution where 
        Attribution.idGroupe=Groupe.id and idEtab='$id'";
   return $req;
}
            
// Retourne le nombre de chambres occupées par le groupe transmis pour l'id étab
// et l'id groupe transmis
function obtenirNbOccupGroupe($connexion, $idEtab, $idGroupe)
{
   $req="select nombreChambres From Attribution where idEtab='$idEtab'
        and idGroupe='$idGroupe'";
   $rsAttribGroupe=$connexion->query($req);
   if ($lgAttribGroupe=$rsAttribGroupe->fetchAll()){
      foreach ($lgAttribGroupe as $row) 
      {
         $nombreChambres = $row['nombreChambres'];
      }
      return $nombreChambres;
   }
   else
      return 0;
}

// FONCTIONS RELATIVES AUX STANDS

// Retourne le nom des groupes et s'ils ont un stand ou non
function obtenirStand()
{
   $req="select id, nom, stand from groupe";
   return $req;
}

function obtenirNbrStandAttribues($connexion)
{
   $req="select count(stand) as nbrStandAttrib from Groupe where stand != 0";
   $rsStandAttrib=$connexion->query($req);
   $lgStandAttrib=$rsStandAttrib->fetchAll();
   foreach ($lgStandAttrib as $row)
   {
      $StandAttrib = $row['nbrStandAttrib'];
   }
   return $StandAttrib;
}

function modifierStand($connexion, $id, $stand)
{  
   $stand=str_replace("'","''", $stand);  
   $req="update Groupe set stand='$stand' where id='$id'";   
   $connexion->query($req);
}
?>