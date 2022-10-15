<?php
namespace App\Models;

use \Core\Model\Model;

class Etablissement extends Model
{

    protected $table = 'etablissement';

    public function existeAttributions()
    {
        return Attribution::existeAttributionsByEtab($this->id);
    }

    public function obtenirNbOccup()
    {
        return Attribution::obtenirNbOccupByEtab($this->id)->totalChambresOccup;
    }

    public function obtenirGroupes()
    {
        return Attribution::obtenirReqGroupesEtab($this->id);
    }

    public static function obtenirNbEtabOffrantChambres()
    {
        $instance = self::getInstance();

        return $instance->db->prepare("SELECT COUNT(*) AS nombreEtabOffrantChambres FROM {$instance->table} WHERE nombreChambresOffertes != ?", [0], get_called_class())->first()->nombreEtabOffrantChambres;
    }

    public static function obtenirReqEtablissementsAyantChambresAttribuees()
    {
        $instance = self::getInstance();

        return $instance->db->query("SELECT DISTINCT id, nom, nombreChambresOffertes FROM {$instance->table}, Attribution WHERE id = idEtab ORDER BY id", get_called_class())->get();
    }

}
/*
function obtenirReqEtablissementsOffrantChambres()
{
   $req="select id, nom, nombreChambresOffertes from Etablissement where
         nombreChambresOffertes!=0 order by id";
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


function estUnIdEtablissement($connexion, $id) dead
{
   $req="select * from Etablissement where id='$id'";
   $rsEtab=$connexion->query($req);
   return $rsEtab->fetchAll();
}

function estUnNomEtablissement($connexion, $mode, $id, $nom) dead
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
*/
