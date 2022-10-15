<?php
namespace App\Controller;

use App\Models\Etablissement;
use App\Models\Attribution;

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
        Attribution::modifierAttribChamb(get('idEtab'), get('idGroupe'), get('nbChambres'));

        return $this->redirect('attribution.modify');
    }

}
