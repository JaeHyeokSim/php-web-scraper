<?php

class Scraper {

	public function fetch($url) {

		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		$html = curl_exec($ch);

		curl_close($ch);

		return $html;
	}
}