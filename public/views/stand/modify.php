<table width='80%' cellpadding='0' cellspacing='0' align='center'>
	<tr>
		<td align='center'><a href='?p=home'>Accueil</a> > <a href='?p=stand'>consultationStand</a> > modificationStandAttributions</td>
	</tr>
</table>

<br>

<form method='POST' action='?p=stand.update'>
	<table width='85%' cellspacing='0' cellpadding='0' align='center' class='tabNonQuadrille'>
		<tr class='enTeteTabNonQuad'>
			<td colspan='3'>(<?= $groupe->id ?>)</td>
		</tr>

		<tr>
			<td><input type='hidden' value='<?= $groupe->id ?>' name='idGroupe'></td>
		</tr>

		<tr class="ligneTabNonQuad">
			<td> Stand*: </td>
			<td><input type="text" value="<?= get('stand', $stand) ?>" name="stand"></td>
		</tr>

		<tr>
			<td align='right'><input type='submit' value='Valider' name='valider'></td>
			<td align='left'><input type='reset' value='Annuler' name='annuler'></td>
		</tr>

		<tr>
			<td colspan='2' align='center'><a href='?p=stand'>Retour</a></td>
		</tr>
	</table>
</form>

<?php if (get('erreurs')) : ?>
    <?= afficherErreurs() ?>
<?php endif ?>
