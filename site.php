<?php
	$title = 'The Colors of the Web';
	$id = 'home';

	include('assets/php/header.php');
?>

	<main>
		<section>
			<div class="subsection" id="aggregate">
				<?php
					$siteID = $_GET['siteID'];

					$path = 'assets/data/';
					$files = scandir($path);
					$array_length = count($files);
					$files = array_diff($files, array('.', '..'));

					$sites = array_map(function($v){return str_getcsv($v, "|");}, file($path . $files[$array_length-1]));
					echo '<h1 id="title">' . $sites[$siteID][0] . '</h1>';

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
					<div class="shade bar chart">
						<div class="grid"></div>

						<aside class="left"><label>Black</label></aside>
						<div class="barColumn" id="blackColors"></div>

						<aside class="left"><label>White</label></aside>
						<div class="barColumn" id="whiteColors"></div>

						<aside class="left"><label>Grey</label></aside>
						<div class="barColumn" id="greyColors"></div>

						<aside class="left"><label>Red</label></aside>
						<div class="barColumn" id="redColors"></div>

						<aside class="left"><label>Yellow</label></aside>
						<div class="barColumn" id="yellowColors"></div>

						<aside class="left"><label>Green</label></aside>
						<div class="barColumn" id="greenColors"></div>

						<aside class="left"><label>Turquoise</label></aside>
						<div class="barColumn" id="turquoiseColors"></div>

						<aside class="left"><label>Blue</label></aside>
						<div class="barColumn" id="blueColors"></div>

						<aside class="left"><label>Purple</label></aside>
						<div class="barColumn" id="purpleColors"></div>
					</div>
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
					<div class="format bar chart">
						<div class="grid"></div>

						<aside class="left"><label>Hexadecimal</label></aside>
						<div class="barColumn" id="hexadecimalColors"></div>

						<aside class="left"><label>Three Digit Hexadecimal</label></aside>
						<div class="barColumn" id="threeDigitHexadecimalColors"></div>

						<aside class="left"><label><abbr>RGB</abbr></label></aside>
						<div class="barColumn" id="rgbColors"></div>

						<aside class="left"><label><abbr>RGBA</abbr></label></aside>
						<div class="barColumn" id="rgbaColors"></div>

						<aside class="left"><label><abbr>HSL</abbr></label></aside>
						<div class="barColumn" id="hslColors"></div>

						<aside class="left"><label><abbr>HSLA</abbr></label></aside>
						<div class="barColumn" id="hslaColors"></div>

						<aside class="left"><label>Named Colors</label></aside>
						<div class="barColumn" id="namedColors"></div>
					</div>
				</figure>
			</div>
		</section>

		<section>
			<div class="subsection">
				<h2>Colors by Hue and Then Saturation</h2>

				<figure>
					<svg class="hue fan chart"></svg>

					<input type="range" min="0" max="255" value="255" data-target=".hue.fan.chart .background" class="backgroundChanger" autocomplete="off">

					<figcaption>Use this slider to change the background color and expose hidden colors.</figcaption>
				</figure>	

				<p>In this fan chart, colors are organized around the circle by hue. Their distance from the center is determined by their saturation. All HSL values were rounded to integers.</p>

				<p>If a color was found more than once in the data it has a larger area. A color that was found three times has an area three times larger than a color that was found once.</p>
			
				<p>Unfortunately, using this style of chart has one main disadvantage. Some colors become hidden under other colors.</p>
			</div>
		</section>		
	</main>

<?php
	include('assets/php/footer.php');
?>
