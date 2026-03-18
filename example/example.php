<?php

require_once "../src/Scraper.php";
require_once "../src/Parser.php";

$scraper = new Scraper();
$html = $scraper->fetch("https://example.com");

$parser = new Parser();
$parser->load($html);

$nodes = $parser->query("//h1");

foreach ($nodes as $node) {
	echo $node->nodeValue . "\n";
}