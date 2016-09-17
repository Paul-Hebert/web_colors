<?php
	$title = 'Caveats';
	$id = 'caveats';

	include('assets/php/header.php');
?>

	<main>
		<section>
			<div class="subsection">
				<h1>Caveats</h1>
				<p>Although I've tried to make this site as accurate as possible there are some known issues which have not yet been resolved.</p>

				<ol>
					<li>Colors in images are not included.</li>

					<li>Some colors in stylesheets aren't actually used on the sites.</li>

					<li>If a color is found inside of a website's text it counts as being used. For example if the phrase "tan leather" is in a website's text, this scraper would say that the site uses tan. Additionally if the phrase "I understand" is in the text, it would still count as tan.</li>
					
					<li>Colors added by external javascript are not included.</li>
				</ol>

				<p>Notice any other issues? <a href="contact.php">Contact me</a> or put in a <a href="https://github.com/Paul-Hebert/web_colors">pull request</a> and I'll fix it or add it as a caveat. Thanks for reading!</p>
			</div>
		</section>
	</main>

<?php
	include('assets/php/footer.php');
?>
