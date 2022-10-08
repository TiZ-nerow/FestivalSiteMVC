<?php
namespace App\Controller;

use \Core\Session\FlashService;

class HomeController extends Controller
{
    //$titre="/accueil";

    public function index()
    {
        return $this->render('home');
    }

}
