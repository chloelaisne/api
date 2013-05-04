<?php

class Track {

	protected $track_id;
	protected $title;
	protected $duration;

	public function __construct() {

	}

	public function __get($attribute) {
		return $this->$attribute;
	}

	public function __set($attribute, $value) {
		$this->$attribute = $value;
	}
	
}