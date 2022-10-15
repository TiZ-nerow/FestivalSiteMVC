<table width='80%' cellpadding='0' cellspacing='0' align='center'>
    <tr>
        <td align='center'><a href='?p=home'>Accueil</a> > <a href='?p=attribution'>consultationAttributions</a> > modificationAttributions</td>
    </tr>
</table>

<br>

<table width='80%' cellspacing='0' cellpadding='0' align='center' class='tabQuadrille'>
    <tr class='enTeteTabQuad'>
        <td colspan=80%><strong>Attributions</strong></td>
    </tr>

    <tr class='ligneTabQuad'>
        <td>nom équipe</td>
        <td>pays d'origine</td>
        <?php foreach(\App\Models\Etablissement::obtenirReqEtablissementsOffrantChambres() as $etab) : ?>
        <td valign='top' width='<?= $pourcCol ?>%'><i>Disponibilités : <?= $etab->nbLibre() ? $etab->nbLibre() : '<strong>complet</strong>' ?></i><br><?= $etab->nom ?></td>
        <?php endforeach ?>
    </tr>

    <?php foreach(\App\Models\Groupe::obtenirReqIdNomGroupesAHeberger() as $groupe) : ?>
    <tr class='ligneTabQuad'>
        <td width='25%'><?= $groupe->nom ?></td>
        <td width='10%'><?= $groupe->nomPays ?></td>
        <?php foreach(\App\Models\Etablissement::obtenirReqEtablissementsOffrantChambres() as $etab) : ?>
        <td class='<?= \App\Models\Attribution::obtenirNbOccupGroupe($etab->id, $groupe->id) ? 'reserve' : 'reserveSiLien' ?>'>
            <form method='POST' action='?p=attribution.store' onchange="this.submit()">
                <input type='hidden' value='<?= $etab->id ?>' name='idEtab'>
                <input type='hidden' value='<?= $groupe->id ?>' name='idGroupe'>
                <center>
                        <select name='nbChambres'>
                            <?php for ($i = 0; $i <= ($etab->nbLibre() + \App\Models\Attribution::obtenirNbOccupGroupe($etab->id, $groupe->id)); $i++) : ?>
                            <option value="<?= $i ?>" <?= \App\Models\Attribution::obtenirNbOccupGroupe($etab->id, $groupe->id) == $i ? 'selected' : null ?>><?= $i ?></option>
                            <?php endfor ?>
                        </select>
                    </h5>
                </center>
            </form>
        </td>
        <?php endforeach ?>
    </tr>
    <?php endforeach ?>
</table>

<table align='center' width='80%'>
    <tr>
        <td width='34%' align='left'><a href='?p=attribution'>Retour</a></td>
        <td class='reserveSiLien'></td>
        <td width='30%' align='left'>Réservation possible si lien</td>
        <td class='reserve'></td>
        <td width='30%' align='left'>Chambres réservées</td>
    </tr>
</table>
