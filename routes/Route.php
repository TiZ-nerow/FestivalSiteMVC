<?php

// Pour débuter on passe le nom de la page à afficher en paramètre $_GET dans une variable p

// On vérifie que notre variable p existe
if (isset($_GET['p'])) {

  $page = $_GET['p'];

} else {

  $page = 'home'; // On définit la page à afficher par défaut

}

// On vient scinder notre page pour en récupérer les potentiels parties
$page = explode('.', $page);

// On récupère notre controller correspondant au Nom de la page suivi de Controller
 $controller = '\App\Controller\\' . ucfirst($page[0]) . 'Controller';

// On récupère en second paramètre de notre page l'action à effectuer
$action = $page[1] ?? 'index'; // Par défaut on essaiera d'afficher l'index

// On instancie notre controller
$controller = new $controller();

// Puis on appel la méthode correspondant à l'action
$controller->$action();
