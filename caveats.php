<?php
	$title = 'Caveats';
	$id = 'caveats';

	$metaDescription = 'A website providing data on the colors used by popular websites online as well as color pickers, and color theory.';
	$metaImage = 'assets/imgs/ogImage.png';
	$metaImageAlt = 'A visualization of the colors of the web.';
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
					
					<li>Colors added by external javascript are not included.</li>
				</ol>

				<p>When this was first released there was a significant bug causing a number of false positives. This has now been resolved. I apologize for any inconvenience.</p>

				<p>Notice any other issues? <a href="contact.php">Contact me</a> or put in a <a href="https://github.com/Paul-Hebert/web_colors">pull request</a> and I'll fix it or add it as a caveat. Thanks for reading!</p>
			</div>
		</section>
	</main>

<?php
	include('assets/php/footer.php');
?>
