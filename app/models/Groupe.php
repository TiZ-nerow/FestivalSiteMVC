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

    public static function obtenirNbrStandAttribues()
    {
        $instance = self::getInstance();

        return $instance->db->prepare("SELECT COUNT(stand) AS nbrStandAttrib FROM {$instance->table} WHERE stand != ?", [0], get_called_class())->first()->nbrStandAttrib;
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

function modifierStand($connexion, $id, $stand)
{
   $stand=str_replace("'","''", $stand);
   $req="update Groupe set stand='$stand' where id='$id'";
   $connexion->query($req);
}*/
