<?php
	$title = 'The Colors of the Web';

	include('assets/php/header.php');
?>

	<main>
		<div class="row">
			<div class="col-md-6">
				<figure>
					<svg class="hue fan chart"></svg>
					<figcaption>Sorted first by hue, then saturation, then value.</figcaption>
				</figure>

				<figure>
					<div class="hue rectangle chart"></div>
					<figcaption>Sorted first by hue, then saturation, then value.</figcaption>
				</figure>

				<figure>
					<div class="sat rectangle chart"></div>
					<figcaption>Sorted first by saturation, then hue, then value.</figcaption>
				</figure>

				<figure>
					<div class="val rectangle chart"></div>
					<figcaption>Sorted first by value, then saturation, then hue.</figcaption>
				</figure>
			</div>

			<div class="col-md-5">
				<h1>
					The Colors of the 10 Most Popular Websites
				</h1>

				<p>
					These colors were used in stylesheets or images featured in <a href="http://www.alexa.com/topsites" target="_blank">the top 10 sites</a> listed on Alexa.com. (Some colors were present in stylesheets but not actually used on the site. These were still included in the graphs.)
				</p>

				<p>
					There were a total of 537 colors used, including duplicates. For example, 4 of the 10 sites used pure white (#ffffff) in their designs. Duplicated colors are represented in the data multiple times (once for each use), giving those colors a wider bar in the charts.
				</p>

				<p class='desktop'>
					Scroll over the colors to see their hue, saturation, value, and hexadecimal color code.
				</p>

				<div class="sites">
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
				</div>
			</div>
		</div>

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
