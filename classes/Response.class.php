<?php

class Response {

	public static $type = 'json';

	public static function format($string) {

		if(is_null($string)) {
			$string = array("status" => "error");
		}

		$json = json_encode($string);

        header('Content-Length: '.strlen($json));
        header('Content-Type: application/json');

		return $json;
	}

}