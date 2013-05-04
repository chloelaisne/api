<?php

class FavoriteController {

	/*
	 * Add track to user's favorites
	 *
	 * @param (Request) Contains all request parameters
	 * @return (Array) Returns row ID inserted on success or NULL on failure
	 */

	public function post($request) {

		$query 		= "INSERT INTO  `deezer`.`favorites` (`favorite_id`, `track`, `user`) VALUES (NULL, :track_id, :user_id)";
		$track_id 	= $request->parameters['track_id']; 	// From POST
		$user_id 	= $request->parameters['user_id']; 		// From GET

		// Variable type check
		if(isset($track_id) && is_numeric($track_id) && isset($user_id) && is_numeric($user_id)) {

			$track_id 	= intval($track_id);
			$user_id 	= intval($user_id);

			$pdo = Database::getPDO();
			$pdoStatement = $pdo->prepare($query);
			
			// Execute query
			if($pdoStatement->execute(array(':track_id' => $track_id, ':user_id' => $user_id))) {
				// == SUCCEED == //
				return array("status" => "success", "id" => $pdo->lastInsertId('favorite_id'));
			}

		}

		// == FAIL == //
		return;

	}

	/*
	 * Remove track from user's favorites
	 *
	 * @param (Request) Contains all request parameters
	 * @return (Array) Returns status on success or NULL on failure
	 */

	public function delete($request) {

		$query 		= "DELETE FROM `deezer`.`favorites` WHERE `favorites`.`track` = :track_id AND `favorites`.`user` = :user_id LIMIT 1";
		$track_id 	= $request->parameters['track_id'];
		$user_id 	= $request->parameters['user_id'];

		// Variable type check
		if(isset($track_id) && is_numeric($track_id) && isset($user_id) && is_numeric($user_id)) {

			$track_id 	= intval($track_id);
			$user_id 	= intval($user_id);

			$pdo = Database::getPDO();
			$pdoStatement = $pdo->prepare($query);
			
			// Execute query
			if($pdoStatement->execute(array(':track_id' => $track_id, ':user_id' => $user_id))) {
				if($pdoStatement->rowCount() == 1) {
					// == SUCCEED == //
					return array("status" => "success");
				}
			}

		}

		// == FAIL == //
		return;
	}

}