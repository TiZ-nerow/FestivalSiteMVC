<?php
namespace App\Model;

use \Core\Model\Model;

class Attribution extends Model
{

    protected $table = 'attribution';

    public static function existeAttributionsByEtab($etab_id)
    {
        $instance = self::getInstance();

        return $instance->db->prepare("SELECT * FROM {$instance->table} WHERE idEtab = ?", [$etab_id], get_called_class())->get();
    }

    // Retourne le nombre de chambres occupées pour l'id étab transmis
    public static function obtenirNbOccupByEtab($etab_id)
    {
        $instance = self::getInstance();

        return $instance->db->prepare("SELECT IFNULL(sum(nombreChambres), 0) as totalChambresOccup FROM {$instance->table} WHERE idEtab = ?", [$etab_id], get_called_class())->first();
    }

}

// FONCTIONS RELATIVES AUX ATTRIBUTIONS
/*

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
}*/
