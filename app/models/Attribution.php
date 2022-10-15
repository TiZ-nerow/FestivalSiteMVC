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

    public static function modifierAttribChamb($etab_id, $groupe_id, $nbChambres)
    {
        $instance = self::getInstance();

        $lgAttrib = $instance->db->prepare("SELECT COUNT(*) AS nombreAttribGroupe FROM {$instance->table} WHERE idEtab = ? AND idGroupe = ?", [$etab_id, $groupe_id], get_called_class())->first();
        //var_dump($lgAttrib->nombreAttribGroupe);exit;
        if (!$nbChambres)
            return $instance->db->prepare("DELETE FROM {$instance->table} WHERE idEtab = ? AND idGroupe = ?", [$etab_id, $groupe_id]);
        else {
            if ($lgAttrib->nombreAttribGroupe)
                return $instance->db->prepare("UPDATE {$instance->table} SET nombreChambres = ? WHERE idEtab = ? AND idGroupe = ?", [$nbChambres, $etab_id, $groupe_id]);
            else
                return $instance->db->prepare("INSERT INTO {$instance->table} VALUES(?, ?, ?)", [$etab_id, $groupe_id, $nbChambres]);
        }
    }

}
