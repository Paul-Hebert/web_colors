<?php
	$title = 'The Colors of the Web';
	$id = 'home';

	include('assets/php/header.php');
?>

	<main>
		<section>
			<div class="subsection" id="aggregate">
				<h1 id="title">
					The Colors Used by the Ten Most Popular Sites
				</h1>

				<figure class="large right" style="font-size:0px;">
					<?php
						$path = 'assets/data/';
						$files = scandir($path);
						$array_length = count($files);
						$files = array_diff($files, array('.', '..'));

						$sites = array_map(function($v){return str_getcsv($v, "|");}, file($path . $files[$array_length-1]));


						foreach($sites as $site){
							for($count = 1; $count < count($site); $count++){
								echo '<span class="color listing"><span>' . $site[$count] . '</span></span>';
							}
						}
					?>
				</figure>

				<p>I was curious what colors were being used by large, popular sites, so I decided to find out.</p>
			
				<p><a href="http://www.alexa.com" target="_BLANK">Alexa.com</a> maintains a list of the <a href="http://www.alexa.com/topsites" target="_BLANK">most visited sites on the internet</a>. I wrote a <abbr>PHP</abbr> script to scrape the ten most popular sites and record all the colors used in the sites' home pages and style sheets.</p>
			
				<p>I plan to rescrape the <a href="data.php">data</a> on a regular basis. Because of this, I'll keep analysis to a minimum, since it could become outdated when the data changes. Once I have data over a larger time period I'll be able to examine and graph trends in web development.</p>
			</div>
		</section>

		<section>
			<div class="subsection">
				<h2>Try it For Yourself</h2>

				<p>Enter a <abbr>URL</abbr> below and click Scrape to see the colors used on that page. It may take a little while.</p>

				<?php include('assets/php/utilities/scrape/form.php'); ?>
			</div>
		</section>

		<section>
			<div class="subsection">
				<h2>The Sites</h2>

				<p>Here are the ten most popular sites, and the colors that they use. <span class="hide-on-small">Mouse over</span><span class="hide-on-medium-large">Click on</span> colors to see their color codes.</p>

				<figure class="large right">
					<?php
						foreach($sites as $site){
							echo '<div class="block chart">';
								echo '<aside class="left"><label>' . $site[0] . '</label></aside>';

								for($count = 1; $count < count($site); $count++){
									echo '<span class="color listing"><span>' . $site[$count] . '</span></span>';
								}
							echo '</div>';
						}
					?>
				</figure>
			</div>
		</section>

		<section>
			<div class="subsection">
				<h2>Colors by Hue</h2>

				<p>For the purposes of this chart, transparency was removed from all colors.</p>

				<figure class="large right">
					<div class="shade bar chart">
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
					Browsers recognize colors in six different formats; hexadecimal, <abbr>RGB</abbr>, <abbr>RBGA</abbr>, <abbr>HSL</abbr>, <abbr>HSLA</abbr>, and predefined color names. 
				</p>

				<figure class="large right">
					<div class="format bar chart">
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
				<h2>Colors by Hue and Then Lightness</h2>

				<figure>
					<svg class="hue fan chart"></svg>

					<input type="range" min="0" max="255" value="255" data-target=".hue.fan.chart .background" class="backgroundChanger" autocomplete="off">

					<figcaption>Use this slider to change the background color and expose hidden colors.</figcaption>
				</figure>	

				<p>In this fan chart, colors are organized around the circle by hue. Their distance from the center is determined by their value.</p>

				<p>If a color was found more than once in the data it has a larger area. A color that was found three times has an area three times larger than a color that was found once.</p>
			
				<p>You can see distinct lines towards red, green and blue. Many of the grayscale colors have a hue of zero. Since pure red has a hue of zero as well, you can see black, white and grey cluster with red.</p>

				<p>Unfortunately, using this style of chart has one main disadvantage. Some colors become hidden under other colors. For example, pure red is on top of pure white, since they both have a hue and value of 0.</p>
			</div>
		</section>		

		<section>
			<div class="subsection">
				<h1>Converting Between Color Formats</h1>

				<p>In order to organize this data for the above charts, we had to convert all the colors used into a single format. Here I'll explain the different color formats and how I converted them all to <Abbr>HSL</abbr>.</p>				
			</div>

			<div class="subsection">
				<h3>Predefined Color Names</h3>

				<p>Browsers recognize certain predefined color names. 140 names are supported by all browsers. The names range from common words like <code>white</code> and <code>red</code> to stranger examples like <code>LightGoldenRodYellow</code>, <code>PapayaWhip</code>, <code>IndianRed</code> and <code>AliceBlue</code>.
			
				<figure class="colorPicker" data-format=',' data-delimiter="">
					<code class="colorBlock"></code>

					<form autocomplete="off">
						<select name='color' data-scale="" data-unit="" class="colorNames">
							<?php include('assets/php/color_names.php'); ?>
						</select>
					</form>
				</figure>
			</div>

			<div class="subsection">
				<h3><abbr>RGB</abbr> (Red, Green, Blue)</h3>

				<p>
					Digital colors are made by combining different amounts of red, green and blue light. The amount of each color is represent by a number between 0 and 255.
				</p>

				<p>This is how to write the <abbr>RGB</abbr> color format: <code>rgb(186, 218, 85)</code>. The first number is red, the second is green and the third is blue.</p>
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
			</div>

			<div class="subsection">
				<h3>Hexadecimal</h3>

				<aside class="left hide-on-small">
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
					The most common color format on the web is hexadecimal. Hexadecimal colors are another way to represent <abbr>RGB</abbr> colors.
				</p>

				<p>
					Hexadecimal numbers are base-16 instead of base-10, so each character represents a number between 0 and 15 instead of 0 and 9.
				</p>

				<figure class="codeFigure">
					<figcaption>
						Here's how to convert base-16 to base-10 in javascript.
					</figcaption>

<?php
$source = "base16ToBase10('f0');

function base16ToBase10(base16){
    return parseInt(base16,16);
}";

$geshi = new GeSHi($source, 'javascript');

$geshi->enable_line_numbers(GESHI_NORMAL_LINE_NUMBERS);

$geshi->enable_classes();

echo $geshi->parse_code();
?>
				</figure>

				<figure class="codeFigure">
					<figcaption>
						Here's how to do the inverse: convert base-10 to base-16.
					</figcaption>

<?php
$source = "base10ToBase16(186);

function base10ToBase16(base10){
    var base16 = parseFloat(base10).toString(16);

	// If the hex number is 1 character long, add a 0 to the front.
    if (base16.length == 1){
        base16 = '0' + base16;
    }

    return base16;
}";

$geshi = new GeSHi($source, 'javascript');

$geshi->enable_line_numbers(GESHI_NORMAL_LINE_NUMBERS);

$geshi->enable_classes();

echo $geshi->parse_code();
?>
				</figure>

				<p>
					A hexadecimal color is six characters long and preceded by a number sign: <code>#BADA55</code>. Hexadecimal colors can be split into 4 sections: <code>#</code> + <code>BA</code> + <code>DA</code> + <code>55</code>. We can ignore the first section: <code>#</code>. This section tells the browser that a hexadecimal color is coming.
				</p>

				<p>
					The remaining 3 sections contain important information about the color. Hexadecimal colors are based off of the <abbr>RGB</abbr> (Red, Green, Blue) color model and each section defines how much of one of those colors is present in the final color.
				</p>
			
				<aside class="right">
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
				</aside>

				<figure>
					Red: <code>BA</code> Green: <code>DA</code> Blue: <code>55</code>
				</figure>

				<p>
					Here are the color values for <code>#BADA55</code>, converted into base-10.
				</p>

				<figure>
					Red: <code>186</code> Green: <code>218</code> Blue: <code>85</code>
				</figure>

				<figure class="codeFigure">
					<figcaption>Here's how to convert a hexadecimal color to <abbr>RGB</abbr>.</figcaption>

<?php
$source = " hexToRgb( '#BADA55' );

function hexToRgb(color){
    var red   = base16ToBase10( color.substring( 1, 3 ) );
    var green = base16ToBase10( color.substring( 3, 5 ) );
    var blue  = base16ToBase10( color.substring( 5, 7 ) );
 
    return 'rgb(' + red + ',' + green + ',' + blue + ')';
}";

$geshi = new GeSHi($source, 'javascript');

$geshi->enable_line_numbers(GESHI_NORMAL_LINE_NUMBERS);

$geshi->enable_classes();

echo $geshi->parse_code();
?>				
				<figure>

				<figure class="codeFigure">
					<figcaption>Here's how to convert an <abbr>RGB</abbr> color to hexadecimal.</figcaption>
				
<?php
$source = " rgbToHex( 'rgb(100,222,0)' );

function rgbToHex(color){
    var temp_color = color.replace('rgb(', '');
    temp_color = temp_color.replace(')', '');
    temp_color = temp_color.split(',');

    var red = base10ToBase16(temp_color[0]);
    var green = base10ToBase16(temp_color[1]);
    var blue = base10ToBase16(temp_color[2]);

    return '#' + red + green + blue;
}";

$geshi = new GeSHi($source, 'javascript');

$geshi->enable_line_numbers(GESHI_NORMAL_LINE_NUMBERS);

$geshi->enable_classes();

echo $geshi->parse_code();
?>				
				<figure>
			</div>

			<div class="subsection">
				<h3>3 Digit Hexadecimal</h3>

				<p>
					Sometimes you'll see 3 digit hexadecimal colors like this: <code>#000</code>. This means each color pair had 2 identical digits.
				</p>

				<figure>
					<code>f</code> = <code>ff</code> so <code>#fff</code> = <code>#ffffff</code> and <code>#3a9</code> = <code>#33aa99</code>.
				</figure>
				<figure>

				<figure class="codeFigure">
					<figcaption>
						Here's how to convert a 3 digit hexadecimal color to 6 digits in javascript:
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

					<p>Saturation is the purity of a color, or how much grey is in the color.</p>

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
			</div>
			
			<div class="subsection">
				<h3>Converting from <abbr>RGB</abbr> to <abbr>HSL</abbr></h3>

				<aside class="left">
					<citation>I learned how to do this conversion from this <a href="http://www.niwa.nu/2013/05/math-behind-colorspace-conversions-rgb-hsl/">helpful article</a> by Nikolai Waldman.</citation>
				</aside>

				<p>The first step is to convert all red, green and blue values into decimals between 0 and 1.</p>

				<p>Then you determine the "min" and "max." The min is the smallest decimal and the max is the largest decimal.</p>

				<p>To discover the lightness, add the min and max values together and then divide by 2.</p>

				<p>Once we have these values we can determine whether there is saturation and hue. If min and max are the same, then the saturation is 0. If the saturation is 0, then the hue is 0.</p>

				<p>If min and max aren't the same, then we need to determine the saturation. Depending on the lightness there are 2 different formulas to use.</p>

				<p>If the lightness is below 0.5 then the saturation equals <code>(max-min)/(max+min)</code></p>
				
				<p>If the lightness is larger than 0.5 then the saturation equals <code>(max-min)/(2-max-min)</code></p>

				<p>Now that we know the lightness and saturation, we can determine the hue. The formula to determine hue depends on which color was the "max."</p>
			
				<p>If red was the max then hue equals <code>(green-blue)/(max-min)</code></p>

				<p>If green was the max then hue equals <code>2+(blue-red)/(max-min)</code></p>

				<p>If red was the max then hue equals <code>4+(red-green)/(max-min)</code></p>

				<p>After making this calculation you need to convert hue to a vlue between and 255. Multiply the value by 42.6. If it is below 0, then add 255 to the value.</p>
			</div>

			<div class="subsection">
				<h3>We're Done!</h3>

				<p>The <abbr>HSL</abbr> color model is very close to how people interpret colors, so it is the most useful model for organization and analysis. Now that all of our colors are in <abbr>HSL</abbr> we can organize by hue, saturation and lightness.</p>
			</div>
		</section>

		<section>
			<div class="subsection">
				<h1>Caveats</h1>
				<p>Although I've tried to make this site as accurate as possible there are some known issues which have not yet been resolved.</p>

				<ol>
					<li>Colors in images are not included.</li>

					<li>Some colors in stylesheets aren't actually used on the sites.</li>

					<li>If a color is found inside of a website's text it counts as being used. For example if the phrase "tan leather" is in a website's text, this scraper would say that the site uses tan. Additionally if the phrase "I unders<strong>tan</strong>d" is in the text, it would still count as tan.</li>
					
					<li>Colors added by javascript are not included.</li>
				</ol>

				<p>Notice any other issues? <a href="contact.php">Contact me</a> and I'll fix it or add it as a caveat. Thanks for reading!</p>
			</div>
		</section>
	</main>

<?php
	include('assets/php/footer.php');
?>
