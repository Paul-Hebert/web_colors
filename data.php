<?php
	$title = 'Data';
	$id = 'data';

	include('assets/php/header.php');
?>

	<main>
		<form id="downloads">
			<h1>Data</h1>

			<fieldset>
				<label for="Date">Date</label>

				<?php
					$path = 'assets/data/';
					$files = scandir($path, 1);
					$array_length = count($files);
					$files = array_diff($files, array('.', '..'));

					echo '<select name="Date" id="date">';
						foreach($files as $fileName){
							$date = date('F j, Y h:i:s A', strtotime($fileName));

							echo '<option value="' . $fileName . '">' . $date . '</option>';
						}
						echo '<option value="All">All</option>';
					echo '</select>';
				?>
			</fieldset>

			<!--<fieldset>
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
			</fieldset> -->

			<input type="submit" value="Download Data">
		</form>
	</main>

<?php
	include('assets/php/footer.php');
?>
 