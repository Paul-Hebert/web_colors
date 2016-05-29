<?php
$to = "paul.hebert@paulhebertdesigns.com";
$from = $_POST['Email'];
$subject = $_POST['Subject'] . ' -- ' . $_POST['Name'];
$message = $_POST['Message'];

$headers = 'From: '. $from . "\r\n" .
    'Reply-To: ' . $from . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

mail($to, $subject, $message, $headers);
?>
<div id="success">
	<h1>Thanks for reaching out!</h2>
	<p>I'll get back to you as soon as possible.</p>
</div>