<?php

class Request {

	public $parameters;
	public $verb;

	public function __construct($verb) {

		$this->verb = $verb;

		switch (strtolower($this->verb)) {
			
			case 'delete':
				$this->deleteParameters();
				break;

			case 'post':
				$this->postParameters();
				break;

			case 'get':
			default:
				$this->getParameters();
				break;

		}

	}

	private function deleteParameters() {

		parse_str(file_get_contents('php://input'), $parameters);
		$this->escape($parameters);
		
	}

	private function postParameters() {

		$this->escape($_POST);

	}

	public function getParameters() {

		$this->escape($_GET);

	}

	/*
	 * Escape HTML special charactets
	 */
	private function escape($parameters) {

		foreach ($parameters as $key => $value) {
			$this->parameters[$key] = htmlspecialchars($value);
		}

		return $parameters;

	}

}