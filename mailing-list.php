<?php
	$title = 'Mailing List';
	$id = 'mailingList';

	include('assets/php/header.php');
?>

	<main>
		<section>
			<div class="subsection">
				<h1>Join My Mailing List</h1>

				<p>I'll only email you things I think you might find interesting.</p>
			</div>

			<div class="subsection">
				<?php include('assets/php/mailchimpForm.php'); ?>
			</div>
		</section>
	</main>

<?php
	include('assets/php/footer.php');
?>
