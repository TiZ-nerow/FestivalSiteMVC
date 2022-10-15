<?php
namespace App\Models;

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

    public static function obtenirReqGroupesEtab($etab_id)
    {
        $instance = self::getInstance();

        return $instance->db->prepare("SELECT DISTINCT * FROM {$instance->table}, Groupe WHERE id = idGroupe AND idEtab = ?", [$etab_id], get_called_class())->get();
    }

    public static function obtenirNbOccupGroupe($etab_id, $groupe_id)
    {
        $instance = self::getInstance();

        $lgAttribGroupe = $instance->db->prepare("SELECT nombreChambres FROM {$instance->table} WHERE idEtab = ? AND idGroupe = ?", [$etab_id, $groupe_id], get_called_class())->first();

        return $lgAttribGroupe ? $lgAttribGroupe->nombreChambres : 0;
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
}*/
