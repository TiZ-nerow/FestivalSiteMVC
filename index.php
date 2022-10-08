<?php
define('ROOT', __DIR__);

require ROOT . '/app/App.php';

App::load();

// Pour commencer on inclu le fichier contenant nos routes,
// Par la suite nous pourrons intégrer à notre objet App la gestion de celles-ci,
// Via à un nouvel objet Route
require ROOT . '/routes/Route.php';
