<?php

require_once __DIR__ . '/../src/Scraper.php';
require_once __DIR__ . '/../src/Parser.php';

require_once __DIR__ . '/../../php-http-client/src/HttpClient.php';
require_once __DIR__ . '/../../php-cache-library/src/MemoryCache.php';
require_once __DIR__ . '/../../php-rate-limiter/src/RateLimiter.php';

$httpClient = new HttpClient();
$cache = new MemoryCache();
$rateLimiter = new RateLimiter();

$scraper = new Scraper($httpClient, $cache, $rateLimiter);

$html = $scraper->fetchWithRetry("https://example.com");

echo $html;