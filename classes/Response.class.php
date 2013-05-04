<?php

class Response {

	// Default response type
	public static $type = 'json';

	public static function format($string) {

		// Error if response is null
		if(is_null($string)) {
			$string = array("status" => "error");
		}

		$json = json_encode($string);

        header('Content-Length: '.strlen($json));
        header('Content-Type: application/json');

		return $json;
	}

}