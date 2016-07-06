<?php
	include('assets/php/utilities/geshi/geshi/javascript.php');
	include('assets/php/utilities/geshi/geshi.php');
?>

<!doctype HTML>

<html>
	<head>
		<meta charset='utf-8'>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<title><?php echo $title; ?></title>
		<link href='http://fonts.googleapis.com/css?family=Roboto|Roboto+Slab' rel='stylesheet' type='text/css'>		
		<link rel="stylesheet" type='text/css' href='assets/css/style.css'>

		<?php include('assets/php/favicons.php'); ?>
	</head>

	<?php echo "<body id='" . $id . "'>"; ?>
		<header>
			<?php include('assets/php/nav.php'); ?>

			<div id="menu-toggle" class="mobile">
				<?php include('assets/svgs/hamburger.php'); ?>
			</div>
		</header>