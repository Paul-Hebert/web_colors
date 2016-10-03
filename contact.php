<?php
	$title = 'Contact';
	$id = 'contact';

	$metaDescription = 'A website providing data on the colors used by popular websites online as well as color pickers, and color theory.';

	include('assets/php/header.php');
?>

	<main>
		<form method="post" action="assets/php/utilities/email.php" class="contact_form">
			<h1>Contact</h1>

			<fieldset>
				<label for="Name">Name</label>
				<input type="text" class="required" name="Name">
			</fieldset>

			<fieldset>
				<label for="Email">Email</label>
				<input type="text" class="required" name="Email">
			</fieldset>
			
			<fieldset>
				<label for="Subject">Subject</label>
				<input type="text" class="required" name="Subject">
			</fieldset>
			
			<fieldset>
				<label for="Message">Message</label>
				<textarea class="required" name="Message"></textarea>
			</fieldset>

			<input type="submit" value="Send Email">
		</form>
	</main>

<?php
	include('assets/php/footer.php');
?>
