<?php
	include('assets/php/functions.php');
	include('assets/php/color_names.php'); 

	$title = "Predefined Color Names";
	$id = "color-names";

	$metaDescription = $title . ' | All 140 valid predefined HTML color names. View them organized by hue, saturation and value.';
	$metaImage = 'assets/imgs/ogImage.png';
	$metaImageAlt = 'A visualization of the colors of the web.';
	include('assets/php/header.php');
?>

	<main>
		<section>
			<div class="subsection" id="aggregate">
				<?php
					echo '<h1 id="title">' . $title . '</h1>';

					echo '<figure class="large right" style="font-size:0px;">';
						
						for($count = 1; $count < count($colorNames); $count++){
							echo '<span class="color listing" style="background:' . $colorNames[$count] . ';"><span>' . $colorNames[$count] . '</span></span>';
						}

					echo '</figure>';
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
				<h2>Colors by Hue and Then Saturation</h2>

				<figure>
					<?php include('assets/php/charts/fanChart.php'); ?>
				</figure>	

				<p>In this fan chart, colors are organized around the circle by hue. Their distance from the center is determined by their saturation.</p>

				<p>If a color was found more than once in the data it has a larger area. A color that was found three times has an area three times larger than a color that was found once. You may notice that there are duplicate named colors to account for alternate spellings. For example, <code class="color-code">SlateGrey</code> and <code class="color-code">SlateGray</code>.
				<p>If a color was found with varying levels of transparency each was included separately. Colors had their hue, saturation and lightness rounded to the nearest integer. Transparency was removed.</p>

				<p>Unfortunately, using this style of chart has one main disadvantage. Some colors become hidden under other colors.</p>
			</div>
		</section>
	</main>

<?php
	include('assets/php/footer.php');
?>
