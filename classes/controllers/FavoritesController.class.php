<?php

class FavoritesController {

	public function get($request) {

		$query 		= "SELECT `tracks`.`track_id`, `tracks`.`title`, `tracks`.`duration`  FROM `favorites` LEFT JOIN (`users`, `tracks`) ON (`favorites`.`user` = `users`.`user_id` AND `favorites`.`track` = `tracks`.`track_id`) WHERE `users`.`user_id` = :id";
		$user_id 	= $request->parameters['user_id'];

		$pdo = Database::getPDO();
		$pdoStatement = $pdo->prepare($query);
		$pdoStatement->execute(array(':id' => $user_id));
		$results = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);

		if(count($results) == 0) {
			return;
		}

		return $results;

	}

}