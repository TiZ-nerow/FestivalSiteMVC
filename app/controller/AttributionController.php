<?php
namespace App\Controller;

use App\Models\Etablissement;

class AttributionController extends Controller
{

    public function index()
    {
        //$titre="/consultationAttributions";
        return $this->render('attribution.index');
    }

    public function modify()
    {
        //$titre="/modificationAttributions";
        return $this->render('attribution.modify', [
            'pourcCol' => 50 / Etablissement::obtenirNbEtabOffrantChambres(),
        ]);
    }

    public function store()
    {

        $action=$_REQUEST['action'];

        // Si l'action est validerModifAttrib (cas où l'on vient de la page
        // donnerNbChambres.php) alors on effectue la mise à jour des attributions dans
        // la base
        if ($action=='validerModifAttrib')
        {
           $idEtab=$_REQUEST['idEtab'];
           $idGroupe=$_REQUEST['idGroupe'];
           $nbChambres=$_REQUEST['nbChambres'];
           modifierAttribChamb($connexion, $idEtab, $idGroupe, $nbChambres);
        }
    }

}
