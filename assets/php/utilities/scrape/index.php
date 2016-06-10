<?php
	//Begin Regex
	$GLOBALS['colorRegex'] = '/';

	// 6-Digit Hexadecimal
	$GLOBALS['colorRegex'] .= '#(?:[0-9a-fA-F]{6})';

	// 3-Digit Hexadecimal
	$GLOBALS['colorRegex'] .= '|#(?:[0-9a-fA-F]{3})';

	// Named Colors
	$GLOBALS['colorRegex'] .= '|' . file_get_contents('color_names.php');

	// RGB + RGBA
    $GLOBALS['colorRegex'] .= '|^rgba?\((\d+),\s*(\d+),\s*(\d+)(?:,\s*(\d+(?:\.\d+)?))?\)$';
	
	// RGBA and HSLA
	$GLOBALS['colorRegex'] .= '|((rgba|hsla)\(\d{1,3}%?(,\s?\d{1,3}%?){2},\s?(1|0|0?\.\d+)\)';
	
	// RGB and HSL
	$GLOBALS['colorRegex'] .= '|(rgb|hsl)\(\d{1,3}%?(,\s?\d{1,3}%?){2}\))';

	// Finish Regex. Make case insensitive
	$GLOBALS['colorRegex'] .= '/i';

	$top_sites = get_alexa_top_sites();
	//$top_sites = ['paulhebertdesigns.com'];

	foreach($top_sites as $top_site){
		echo '<h2>' . $top_site . '</h2>';

		$top_site = 'http://' . $top_site;

		$text = file_get_contents($top_site);

		foreach(get_external_stylesheets($top_site) as $styles ){
			if (strpos($styles, '//') === false) {
				$text .= file_get_contents($top_site . '/' . $styles);
			} elseif(strpos($styles, 'http:') === false){
				$text .= file_get_contents('http:' . $top_site . '/' . $styles);				
			} else{
				$text .= file_get_contents($styles);				
			}
		}

		// Uncomment for REGEX testing.
		// $text = '#333 #333333 green rgb(1,255,33) rgb(1, 255, 33) rgba(1,255,33,.55) rgb(1, 255, 33, .55) hsl(210,50%,50%) hsl(210, 50%, 50%) hsla(210,50%,50%,.5) hsla(210, 50%, 50%, .5)';

		$text =  htmlspecialchars($text);

		preg_match_all($GLOBALS['colorRegex'], $text, $matches);

		$colors = array_map('array_unique', $matches);

		print_r($colors[0]);	

		echo '<hr>';
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
					array_push($sites, $link->nodeValue);
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

	function get_internal_stylesheets($site){
		$site_html = file_get_contents($site);

		$site_dom = new DOMDocument();

		libxml_use_internal_errors(TRUE); //disable libxml errors

		$site_dom->loadHTML($site_html);

		libxml_clear_errors(); //remove errors for yucky html

		$site_xpath = new DOMXPath($site_dom);

		$links = $site_xpath->query('//style');

		$stylesheets = [];

		if($links->length > 0){
			foreach($links as $link){
				array_push($stylesheets, $link->nodeValue);
			}
		}

		return $stylesheets;
	}
?>