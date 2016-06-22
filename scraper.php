<?php
	$title = 'Scraper';

	include('assets/php/header.php');
?>

	<main>
		<form>
			<h1>Scraper</h1>

			<fieldset>
				<label for="url">
					URL to scrape
				</label>
				<input type="text" name="url" id="scraperUrl" placeholder="http://www...">
			</fieldset>			

			<figure class="large right" id="results">
				
			</figure>

			<span class="button" id="scraperButton">Scrape</span>
		</form>
	</main>

<?php
	include('assets/php/footer.php');
?>
 