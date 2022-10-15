<?php
namespace App\Controller;

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
    }

}
