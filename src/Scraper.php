<?php

class Scraper {

	private $httpClient;
	private $cache;

	public function __construct($httpClient, $cache = null) {
		$this->httpClient = $httpClient;
		$this->cache = $cache;
	}

	public function fetch($url, $ttl = 60) {

		if ($this->cache) {
			return $this->cache->remember($url, $ttl, function() use ($url) {
				return $this->httpClient->get($url);
			});
		}

		return $this->httpClient->get($url);
	}
}