<?php
	$title = 'The Colors of the Web';

	include('assets/php/header.php');
?>

	<main>
		<section>
			<div class="subsection">
				<h1>
					The Colors of the 10 Most Popular Websites
				</h1>

				<figure>
					<div class="hue rectangle chart"></div>
				</figure>

				<h2>The Data</h2>

				<aside class="right sites">
					<a href="http://www.google.com" target="_blank">google.com</a>
					 <a href="http://www.facebook.com" target="_blank">facebook.com </a>
					 <a href="http://www.youtube.com" target="_blank">youtube.com </a>
					 <a href="http://www.yahoo.com" target="_blank">yahoo.com </a>
					 <a href="http://www.baidu.com" target="_blank">baidu.com </a>
					 <a href="http://www.wikipedia.org" target="_blank">wikipedia.org </a>
					 <a href="http://www.amazon.com" target="_blank">amazon.com </a>
					 <a href="http://www.twitter.com" target="_blank">twitter.com </a>
					 <a href="http://www.cq.com" target="_blank">cq.com </a>
					 <a href="http://www.linkedin.com" target="_blank">linkedin.com</a>
				</aside>

				<p>
					These colors were used in stylesheets or images featured in <a href="http://www.alexa.com/topsites" target="_blank">the top 10 sites</a> listed on Alexa.com. (Some colors were present in stylesheets but not actually used on the site. These were still included in the graphs.)
				</p>

				<p>
					There were a total of 537 colors used, including duplicates. For example, 4 of the 10 sites used pure white (#ffffff) in their designs. Duplicated colors are represented in the data multiple times (once for each use), giving those colors a wider bar in the charts.
				</p>

				<p class='desktop'>
					Scroll over the colors to see their hue, saturation, value, and hexadecimal color code.
				</p>
			</div>
		</section>

		<section>
			<div class="subsection">
				<h2>Converting Between Color Formats</h2>

				<p>
					Artists, graphic designers, scientists and programmers have developed a number of different numerical models to represent color. In order to analyze this data, we'll first have to convert all the colors used into a single format.
				</p>
			</div>

			<div class="subsection">
				<h3>Hexadecimal</h3>

				<aside class="left">
					<figure>
						<table>
							<tr>
								<td>0</td><td>&nbsp;&nbsp;&#8594;&nbsp;&nbsp;</td><td>0</td>
							</tr>
							<tr>
								<td>1</td><td>&nbsp;&nbsp;&#8594;&nbsp;&nbsp;</td><td>1</td>
							</tr>
							<tr>
								<td>2</td><td>&nbsp;&nbsp;&#8594;&nbsp;&nbsp;</td><td>2</td>
							</tr>
							<tr>
								<td>3</td><td>&nbsp;&nbsp;&#8594;&nbsp;&nbsp;</td><td>3</td>
							</tr>
							<tr>
								<td>4</td><td>&nbsp;&nbsp;&#8594;&nbsp;&nbsp;</td><td>4</td>
							</tr>
							<tr>
								<td>5</td><td>&nbsp;&nbsp;&#8594;&nbsp;&nbsp;</td><td>5</td>
							</tr>
							<tr>
								<td>6</td><td>&nbsp;&nbsp;&#8594;&nbsp;&nbsp;</td><td>6</td>
							</tr>
							<tr>
								<td>7</td><td>&nbsp;&nbsp;&#8594;&nbsp;&nbsp;</td><td>7</td>
							</tr>
							<tr>
								<td>8</td><td>&nbsp;&nbsp;&#8594;&nbsp;&nbsp;</td><td>8</td>
							</tr>
							<tr>
								<td>9</td><td>&nbsp;&nbsp;&#8594;&nbsp;&nbsp;</td><td>9</td>
							</tr>
							<tr>
								<td>a</td><td>&nbsp;&nbsp;&#8594;&nbsp;&nbsp;</td><td>10</td>
							</tr>
							<tr>
								<td>b</td><td>&nbsp;&nbsp;&#8594;&nbsp;&nbsp;</td><td>11</td>
							</tr>
							<tr>
								<td>c</td><td>&nbsp;&nbsp;&#8594;&nbsp;&nbsp;</td><td>12</td>
							</tr>
							<tr>
								<td>d</td><td>&nbsp;&nbsp;&#8594;&nbsp;&nbsp;</td><td>13</td>
							</tr>
							<tr>
								<td>e</td><td>&nbsp;&nbsp;&#8594;&nbsp;&nbsp;</td><td>14</td>
							</tr>
							<tr>
								<td>f</td><td>&nbsp;&nbsp;&#8594;&nbsp;&nbsp;</td><td>15</td>
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

				<p>
					The remaining 3 sections contain important information about the color. Hexidecimal colors are based off of the RGB (Red, Green, Blue) color model and each section defines how much of one of those colors is present in the final color.
				</p>

				<p>
					Red: <code>BA</code> Green: <code>DA</code> Blue: <code>55</code>
				</p>

				<p>
					Two base-10 digits have 100 possible combinations. (10 * 10) Two base-16 digits have 256 possible combinations (16 * 16), so each color (RGB) has a possible value between 0 and 255. Here are the color values for <code>#BADA55</code>, converted into base-10.
				</p>

				<p>
					Red: <code>186</code> Green: <code>218</code> Blue: <code>85</code>
				</p>
			</div>

			<div class="subsection">
				<h3>RGB (Red Green Blue)</h3>

				<p>
					The hexadecimal numbering system is just one way to represent RGB numbers. Now that we've converted the hexidecimal numbers to base-10, we can easily write the color in RGB format:
				</p>

				<p>
					<code>rgb(186, 218, 85)</code>
				</p>
			</div>

			<div class="subsection">
				<h3>RGB (Red Green Blue Alpha)</h3>	

				<aside class="right">
					<figure id="rgbaExample">
						<div class="colorBlock"></div>

						<fieldset>
							<label for="red">Red:</label>
							<input type="range" min="0" max="255" dataTarget="0" name="red" value="186">

							<label for="green">Green:</label>
							<input type="range" min="0" max="255" dataTarget="1" name="green" value="218">

							<label for="blue">Blue:</label>
							<input type="range" min="0" max="255" dataTarget="2" name="blue" value="85">

							<label for="alpha">Alpha:</label>
							<input type="range" min="0" max="100" dataTarget="3" name="alpha" value="100">
						</fieldset>
					</figure>
				</aside>

				<p>
					There's another version of RGB which is frequently used on the web. RGBA adds an additional parameter; alpha. Alpha determines the transparency or opacity of the color. 0 is completely transparent. 1 is completely opaque. 
				</p>

				<p>
					<code>rgb(186, 218, 85, 0)</code> vs <code>rgb(186, 218, 85, 1)</code>
				</p>

				<p>
					RGBA is going out of fashion since most browsers now support the opacity attribute, making it easier to handle transpareny separately from color.
				</p>
			</div>
		</section>

		<section>
			<div class="subsection">			
				<aside class="right">
					<figure>
						<svg class="hue fan chart"></svg>

						<div class="bwSlider">
							<input type="range" min="0" max="255" value="255" dataTarget=".hue.fan.chart .background" class="backgroundChanger">
						</div>

						<figcaption>Use this slider to change the background color.</figcaption>
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
