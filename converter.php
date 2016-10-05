<?php
	$title = 'Converter';
	$id = 'converter';

	$metaDescription = 'A website providing data on the colors used by popular websites online as well as color pickers, and color theory.';
	$metaImage = 'assets/imgs/ogImage.png';
	$metaImageAlt = 'A visualization of the colors of the web.';
	include('assets/php/header.php');
?>

	<main>
		<section>
			<h1>Converter</h1>

			<figure class="colorPicker" data-format='rgba(,)' data-delimiter=",">
				<code class="colorBlock"></code>

				<form autocomplete="off">
					<label for="red">Red:</label>
					<input type="range" min="0" max="255" data-scale="" data-unit="" name="red" value="186">

					<label for="green">Green:</label>
					<input type="range" min="0" max="255" data-scale="" data-unit="" name="green" value="218">

					<label for="blue">Blue:</label>
					<input type="range" min="0" max="255" data-scale="" data-unit="" name="blue" value="85">

					<label for="alpha">Alpha:</label>
					<input type="range" min="0" max="100" data-scale="100" data-unit="" name="alpha" value="100">
				</form>
			</figure>

			<figure class="colorPicker" data-format='#,' data-delimiter="">
				<code class="colorBlock"></code>

				<form autocomplete="off">
					#
					<?php
						$color = str_split('BADA55',2);

						foreach($color as $character){
							include('assets/php/hex-select.php');
						}
					?>
				</form>
			</figure>

			<figure class="colorPicker" data-format='hsla(,)' data-delimiter=",">
				<code class="colorBlock"></code>

				<form autocomplete="off">
					<label for="hue">Hue:</label>
					<input type="range" min="0" max="360" data-scale="" data-unit="" name="hue" value="186">

					<label for="saturation">Saturation:</label>
					<input type="range" min="0" max="100" data-scale="" data-unit="%" name="saturation" value="218">

					<label for="lightness">Lightness:</label>
					<input type="range" min="0" max="100" data-scale="" data-unit="%" name="lightness" value="85">

					<label for="alpha">Alpha:</label>
					<input type="range" min="0" max="100" data-scale="100" data-unit="" name="alpha" value="100">
				</form>
			</figure>
			
			<figure class="colorPicker" data-format=',' data-delimiter="">
				<code class="colorBlock"></code>

				<form autocomplete="off">
					<select name='color' data-scale="" data-unit="" class="colorNames">
						<?php include('assets/php/color_names.php'); ?>
					</select>
				</form>
			</figure>
		</section>
	</main>

<?php
	include('assets/php/footer.php');
?>
 