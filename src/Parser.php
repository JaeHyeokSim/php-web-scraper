<?php

class Parser {

	private $dom;
	private $xpath;

	public function load($html) {

		$this->dom = new DOMDocument();

		libxml_use_internal_errors(true);
		$this->dom->loadHTML($html);
		libxml_clear_errors();

		$this->xpath = new DOMXPath($this->dom);
	}

	public function query($expression) {

		return $this->xpath->query($expression);
	}
}