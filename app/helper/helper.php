<?php

// FONCTIONS DE CONTRÔLE DE SAISIE

// Si $codePostal a une longueur de 5 caractères et est de type entier, on
// considère qu'il s'agit d'un code postal
function estUnCp($codePostal)
{
   // Le code postal doit comporter 5 chiffres
   return strlen($codePostal)== 5 && estEntier($codePostal);
}

// Si la valeur transmise ne contient pas d'autres caractères que des chiffres,
// la fonction retourne vrai
function estEntier($valeur)
{
   return !preg_match("[^0-9]", $valeur);
}

// Si la valeur transmise ne contient pas d'autres caractères que des chiffres
// et des lettres non accentuées, la fonction retourne vrai
function estChiffresOuEtLettres($valeur)
{
   return !preg_match("[^a-zA-Z0-9]", $valeur);
}

// Fonction qui vérifie la saisie lors de la modification d'un établissement.
// Pour chaque champ non valide, un message est ajouté à la liste des erreurs
function verifierDonneesEtabM()
{
    $obligatoires = ['nom', 'adresseRue', 'codePostal', 'ville', 'tel', 'nomResponsable', 'nombreChambresOffertes'];
    foreach ($obligatoires as $key) {
        if (is_null(get($key)) || get($key) == '') {
            ajouterErreur("Chaque champ suivi du caractère * est obligatoire");
            break;
        }
    }

    $exist = \App\Model\Etablissement::exist(['nom' => get('nom')]);
    if (get('nom') != '' && $exist && $exist->id != get('idEtab')) {
        ajouterErreur('L\'établissement' . get('nom') . ' existe déjà');
    }

    if (get('codePostal') != '' && !estUnCp(get('codePostal'))) {
        ajouterErreur("Le code postal doit comporter 5 chiffres");
    }

    if (get('nombreChambresOffertes') != '' && (!estEntier(get('nombreChambresOffertes')) || \App\Model\Etablissement::find(get('idEtab'))->obtenirNbOccup() >= get('nombreChambresOffertes'))) {
        ajouterErreur("La valeur de l'offre est non entière ou inférieure aux attributions effectuées");
    }
}

// Fonction qui vérifie la saisie lors de la création d'un établissement.
// Pour chaque champ non valide, un message est ajouté à la liste des erreurs
function verifierDonneesEtabC()
{
    $obligatoires = ['id', 'nom', 'adresseRue', 'codePostal', 'ville', 'tel', 'nomResponsable', 'nombreChambresOffertes'];
    foreach ($obligatoires as $key) {
        if (is_null(get($key)) || get($key) == '') {
            ajouterErreur("Chaque champ suivi du caractère * est obligatoire");
            break;
        }
    }

    // Si l'id est constitué d'autres caractères que de lettres non accentuées
    // et de chiffres, une erreur est générée
    if (get('id') != '' && !estChiffresOuEtLettres(get('id'))) {
        ajouterErreur("L'identifiant doit comporter uniquement des lettres non accentuées et des chiffres");
    } else {
        if (\App\Model\Etablissement::find(get('id'))) {
            ajouterErreur('L\'établissement ' . get('id') . ' existe déjà');
        }
    }

    if (get('nom') != '' && \App\Model\Etablissement::exist(['nom' => get('nom')])) {
        ajouterErreur('L\'établissement' . get('nom') . ' existe déjà');
    }

    if (get('codePostal') != '' && !estUnCp(get('codePostal'))) {
        ajouterErreur("Le code postal doit comporter 5 chiffres");
    }

    if (get('nombreChambresOffertes') != '' && !estEntier(get('nombreChambresOffertes'))) {
        ajouterErreur ("La valeur de l'offre doit être un entier");
    }
}

// FONCTIONS DE GESTION DES ERREURS

function ajouterErreur($msg)
{
   if (! isset($_REQUEST['erreurs']))
      $_REQUEST['erreurs']=array();
   $_REQUEST['erreurs'][]=$msg;
}

function nbErreurs()
{
   if (!isset($_REQUEST['erreurs']))
   {
	   return 0;
	}
	else
	{
	   return count($_REQUEST['erreurs']);
	}
}

function afficherErreurs()
{
   echo '<div class="msgErreur">';
   echo '<ul>';
   foreach($_REQUEST['erreurs'] as $erreur)
	{
      echo "<li>$erreur</li>";
	}
   echo '</ul>';
   echo '</div>';
}
