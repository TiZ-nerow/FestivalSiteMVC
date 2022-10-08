<?php
namespace App\Controller;

use App\Model\Groupe;

class HomeController extends Controller
{

    public function index()
    {
        $test = Groupe::find('L001');
        var_dump($test->nom);exit;
        return $this->render('home');
    }

}
