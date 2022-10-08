<?php
define('ROOT', __DIR__);

require ROOT . '/app/App.php';

App::load();

var_dump(App::getDb()->query('SHOW TABLES'));exit;

// Pour commencer on inclu le fichier contenant nos routes,
// Par la suite nous pourrons intégrer à notre objet App la gestion de celles-ci,
// Via à un nouvel objet Route
require ROOT . '/routes/Route.php';
