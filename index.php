<!Doctype HTML>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
		<script type="text/javascript" src="js/functions.js"></script>
		<script type="text/javascript" src="js/thenBy.js"></script>

		<link href='http://fonts.googleapis.com/css?family=Bree+Serif|Open+Sans' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" type="text/css" href="style.css" />
	</head>

	<body>
		<h1>
			The Colors of the 10 Most Popular Websites
		</h1>

		<div id="hue" class="holder"></div>
		<span class="caption">Sorted first by hue, then saturation, then value.</span>

		<div id="sat" class="holder"></div>
		<span class="caption">Sorted first by saturation, then hue, then value.</span>

		<div id="val" class="holder"></div>
		<span class="caption">Sorted first by value, then saturation, then hue.</span>

		<div class="explanation">
			<p>
				Scroll over the colors above to see their hue, saturation, value, and hexadecimal color code.
			</p>

			<p>
				These colors were used in stylesheets or images featured in <a href="http://www.alexa.com/topsites" target="_blank">the top 10 sites</a> listed on Alexa.com. (Some colors were present in stylesheets but not actually used on the site. These were still included in the graphs above.)
			</p>

			<p>
				There were a total of 537 colors used, including duplicates. For example, 4 of the 10 sites used pure white (#ffffff) in their designs. Duplicated colors are represented in the data multiple times (once for each use), giving those colors a wider bar in the charts.
			</p>

			<!--<p>
				*Colors were sorted by one characteristic (e.g. hue) and then sorted by the other two. For example, the first graph was sorted by hue. If two colors had the same hue then they were sorted by saturation. If they also had the same saturation they were sorted again by value.
			</p>-->
		</div>

		<div class="sites">
			<a href="http://www.google.com" target="_blank">google.com</a>
			 &bull; 
			 <a href="http://www.facebook.com" target="_blank">facebook.com </a>
			 &bull; 
			 <a href="http://www.youtube.com" target="_blank">youtube.com </a>
			 &bull; 
			 <a href="http://www.yahoo.com" target="_blank">yahoo.com </a>
			 &bull; 
			 <a href="http://www.baidu.com" target="_blank">baidu.com </a>
			 &bull; 
			 <a href="http://www.wikipedia.org" target="_blank">wikipedia.org </a>
			 &bull; 
			 <a href="http://www.amazon.com" target="_blank">amazon.com </a>
			 &bull; 
			 <a href="http://www.twitter.com" target="_blank">twitter.com </a>
			 &bull; 
			 <a href="http://www.cq.com" target="_blank">cq.com </a>
			 &bull; 
			 <a href="http://www.linkedin.com" target="_blank">linkedin.com</a>
		</div>

		<?php
			$txt = file_get_contents('colors.txt', FILE_USE_INCLUDE_PATH);
			$colors = preg_split('/,/', $txt);
			echo '<script type="text/javascript">';
				echo 'colorsOG = new Array;';
				$i = 0;
				foreach ($colors as $color){
					echo 'current ={"hex":"' . $color . '"};';
					echo 'colorsOG.push(current);';  

					$i++;
				}
		?>
			</script>
			<script type="text/javascript">
				printColors('hue');
				printColors('sat');
				printColors('val');
			</script>
		
	</body>
</html>