<?php
	$siteID = $_GET['siteID'];

	$path = 'assets/data/';
	$files = scandir($path);
	$array_length = count($files);
	$files = array_diff($files, array('.', '..'));

	$sites = array_map(function($v){return str_getcsv($v, "|");}, file($path . $files[$array_length-1]));

	$siteName = explode('//', $sites[$siteID][0]);
	$siteName = explode('www.', $siteName[1])[1];

	$title = 'The Colors of ' . $siteName;
	$id = 'home';

	$metaDescription = 'A website providing data on the colors used by popular websites online as well as color pickers, and color theory.';
	$metaImage = 'assets/imgs/ogImage.png';
	$metaImageAlt = 'A visualization of the colors of the web.';
	include('assets/php/header.php');
?>

	<main>
		<section>
			<div class="subsection" id="aggregate">
				<?php
					echo '<h1 id="title">' . $siteName . '</h1>';

					echo '<figure class="large right" style="font-size:0px;">';
						
						for($count = 1; $count < count($sites[$siteID]); $count++){
							echo '<span class="color listing"><span>' . $sites[$siteID][$count] . '</span></span>';
						}

					echo '</figure>';

					echo '<p>This data is current as of ';
					$readableDate = $files[$array_length-1];
					$readableDate = str_replace('.csv', '', $readableDate);
					$readableDate = explode('T', $readableDate);
					$readableDate = strtotime($readableDate[0]);
					$readableDate = date('F jS, Y',$readableDate);

					echo $readableDate;
					echo '.</p>';
				?>
			</div>
		</section>

		<section>
			<div class="subsection">
				<h2>Colors by Hue</h2>

				<p>For the purposes of this chart, transparency was removed from all colors.</p>

				<figure class="large right">
					<?php include('assets/php/charts/hueBarChart.php'); ?>
				</figure>
			</div>
		</section>

		<section>
			<div class="subsection">
				<h2>Colors by Format</h2>

				<p id="colorFormatParagraph">
					Browsers recognize colors in seven different formats; hexadecimal, <abbr>RGB</abbr>, <abbr>RGBA</abbr>, <abbr>HSL</abbr>, <abbr>HSLA</abbr>, and predefined color names. 
				</p>

				<figure class="large right">
					<?php include('assets/php/charts/formatBarChart.php'); ?>
				</figure>
			</div>
		</section>

		<section>
			<div class="subsection">
				<h2>Colors by Hue and Then Saturation</h2>

				<figure>
					<?php include('assets/php/charts/fanChart.php'); ?>
				</figure>	

				<p>In this fan chart, colors are organized around the circle by hue. Their distance from the center is determined by their saturation. All HSL values were rounded to integers.</p>

				<p>If a color was found more than once in the data it has a larger area. A color that was found three times has an area three times larger than a color that was found once. Colors had their hue, saturation and lightness rounded to the nearest integer.</p>
			
				<p>Unfortunately, using this style of chart has one main disadvantage. Some colors become hidden under other colors.</p>
			</div>
		</section>		
	</main>

<?php
	include('assets/php/footer.php');
?>
