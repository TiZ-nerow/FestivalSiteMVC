<table width='80%' cellpadding='0' cellspacing='0' align='center'>
	<tr>
		<td align='center'><a href='?p=home'>Accuei</a> > consultationStand</td>
	</tr>
</table>

<br>

<?php if (\App\Models\Groupe::obtenirNbrStandAttribues()) : ?>
<table class='tabQuadrille' width="40%" cellspacing='0' cellpadding='0' align='center'>
	<tr class='enTeteTabQuad'>
		<td align='left' width = 70%><strong>groupe</strong></td>
		<td align='center'><strong>a un stand</Strong></td>
		<td align='center'></td>
	</tr>

	<?php foreach (\App\Models\Groupe::all() as $groupe) : ?>
	<tr class = 'ligneTabNonQuad'>
		<td width='52%'><?= $groupe->nom ?></td>
		<td align = 'center' width = 70% ><?= $groupe->stand ? 'Oui' : 'Non' ?></td>
		<td width='16%' align='center'><a href='?p=stand.modify&idGroupe=<?= $groupe->id ?>'>Modifier</a></td>
	</tr>
	<?php endforeach ?>
</table>
<?php endif ?>
