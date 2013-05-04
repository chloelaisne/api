<?php

class Request {

	private $verb;
	private $url;
	private $accept;
	private $payload;
	private $curlHandle;

	public function __construct($verb, $url, $payload = null, $accept = 'application/json') {

		$this->verb 	= $verb;
		$this->url 		= $url;
		$this->payload 	= $payload;
		$this->accept 	= $accept;

	}

	public function execute() {

		$this->curlHandle = curl_init();
		curl_setopt($this->curlHandle, CURLOPT_URL, $this->url);
		curl_setopt($this->curlHandle, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
		curl_setopt($this->curlHandle, CURLOPT_HTTPHEADER, array('Accept: '.$this->accept));
		curl_setopt($this->curlHandle, CURLOPT_TIMEOUT, 5);

		switch (strtolower($this->verb)) {
			
			case 'delete':
				$this->executeDelete();
				break;

			case 'post':
				$this->executePost();
				break;

			case 'get':
			default:
				$this->executeGet();
				break;

		}

	}

	private function executeGet() {
		curl_setopt($this->curlHandle, CURLOPT_HTTPGET, true);
		$this->response = curl_exec($this->curlHandle);
		curl_close($this->curlHandle);
		echo $this->response;
	}

	private function executePost() {
		curl_setopt($this->curlHandle, CURLOPT_POST, true);
		curl_setopt($this->curlHandle, CURLOPT_POSTFIELDS, $this->payload);
	}

	private function executeDelete() {
	}

}