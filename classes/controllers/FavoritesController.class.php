<?php

class FavoritesController {

	/*
	 * Get user's favorites
	 *
	 * @param (Request) Contains all request parameters
	 * @return (Array) Returns all favorites
	 */

	public function get($request) {

		$query 		= "SELECT `tracks`.`track_id`, `tracks`.`title`, `tracks`.`duration`  FROM `favorites` LEFT JOIN (`users`, `tracks`) ON (`favorites`.`user` = `users`.`user_id` AND `favorites`.`track` = `tracks`.`track_id`) WHERE `users`.`user_id` = :id";
		$user_id 	= $request->parameters['user_id'];

		if(isset($user_id) && is_numeric($user_id)) {

			$user_id 	= intval($user_id);

			$pdo = Database::getPDO();
			$pdoStatement = $pdo->prepare($query);

			if($pdoStatement->execute(array(':id' => $user_id))) {
				return $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
			}

		}

		return;

	}

}