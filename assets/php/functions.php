<?php
	function cleanURL($url){
		$url = explode('//', $url);
		$url = explode('www.', $url[1])[1];

		return $url;
	}
?>