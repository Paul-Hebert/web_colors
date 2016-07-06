<?php
	$title = 'The Colors of the Web';
	$id = 'dashboard';

	include('assets/php/header.php');
?>

	<main>
		<section>
			<div class="subsection" id="aggregate">
				<h1>Dashboard</h1>

				<figure class="large right">
					<div class="histogram chart hue"></div>
				</figure>

				<aside class="right">
					<figure>
						<svg class="hue fan chart"></svg>
					</figure>	
				</aside>

				<figure style="font-size:0px;">
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
			</div>
		</section>
	</main>

<?php
	include('assets/php/footer.php');
?>
