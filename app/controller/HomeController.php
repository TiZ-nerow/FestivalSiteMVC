<?php
namespace App\Controller;

use \Core\Session\FlashService;

class HomeController extends Controller
{

    public function index()
    {
        return $this->render('home');
    }

    public function test()
    {
        FlashService::set('success', 'Bravo!');
        return $this->redirect('home')/*->with('success', 'bravo !')*/;
    }

}
