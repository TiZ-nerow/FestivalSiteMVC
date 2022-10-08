<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Language" content="fr">

    <title><?= config('app.title') ?></title>

    <?= css(['cssGeneral']) ?>
</head>

<body class="basePage">
    <!--  Tableau contenant le titre -->
    <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <td class="titre">
                Festival Sp'Or<br>
                <span id="texteNiveau2" class="texteNiveau2">H&eacute;bergement des Groupes</span>
            </td>
        </tr>
    </table>

    <!--  Tableau contenant les menus -->
    <table width="80%" cellpadding="0" cellspacing="0" class="tabMenu" align="center">
        <tr>
            <td class="menu">
                <a href="/">Accueil</a>
            </td>

            <td class="menu">
                <a href="?p=etablissements.index">Gestion établissements</a>
            </td>

            <td class="menu">
                <a href="consultationAttributions.php">Attributions chambres</a>
            </td>

            <td class="menu">
                <a href="consultationStand.php">Attribution stand</a>
            </td>
        </tr>
    </table>

    <br>

    <?= view('components/message') ?>

    <?= $content ?>
</body>
