<?php
	$title = 'The Colors of the Web';

	include('assets/php/header.php');
?>

	<main>
		<section>
			<div class="subsection">
				<h1>
					The Colors Used by the Ten Most Popular Sites
				</h1>

				<figure>
					<div class="hue rectangle chart"></div>
				</figure>

				<p>As a graphic designer, I often struggle when choosing a color scheme for a new project. I was curious what colors were being used by large, popular sites, so I decided to find out.</p>
			
				<p><a href="http://www.alexa.com" target="_BLANK">Alexa.com</a> maintains a list of the most visited sites on the internet. I wrote a <abbr>PHP</abbr> script to scrape the ten most popular sites and record all the colors used in the sites' home pages and style sheets.</p>
			</div>
		</section>

		<section>
			<div class="subsection">
				<h2>The Sites</h2>

				<p>Here are the ten most popular sites, and the colors that they use:</p>

				<figure class="large right" style="font-size:0px;">
					<?php
						$path = 'assets/data/';
						$files = scandir($path);
						$array_length = count($files);
						$files = array_diff($files, array('.', '..'));

						$sites = array_map(function($v){return str_getcsv($v, "|");}, file($path . $files[$array_length-1]));

						echo '<ol>';
							foreach($sites as $site){
								echo '<li>';
									echo '<h3>' . $site[0] . '</h3>';

									for($count = 1; $count < count($site); $count++){
										echo '<span class="colorListing"><span>' . $site[$count] . '</span></span>';
									}
								echo '</li>';
							}
						echo '</ol>';
					?>
				</figure>
			</div>
		</section>
		
		<section>
			<div class="subsection">
				<h2>The Colors</h2>

				<p>Here are all of the sites' colors put together:</p>

				<figure class="large right" style="font-size:0px;">
					<?php
						foreach($sites as $site){
							for($count = 1; $count < count($site); $count++){
								echo '<span class="colorListing"><span>' . $site[$count] . '</span></span>';
							}
						}
					?>
				</figure>
			</div>
		</section>

		<section>
			<div class="subsection">
				<h2>Converting Between Color Formats</h2>

				<p>While this data may look like pretty pixel art, it's not very informative without being organized.The colors used by these sites are all written in one of 6 different formats; hexadecimal, <abbr>RGB</abbr>, <abbr>RBGA</abbr>, <abbr>HSL</abbr>, <abbr>HSLA</abbr>, and predefined color names.</p>

				<p>ADD BAR CHART FOR COLOR FORMATS</p>

				<p>
					In order to better organize this data, we'll first have to convert all the colors used into a single format.
				</p>
			</div>

			<div class="subsection">
				<h3>Hexadecimal</h3>

				<aside class="left">
					<figure>
						<table id="conversionTable">
							<tr>
								<td>0</td><td>0</td>
							</tr>
							<tr>
								<td>1</td><td>1</td>
							</tr>
							<tr>
								<td>2</td><td>2</td>
							</tr>
							<tr>
								<td>3</td><td>3</td>
							</tr>
							<tr>
								<td>4</td><td>4</td>
							</tr>
							<tr>
								<td>5</td><td>5</td>
							</tr>
							<tr>
								<td>6</td><td>6</td>
							</tr>
							<tr>
								<td>7</td><td>7</td>
							</tr>
							<tr>
								<td>8</td><td>8</td>
							</tr>
							<tr>
								<td>9</td><td>9</td>
							</tr>
							<tr>
								<td>a</td><td>10</td>
							</tr>
							<tr>
								<td>b</td><td>11</td>
							</tr>
							<tr>
								<td>c</td><td>12</td>
							</tr>
							<tr>
								<td>d</td><td>13</td>
							</tr>
							<tr>
								<td>e</td><td>14</td>
							</tr>
							<tr>
								<td>f</td><td>15</td>
							</tr>
							<tr>
								<td>10</td><td>16</td>
							</tr>
							<tr>
								<td>11</td><td>17</td>
							</tr>
							<tr>
								<td>12</td><td>18</td>
							</tr>
							<tr>
								<td>13</td><td>19</td>
							</tr>
							<tr>
								<td colspan="3" class="ellipsis">&#8230;</td>
							</tr>
							<tr>
								<td>fd</td><td>253</td>
							</tr>
							<tr>
								<td>fe</td><td>254</td>
							</tr>
							<tr>
								<td>ff</td><td>255</td>
							</tr>
						</table>
					</figure>
				</aside>

				<p>
					The most common color format on the web is hexadecimal. A hexidecimal color is six characters long and preceded by a number sign: <code>#BADA55</code>
				</p>

				<p>
					Hexadecimal numbers are base-16 instead of base-10, so each character represents a number between 0 and 15 instead of 0 and 9.
				</p>
				<p>
					Hexidecimal colors can be split into 4 sections: <code>#</code> + <code>BA</code> + <code>DA</code> + <code>55</code>. We can ignore the first section: <code>#</code>. This section just tells the program that a hexidecimal color is coming.
				</p>
			
				<aside class="right">
					<figure class="colorPicker" data-format='#,' data-delimiter="">
						<code class="colorBlock"></code>

						<form autocomplete="off">
							#
							<?php
								$color = str_split('BADA55');

								foreach($color as $character){
									include('assets/php/hex-select.php');
								}
							?>
						</form>
					</figure>
				</aside>

				<p>
					The remaining 3 sections contain important information about the color. Hexidecimal colors are based off of the <abbr>RGB</abbr> (Red, Green, Blue) color model and each section defines how much of one of those colors is present in the final color.
				</p>

				<figure>
					Red: <code>BA</code> Green: <code>DA</code> Blue: <code>55</code>
				</figure>

				<p>
					Two base-10 digits have 100 possible combinations. (10 * 10) Two base-16 digits have 256 possible combinations (16 * 16), so each hue (Red, Green, Blue) has a possible value between 0 and 255. Here are the color values for <code>#BADA55</code>, converted into base-10.
				</p>

				<figure>
					Red: <code>186</code> Green: <code>218</code> Blue: <code>85</code>
				</figure>

				<figure>
					<figcaption>
						Here's how to convert base-16 to base-10 in javascript.
					</figcaption>

<?php
$source = "base16ToBase10('BA');

function base16ToBase10(base16){
    return parseInt(base16,16);
}";

$geshi = new GeSHi($source, 'javascript');

$geshi->enable_line_numbers(GESHI_NORMAL_LINE_NUMBERS);

$geshi->enable_classes();

echo $geshi->parse_code();
?>
				</figure>

				<figure>
					<figcaption>
						Here's how to do the inverse: convert base-10 to base-16.
					</figcaption>

<?php
$source = "base10ToBase16(186);

function base10ToBase16(base10){
    return base10.toString(16);
}";

$geshi = new GeSHi($source, 'javascript');

$geshi->enable_line_numbers(GESHI_NORMAL_LINE_NUMBERS);

$geshi->enable_classes();

echo $geshi->parse_code();
?>
				</figure>
			</div>

			<div class="subsection">
				<h3>3 Digit Hexadecimal</h3>

				<p>
					Sometimes you'll see 3 digit hexadecimal colors like this: <code>#000</code>.
				</p>

				<p>
					This means each color pair had 2 identical digits.
				</p>

				<figure>
					<code>f</code> = <code>ff</code> so <code>#fff</code> = <code>#ffffff</code> and <code>#3a9</code> = <code>#33aa99</code>.
				</figure>
				<figure>

				<figure>
					<figcaption>
						Here's how to convert a 3 digit hexidecimal color to 6 digits in javascript:
					</figcaption>

<?php
$source = "threeDigitsToSix('#000');

function threeDigitsToSix(color){
    hex = color.split('');

    return '#' + hex[1] + hex[1] + hex[2] + hex[2] + hex[3] + hex[3];
}";

$geshi = new GeSHi($source, 'javascript');

$geshi->enable_line_numbers(GESHI_NORMAL_LINE_NUMBERS);

$geshi->enable_classes();

echo $geshi->parse_code();
?>
				</figure>								
			</div>

			<div class="subsection">
				<h3><abbr>RGB</abbr> (Red, Green, Blue)</h3>

				<p>
					The hexadecimal numbering system is just one way to represent <abbr>RGB</abbr> numbers. Now that we've converted the hexidecimal numbers to base-10, we can easily write the color in <abbr>RGB</abbr>, a base-10 format:
				</p>

				<figure>
					<code>rgb(186, 218, 85)</code>
				</figure>

				<figure>
					<figcaption>
						Here's how to convert a hexidecimal color to an <abbr>RGB</abbr> color in javascript:
					</figcaption>

<?php
$source = "hexToRgb('#BADA55');

function hexToRgb(hex){
    var red   = base16ToBase10( hex.substring( 0, 2 ) );
    var green = base16ToBase10( hex.substring( 2, 4 ) );
    var blue  = base16ToBase10( hex.substring( 4, 6 ) );

    return 'rgb(' + red + ',' + green + ',' + blue + ')';
}

function base16ToBase10(base16){
    return parseInt(base16,16);
}";

$geshi = new GeSHi($source, 'javascript');

$geshi->enable_line_numbers(GESHI_NORMAL_LINE_NUMBERS);

$geshi->enable_classes();

echo $geshi->parse_code();
?>
				</figure>
			</div>

			<div class="subsection">
				<h3><abbr>RGBA</abbr> (Red, Green, Blue, Alpha)</h3>	

				<aside class="right">
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
				</aside>

				<p>
					There's another version of <abbr>RGB</abbr> which is frequently used on the web. <abbr>RGBA</abbr> adds an additional parameter; alpha. Alpha determines the transparency or opacity of the color. 0 is completely transparent. 1 is completely opaque. 
				</p>

				<figure>
					<code>rgba(186, 218, 85, 0)</code> vs <code>rgba(186, 218, 85, 1)</code>
				</figure>

				<p>
					<abbr>RGBA</abbr> is going out of fashion since most browsers now support the opacity attribute, making it easier to handle transparency separately from color.
				</p>

				<p>
					For the purposes of these data visualizations, the alpha tag has been stripped from <abbr>RGBA</abbr> colors, effectively treating them as <abbr>RGB</abbr>.
				</p>
			</div>

			<div class="subsection">
				<h3><abbr>HSL</abbr> (Hue, Saturation, Lightness)</h3>

				<p><abbr>HSL</abbr> is a color format that attempts to match how humans view color by organizing by hue, saturation and lightness.</p>
			
				<div class="subsection">
					<h4>Hue</h4>

					<aside class="right">
						<?php include('assets/svgs/hue_color_wheel.php'); ?>
					</aside>

					<p>Hue is the most common way for people to describe colors. Hue refers to the shade of a color. Red, Green, Blue, Pink and Orange are all examples of hue.</p>
				
					<p>In the <abbr>hsl</abbr> color model hue is plotted around a circle, so is represented as a number between 0 and 360.</p>

					<figure class="colorPicker" data-format='hsl(,)' data-delimiter=",">
						<code class="colorBlock"></code>

						<form autocomplete="off">
							<input type="range" min="0" max="360" data-scale="" data-unit="" name="hue" value="180">

							<input class="hidden" type="range" min="0" max="100" data-scale="" data-unit="%" name="saturation" value="100">

							<input class="hidden" type="range" min="0" max="100" data-scale="" data-unit="%" name="lightness" value="50">
						</form>
					</figure>
				</div>	

				<div class="subsection">
					<h4>Saturation</h4>

					<p>Saturation is a little more difficult to understand than hue. Saturation is the purity of a color, or how much grey is in the color.</p>

					<p>A low saturation color is almost completely grey, black or white. A high saturation color is almost completely its hue. Saturation is represented as a percentage between 0 and 100.

					<figure class="colorPicker" data-format='hsl(,)' data-delimiter=",">
						<code class="colorBlock"></code>

						<form autocomplete="off">
							<input class="hidden" type="range" min="0" max="360" data-scale="" data-unit="" name="hue" value="0">

							<input type="range" min="0" max="100" data-scale="" data-unit="%" name="saturation" value="50">

							<input class="hidden" type="range" min="0" max="100" data-scale="" data-unit="%" name="lightness" value="50">
						</form>
					</figure>
				</div>

				<div class="subsection">
					<h4>Lightness</h4>

					<p>Lightness determines whether a color is dark or light. A <code>100%</code> is white and a <code>0%</code> is black.

					<figure class="colorPicker" data-format='hsl(,)' data-delimiter=",">
						<code class="colorBlock"></code>

						<form autocomplete="off">
							<input class="hidden" type="range" min="0" max="360" data-scale="" data-unit="" name="hue" value="180">

							<input class="hidden" type="range" min="0" max="100" data-scale="" data-unit="%" name="saturation" value="50">

							<input type="range" min="0" max="100" data-scale="" data-unit="%" name="lightness" value="50">
						</form>
					</figure>
				</div>
			</div>
			
			<div class="subsection">
				<h3><abbr>HSLA</abbr> (Hue, Saturation, Lightness, Alpha)</h3>
			
				<aside class="right">
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
				</aside>
				<p>
					Similar to <abbr>RGBA</abbr>, <abbr>HSLA</abbr> has an alpha channel to determine transparency.
				</p>

				<p>
					For the purposes of these data visualizations, the alpha tag has been stripped from RGBA colors, effectively treating them as RGB. 
				</p>
			</div>
			
			<div class="subsection">
				<h3>Converting from <abbr>RGB</abbr> to <abbr>HSL</abbr></h3>

				<p>
					Coverting <abbr>RGB</abbr> colors to <abbr>HSL</abbr> gets a little complicated.
				</p>

				<p>
					All of our calculations will require
				</p>
			</div>

			<div class="subsection">
				<h3>Predefined Color Names</h3>

				<p>In addition to the numeric systems, <abbr>HTML</abbr> and <abbr>CSS</abbr> recognize certain color names. 140 names are supported by all browsers. The names range from common words like <code>white</code> and <code>red</code> to stranger examples like <code>LightGoldenRodYellow</code>, <code>PapayaWhip</code>, <code>IndianRed</code> and <code>AliceBlue</code>.
			
				<figure class="colorPicker" data-format=',' data-delimiter="">
					<code class="colorBlock"></code>

					<form autocomplete="off">
						<select name='color' data-scale="" data-unit="" class="colorNames">
							<?php include('assets/php/color_names.php'); ?>
						</select>
					</form>
				</figure>
			</div>
		</section>

		<section>
			<div class="subsection">			
				<aside class="left">
					<figure>
						<svg class="hue fan chart"></svg>

						<input type="range" min="0" max="255" value="255" data-target=".hue.fan.chart .background" class="backgroundChanger" autocomplete="off">

						<figcaption>Use this slider to change the background color and expose hidden colors.</figcaption>
					</figure>	
				</aside>

				<h2>Fan Charts</h2>	

				<p>In this fan chart, colors are organized around the circle by hue. Their distance from the center is determined by their value.</p>

				<p>Depending on the background color of the chart, you may not be able to see certain colors. Use the color slider below the chart to change the background and expose hidden colors.</p>
			</div>
		</section>

		<section>
			<div class="subsection">
				<h2>Bar Charts</h2>
			</div>
		</section>

		<?php
			$txt = file_get_contents('colors.txt', FILE_USE_INCLUDE_PATH);
			$colors = preg_split('/,/', $txt);
			echo '<script type="text/javascript">';
				echo 'colors = new Array;';
				$i = 0;
				foreach ($colors as $color){
					echo 'current ={"hex":"' . $color . '"};';
					echo 'colors.push(current);';  

					$i++;
				}
		?>
			</script>
	</main>

<?php
	include('assets/php/footer.php');
?>
