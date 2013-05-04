<?php

class Database {
	
	private static $dbname 		= 'deezer';
	private static $host 		= '127.0.0.1';
	private static $dns 		= null;
	private static $username 	= 'root';
	private static $password 	= 'password';
	private static $pdo 		= null;

	public function getPDO() {

		self::$dns = 'mysql:dbname='.self::$dbname.';host='.self::$host;
		self::$pdo = new PDO(self::$dns, self::$username, self::$password);

		return self::$pdo;

	}

}