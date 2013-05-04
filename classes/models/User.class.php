<?php

class User {

	protected $user_id;
	protected $name;
	protected $email;

	public function __construct() {

	}

	public function __get($attribute) {
		return $this->$attribute;
	}

	public function __set($attribute, $value) {
		$this->$attribute = $value;
	}

	private function isEmail($string){
		return filter_var($string, FILTER_VALIDATE_EMAIL);
	}
	
}