<?php
namespace App\Controller;

use App\Model\Etablissement;

class EtablissementController extends Controller
{

    public function index()
    {
        //$titre="/listeEtablissement";
        return $this->render('etablissement.index', [
            'etablissements' => Etablissement::all(),
        ]);
    }

    public function create()
    {
        //$titre="/creationEtablissement";
        return $this->render('etablissement.create', [
            'tabCivilite' => ['M.', 'Mme', 'Melle'],
        ]);
    }

    public function show()
    {
        //$titre="/detailEtablissement";
    }

    public function update()
    {
        //$titre="/modificationEtablissement";
    }

    public function delete()
    {
        //$titre="/suprressionEtablissement";
    }

}
