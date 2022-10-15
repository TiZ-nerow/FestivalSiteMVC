<?php
namespace App\Controller;

use App\Models\Groupe;

class StandController extends Controller
{

    public function index()
    {
        //$titre = "/consultationStand";
        return $this->render('stand.index');
    }

    public function modify()
    {
        //$titre = "/modificationStandAttributions";
        return $this->render('stand.modify', [
            //'groupe' => Groupe::find(get('idGroupe')),
        ]);
    }

    public function update()
    {
        /*if (nbErreurs()==0)
		{
			$stand = modifierStand($connexion, get('idGroupe'), $stand);
		}*/
        FlashService::set('success', 'La modification de l\'établissement a été effectuée');

        return $this->show();
    }

}
