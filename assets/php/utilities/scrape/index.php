<?php
	//Begin Regex
	$GLOBALS['colorRegex'] = '/';

	// 6-Digit Hexadecimal
	$GLOBALS['colorRegex'] .= '#(?:[0-9a-fA-F]{6})';

	// 3-Digit Hexadecimal
	$GLOBALS['colorRegex'] .= '|#(?:[0-9a-fA-F]{3})';

	// Named Colors
	$GLOBALS['colorRegex'] .= '|' . file_get_contents('color_names.php');
	
	// RGBA - isn't working with spaces before the decimal
	$GLOBALS['colorRegex'] .= '|(rgba)\(\d{1,3}%?(,\s?\d{1,3}%?){2},\s?(1|0|0?\.\d+)\)';
	
	// HSLA
	$GLOBALS['colorRegex'] .= '|(hsla)\(\d{1,3}%?(,\s?\d{1,3}%?){2},\s?(1|0|0?\.\d+)\)';
	
	// RGB
	$GLOBALS['colorRegex'] .= '|(rgb)\(\d{1,3}%?(,\s?\d{1,3}%?){2}\)';
	
	// HSL
	$GLOBALS['colorRegex'] .= '|(hsl)\(\d{1,3}%?(,\s?\d{1,3}%?){2}\)';

	// Finish Regex. Make case insensitive
	$GLOBALS['colorRegex'] .= '/i';

	// Check for GET request
	if ( isset($_GET['url']) ){
		$top_sites = [];
		array_push($top_sites, $_GET['url']);
	} else{
		$top_sites = get_alexa_top_sites();

		// set the default timezone to use.
		date_default_timezone_set('UTC');

		$date_time = date(DATE_ATOM); 

		$csv = fopen("../../../data/" . $date_time . ".csv", "w");
	}

	$count = 0;

	foreach($top_sites as $top_site){
		if($count < 10){
			echo '<h1>' . $top_site . '</h1>';

			$text = '';

			$dom = new DOMDocument();
			$dom->loadHTMLFile($top_site);

			foreach($dom->getElementsByTagName('*') as $element ){
				if( $element->hasAttributes() ) {
					foreach ($element->attributes as $attr) {
						if ($attr->nodeName == 'style'){
					    	$text .= $attr->nodeValue;
					    }
					}
				}
			}

			foreach($dom->getElementsByTagName('style') as $element ){
				$text .= $element->nodeValue;
			}

			foreach(get_external_stylesheets($top_site) as $styles ){
				if (strpos($styles, '//') === false) {
					$text .= file_get_contents($top_site . '/' . $styles);
				} elseif(strpos($styles, 'http') === false){
					$text .= file_get_contents('http:' . $styles);
				} else{
					$text .= file_get_contents($styles);
				}
			}

			// Uncomment for REGEX testing
			//$text = '#333 #333333 green important rgb(1,255,33) rgb(1, 255, 33) rgba(1,255,33,.55) rgb(1, 255, 33, .55) hsl(210,50%,50%) hsl(210, 50%, 50%) hsla(210,50%,50%,.5) hsla(210, 50%, 50%, .5)';

			$text =  htmlspecialchars($text, ENT_COMPAT|ENT_SUBSTITUTE, 'UTF-8');
			
			preg_match_all($GLOBALS['colorRegex'], $text, $matches);

			$colors = array_map('array_unique', $matches);

			if ( isset($_GET['url']) ){
				echo '<div class="block chart"><aside class="left"><label>' . $top_site . '</label></aside>';
					foreach($colors[0] as $color){
						echo '<span style="background:' . $color . '" class="color listing"><span>' . $color . '</span></span>';
					}	
				echo '</div>';
			} else{
				fwrite($csv, $top_site);

				foreach($colors[0] as $color){
					fwrite($csv, '|' . preg_replace('(\s|:|;)', '', $color));
				}	

				fwrite($csv,"\r\n");		
			}

			$count++;
		}
	}

	if (! isset($_GET['url']) ){
		fclose($csv);
	}

	function get_alexa_top_sites(){
		$alexa_html = file_get_contents('http://www.alexa.com/topsites');

		$alexa_dom = new DOMDocument();

		libxml_use_internal_errors(TRUE); //disable libxml errors

		$alexa_dom->loadHTML($alexa_html);

		libxml_clear_errors(); //remove errors for yucky html

		$alexa_xpath = new DOMXPath($alexa_dom);

		$links = $alexa_xpath->query('//li[@class="site-listing"]//a');

		$sites = [];

		if($links->length > 0){
			foreach($links as $link){
				if($link->nodeValue != 'More'){
					$dom = new DOMDocument();
					$dom->loadHTMLFile('http://www.' . $link->nodeValue);

					if( $dom->getElementsByTagName('*')['length'] == 0){
						array_push($sites,  'https://www.' . $link->nodeValue);
					} else{
						array_push($sites,  'http://www.' . $link->nodeValue);
					}
				}
			}
		}

		return $sites;
	}

	function get_external_stylesheets($site){
		$site_html = file_get_contents($site);

		$site_dom = new DOMDocument();

		libxml_use_internal_errors(TRUE); //disable libxml errors

		$site_dom->loadHTML($site_html);

		libxml_clear_errors(); //remove errors for yucky html

		$site_xpath = new DOMXPath($site_dom);

		$links = $site_xpath->query('//head//link');

		$stylesheets = [];

		if($links->length > 0){
			foreach($links as $link){
				if (strpos($link->getAttribute('href'), '.css') !== false) {
					$url = $link->getAttribute('href');

					if (strpos($url, 'http') !== false) {
					    $url .= 'http:';
					}

					array_push($stylesheets, $link->getAttribute('href'));
				}
			}
		}

		return $stylesheets;
	}
?>