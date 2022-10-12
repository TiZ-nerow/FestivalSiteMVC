<?php
namespace App\Controller;

use App\Model\Etablissement;
use \Core\Session\FlashService;

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

    public function store()
    {
        verifierDonneesEtabC();

        if (get('erreurs')) {
            return $this->create();
        }

        Etablissement::create([
            'id'                     => get('id'),
            'nom'                    => get('nom'),
            'adresseRue'             => get('adresseRue'),
            'codePostal'             => get('codePostal'),
            'ville'                  => get('ville'),
            'tel'                    => get('tel'),
            'adresseElectronique'    => get('adresseElectronique'),
            'type'                   => get('type'),
            'civiliteResponsable'    => get('civiliteResponsable'),
            'nomResponsable'         => get('nomResponsable'),
            'prenomResponsable'      => get('prenomResponsable'),
            'nombreChambresOffertes' => get('nombreChambresOffertes'),
        ]);

        FlashService::set('success', 'La création de l\'établissement a été effectuée');

        return $this->redirect('etablissement');
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
