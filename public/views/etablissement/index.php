<table width='80%' cellpadding='0' cellspacing='0' align='center'>
    <tr>
        <td align='center'><a href='?p=home'>Accueil</a> listeEtablissements</td>
    </tr>
</table>

<br>

<table width='70%' cellspacing='0' cellpadding='0' align='center' class='tabNonQuadrille'>
   <tr class='enTeteTabNonQuad'>
      <td colspan='4'>Etablissements</td>
   </tr>

    <?php foreach ($etablissements as $etab) : ?>
    <tr class='ligneTabNonQuad'>
        <td width='52%'><?= $etab->nom ?></td>

        <td width='16%' align='center'>
            <a href='?p=etablissement.show&idEtab=<?= $etab->id ?>'>Voir détail</a>
        </td>

        <td width='16%' align='center'>
            <a href='?p=etablissement.update&idEtab=<?= $etab->id ?>'>Modifier</a>
        </td>

        <?php if (!$etab->existeAttributions()) : ?>
        <td width='16%' align='center'>
            <a href='?p=etablissement.delete&idEtab=<?= $etab->id ?>'>Supprimer</a>
        </td>
        <?php else : ?>
        <td width='16%'><?= $etab->obtenirNbOccup() == $etab->nombreChambresOffertes ? 'Complet' : $etab->obtenirNbOccup() . ' chambres occupés' ?></td>
        <?php endif ?>
    </tr>
    <?php endforeach ?>

    <tr class='ligneTabNonQuad'>
        <td colspan='4'>
            <a href='?p=etablissement.create'>Création d'un établissement</a>
        </td>
    </tr>
</table>
