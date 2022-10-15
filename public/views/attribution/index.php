<table width='80%' cellpadding='0' cellspacing='0' align='center'>
    <tr>
        <td align='center'><a href='?p=home'>Accueil</a> > consultationAttributions</td>
    </tr>
</table>

<br>

<?php if(App\Models\Etablissement::obtenirNbEtabOffrantChambres()) : ?>
<table width='75%' cellspacing='0' cellpadding='0' align='center'>
    <tr>
       <td><a href='?p=attribution.modify'>Effectuer ou modifier les attributions</a></td>
    </tr>
</table>

<br><br>

<?php foreach (App\Models\Etablissement::obtenirReqEtablissementsAyantChambresAttribuees() as $row) : ?>
<table width='75%' cellspacing='0' cellpadding='0' align='center' class='tabQuadrille'>
    <tr class='enTeteTabQuad'>
        <td colspan='3' align='left'><strong><?= $row->nom ?></strong> (Offre : <?= $row->nombreChambresOffertes ?>&nbsp;&nbsp;Disponibilités : <?= $row->nombreChambresOffertes - $row->obtenirNbOccup() ?>)</td>
    </tr>

    <tr class='ligneTabQuad'>
        <td width='40%' align='left'><i><strong>Nom groupe</strong></i></td>
        <td width = '40%' align ='left'><i><strong>Pays groupe</strong></i></td>
        <td width='20%' align='left'><i><strong>Chambres attribuées</strong></i></td>
    </tr>

    <?php foreach ($row->obtenirGroupes() as $groupe) : ?>
    <tr class='ligneTabQuad'>
        <td width='40%' align='left'><?= $groupe->nom ?></td>
        <td width = '20%' align ='left'><?= $groupe->nomPays ?></td>
        <td width='20%' align='left'><?= App\Models\Attribution::obtenirNbOccupGroupe($row->id, $groupe->id) ?></td>
    </tr>
    <?php endforeach ?>
</table>
<?php endforeach ?>
<?php endif ?>
