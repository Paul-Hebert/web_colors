<?php
	$title = 'Data';

	include('assets/php/header.php');
?>

	<main>
		<form method="post" action="assets/php/utilities/data/">
			<h1>Data</h1>

			<fieldset>
				<label for="DataFormat">Data Format</label>

				<select name="DataFormat">
					<option>CSV</option>
					<option>JSON</option>
					<option>XML</option>
				</select>
			</fieldset>

			<fieldset>
				<label for="ColorFormat">Color Format</label>

				<select name="ColorFormat">
					<option>Hexadecimal</option>
					<option>RGB</option>
					<option>RGBA</option>
					<option>HSL</option>
					<option>HSLA</option>
					<option>Original Colors</option>
				</select>
			</fieldset>

			<fieldset>
				<label for="Delimiter">Delimiter</label>
				<input type="text" class="required" name="Delimiter">
			</fieldset>

			<input type="submit" value="Download Data">
		</form>
	</main>

<?php
	include('assets/php/footer.php');
?>
 