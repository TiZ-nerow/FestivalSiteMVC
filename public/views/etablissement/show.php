<table width='80%' cellpadding='0' cellspacing='0' align='center'>
    <tr>
        <td align='center'><a href='?p=home'>Accueil</a> > <a href='?p=etablissement'>listeEtablissements</a> > detailEtablissement</td>
    </tr>
</table>

<br>

<table width='60%' cellspacing='0' cellpadding='0' align='center' class='tabNonQuadrille'>

    <tr class='enTeteTabNonQuad'>
        <td colspan='3'><?= $etab->nom ?></td>
    </tr>

    <tr class='ligneTabNonQuad'>
        <td  width='20%'> Id: </td>
        <td><?= $etab->id ?></td>
    </tr>

    <tr class='ligneTabNonQuad'>
        <td> Adresse: </td>
        <td><?= $etab->adresseRue ?></td>
    </tr>

    <tr class='ligneTabNonQuad'>
        <td> Code postal: </td>
        <td><?= $etab->codePostal ?></td>
    </tr>

    <tr class='ligneTabNonQuad'>
        <td> Ville: </td>
        <td><?= $etab->ville ?></td>
    </tr>

    <tr class='ligneTabNonQuad'>
        <td> Téléphone: </td>
        <td><?= $etab->tel ?></td>
    </tr>

    <tr class='ligneTabNonQuad'>
        <td> E-mail: </td>
        <td><?= $etab->adresseElectronique ?></td>
    </tr>

    <tr class='ligneTabNonQuad'>
        <td> Type: </td>
        <td><?= $etab->type ? 'Etablissement scolaire' : 'Autre établissement' ?></td>
    </tr>

    <tr class='ligneTabNonQuad'>
        <td> Responsable: </td>
        <td><?= $etab->civiliteResponsable ?> <?= $etab->nomResponsable ?> <?= $etab->prenomResponsable ?></td>
    </tr>

    <tr class='ligneTabNonQuad'>
        <td> Offre: </td>
        <td><?= $etab->nombreChambresOffertes ?> chambre(s)</td>
    </tr>

</table>

<table align='center'>
    <tr>
        <td align='center'><a href='?p=etablissement'>Retour</a></td>
    </tr>
</table>
