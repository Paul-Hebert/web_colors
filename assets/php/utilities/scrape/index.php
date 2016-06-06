<?php
	$top_sites = get_alexa_top_sites();

	foreach($top_sites as $top_site){
		echo '<h1><a href="' . 'http://' . $top_site . '" target="_BLANK">' .$top_site . '</a></h1>';
		echo '<h3>External Stylesheets:</h3>';
		print_r( get_external_stylesheets( 'http://' . $top_site ) );
		echo '<h3>Internal Stylesheets:</h3>';		
		print_r( get_internal_stylesheets( 'http://' . $top_site ) );
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