<?php
	$title = 'Scraper';
	$id = 'scraper';

	include('assets/php/header.php');
?>

	<main>
		<h1>Scraper</h1>

		<p>Enter a <abbr>URL</abbr> below and click Scrape to see the colors used on that page. It can take a little while.</p>

		<?php include('assets/php/utilities/scrape/form.php'); ?>
	</main>

<?php
	include('assets/php/footer.php');
?>
 