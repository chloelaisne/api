<?php

class UserController {

	public function get($request) {

		$query 		= "SELECT * FROM  `users` WHERE  `user_id` = :id LIMIT 1";
		$user_id 	= $request->parameters['user_id'];

		if(isset($user_id) && is_numeric($user_id)) {

			$pdo = Database::getPDO();
			$pdoStatement = $pdo->prepare($query);
			
			if($pdoStatement->execute(array(':id' => $user_id))) {

				$results = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);

				if(count($results) != 0) {
					return $results[0];
				}

			}
			
		}	

		return;

	}

}