<?php

class Scraper
{

    private $httpClient;
    private $cache;

    private $rateLimiter;

    public function __construct($httpClient, $cache = null, $rateLimiter = null)
    {
        $this->httpClient = $httpClient;
        $this->cache = $cache;
        $this->rateLimiter = $rateLimiter;
    }

    public function fetch($url, $ttl = 60)
    {

        if ($this->rateLimiter) {
            $this->rateLimiter->throttle();
        }

        if ($this->cache) {
            return $this->cache->remember($url, $ttl, function () use ($url) {
                return $this->httpClient->get($url);
            });
        }

        return $this->httpClient->get($url);
    }

    public function fetchWithRetry($url, $retry = 3)
    {

        $attempt = 0;

        while ($attempt < $retry) {
            try {
                return $this->fetch($url);
            } catch (Exception $e) {
                $attempt++;
                usleep(200000); // 0.2초 대기
            }
        }

        throw new Exception("Failed to fetch after {$retry} attempts");
    }
}
