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

		<?php 
			include('assets/php/favicons.php');
			echo '
				<meta property="og:title" content="' . $title . '">
				<meta property="og:site_name" content="' . $title . '">
				<meta name="description" content="' . $metaDescription . '">
				<meta property="og:description" content="' . $metaDescription . '">
				<meta property="og:image" content="' . $metaImage . '">
				<meta name="twitter:image:alt" content="' . $metaImageAlt . '">				
				<meta property="og:url" content="http://paulhebertdesigns.com/web_colors/">
				<meta name="twitter:card" content="summary_large_image">
			';
		?>
	</head>

	<?php echo "<body id='" . $id . "'>"; ?>
		<header>
			<?php include('assets/php/nav.php'); ?>

			<div id="menu-toggle" class="hide-on-medium-large">
				<?php include('assets/svgs/hamburger.php'); ?>
			</div>
		</header>