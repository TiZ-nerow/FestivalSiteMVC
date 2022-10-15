<?php
namespace App\Controller;

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
        return $this->render('attribution.modify');
    }

}
