<?php
namespace App\Models;

use \Core\Model\Model;

class Groupe extends Model
{

    protected $table = 'groupe';

    public static function obtenirReqIdNomGroupesAHeberger()
    {
        $instance = self::getInstance();

        return $instance->db->prepare("SELECT id, nom, nomPays FROM {$instance->table} WHERE hebergement = ? ORDER BY id", ['O'], get_called_class())->get();
    }

}

// FONCTIONS RELATIVES AUX GROUPES
/*
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
}*/
