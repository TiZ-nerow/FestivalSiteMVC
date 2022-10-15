<?php
namespace App\Controller;

use App\Models\Etablissement;
use \Core\Session\FlashService;

class EtablissementController extends Controller
{

    public function index()
    {
        //$titre="/listeEtablissement";
        return $this->render('etablissement.index', [
            'etabs' => Etablissement::all(),
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
        return $this->render('etablissement.show', [
            'etab' => Etablissement::find(get('idEtab')),
        ]);
    }

    public function modify()
    {
        //$titre="/modificationEtablissement";
        return $this->render('etablissement.modify', [
            'etab'        => Etablissement::find(get('idEtab')),
            'tabCivilite' => ['M.', 'Mme', 'Melle'],
        ]);
    }

    public function update()
    {
        $etab = Etablissement::find(get('idEtab'));

        verifierDonneesEtabM();

        if (get('erreurs')) {
            return $this->modify();
        }

        $etab->update([
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

        FlashService::set('success', 'La modification de l\'établissement a été effectuée');

        return $this->show();
    }

    public function delete()
    {
        //$titre="/suprressionEtablissement";
        $etab = Etablissement::find(get('idEtab'));

        $etab->delete();

        FlashService::set('success', "L'établissement $etab->nom a été supprimé");

        return $this->redirect('etablissement');
    }

}
