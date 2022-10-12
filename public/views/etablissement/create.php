<table width='80%' cellpadding='0' cellspacing='0' align='center'>
    <tr>
        <td align='center'><a href='?p=home'>Accueil</a> > <a href='?p=etablissement'> listeEtablissements</a> > creationEtablissement</td>
    </tr>
</table>

<br>

<form method='POST' action='?p=etablissement.store'>
    <table width='85%' align='center' cellspacing='0' cellpadding='0' class='tabNonQuadrille'>
        <tr class='enTeteTabNonQuad'>
            <td colspan='3'>Nouvel établissement</td>
        </tr>

        <tr class='ligneTabNonQuad'>
            <td> Id*: </td>
            <td><input type='text' value='<?= get('id') ?>' name='id' size ='10' maxlength='8'></td>
        </tr>

        <tr class="ligneTabNonQuad">
            <td> Nom*: </td>
            <td><input type="text" value="<?= get('nom') ?>" name="nom" size="50" maxlength="45"></td>
        </tr>

        <tr class="ligneTabNonQuad">
            <td> Adresse*: </td>
            <td><input type="text" value="<?= get('adresseRue') ?>" name="adresseRue" size="50" maxlength="45"></td>
        </tr>

        <tr class="ligneTabNonQuad">
            <td> Code postal*: </td>
            <td><input type="text" value="<?= get('codePostal') ?>" name="codePostal" size="4" maxlength="5"></td>
        </tr>

        <tr class="ligneTabNonQuad">
            <td> Ville*: </td>
            <td><input type="text" value="<?= get('ville') ?>" name="ville" size="40" maxlength="35"></td>
        </tr>

        <tr class="ligneTabNonQuad">
            <td> Téléphone*: </td>
            <td><input type="text" value="<?= get('tel') ?>" name="tel" size ="20" maxlength="10"></td>
        </tr>

        <tr class="ligneTabNonQuad">
            <td> E-mail: </td>
            <td><input type="text" value="<?= get('adresseElectronique') ?>" name="adresseElectronique" size ="75" maxlength="70"></td>
        </tr>

        <tr class="ligneTabNonQuad">
            <td> Type*: </td>
            <td>
                <input type='radio' name='type' value='1' <?= get('type') ? 'checked' : null ?>> Etablissement Scolaire
                <input type='radio' name='type' value='0' <?= !get('type') ? 'checked' : null ?>> Autre
            </td>
        </tr>

        <tr class='ligneTabNonQuad'>
            <td colspan='2' ><strong>Responsable:</strong></td>
        </tr>

        <tr class='ligneTabNonQuad'>
            <td> Civilité*: </td>
            <td>
                <select name='civiliteResponsable'>
                <?php foreach ($tabCivilite as $civilite) : ?>
                    <option <?= $civilite == get('civiliteResponsable', 'Monsieur') ? 'selected' : null ?>><?= $civilite ?></option>
                <?php endforeach ?>
                </select>
                &nbsp;&nbsp;&nbsp;&nbsp;Nom*:
                <input type="text" value="<?= get('nomResponsable') ?>" name="nomResponsable" size="26" maxlength="25">
                &nbsp;&nbsp;&nbsp;&nbsp;Prénom:
                <input type="text"  value="<?= get('prenomResponsable') ?>" name="prenomResponsable" size="26" maxlength="25">
            </td>
        </tr>

        <tr class="ligneTabNonQuad">
            <td> Nombre chambres offertes*: </td>
            <td><input type="text" value="<?= get('nombreChambresOffertes') ?>" name="nombreChambresOffertes" size ="2" maxlength="3"></td>
        </tr>
    </table>

    <table align='center' cellspacing='15' cellpadding='0'>
        <tr>
            <td align='right'><input type='submit' value='Valider' name='valider'></td>
            <td align='left'><input type='reset' value='Annuler' name='annuler'></td>
        </tr>

        <tr>
            <td colspan='2' align='center'><a href='?p=etablissement'>Retour</a></td>
        </tr>
    </table>
</form>

<?php if (get('erreurs')) : ?>
    <?= afficherErreurs() ?>
<?php endif ?>
