<?php

require_once "../src/Scraper.php";

$httpClient = new HttpClient();
$cache = new MemoryCache();
$rateLimiter = new RateLimiter(1); // 초당 1회

$scraper = new Scraper($httpClient, $cache, $rateLimiter);

$html = $scraper->fetchWithRetry("https://example.com");

echo $html;