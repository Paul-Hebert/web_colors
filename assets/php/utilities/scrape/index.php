<?php
	//$top_sites = get_alexa_top_sites();
	$top_sites = ['http://paulhebertdesigns.com'];

	foreach($top_sites as $top_site){
		$text = file_get_contents($top_site);

		foreach(get_external_stylesheets($top_site) as $styles ){
			$text .= file_get_contents($top_site . '/' . $styles);
		}

		$text =  htmlspecialchars($text);

		preg_match_all('/#(?:[0-9a-fA-F]{6})|#(?:[0-9a-fA-F]{3})/', $text, $matches);

		$colors = array_map('array_unique', $matches);

		print_r($colors);	

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