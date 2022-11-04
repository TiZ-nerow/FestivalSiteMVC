<?php
namespace App\Controller;

use App\Models\Groupe;
use \Core\Session\FlashService;

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
            'groupe' => Groupe::find(get('idGroupe')),
        ]);
    }

    public function update()
    {
        $groupe = Groupe::find(get('idGroupe'));

        if (get('erreurs')) {
            return $this->modify();
        }

        $groupe->update([
            'stand' => get('stand'),
        ]);

        FlashService::set('success', 'Le stand a bien été modifié');

        return $this->modify();
    }

}
