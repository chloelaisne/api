<?php

class FavoriteController {

	public function post($request) {

		$query 		= "INSERT INTO  `deezer`.`favorites` (`favorite_id`, `track`, `user`) VALUES (NULL, :track_id, :user_id)";
		$track_id 	= $request->parameters['track_id'];
		$user_id 	= $request->parameters['user_id'];

		if(isset($track_id) && is_numeric($track_id) && isset($track_id) && is_numeric($user_id)) {

			$track_id 	= intval($track_id);
			$user_id 	= intval($user_id);

			$pdo = Database::getPDO();
			$pdoStatement = $pdo->prepare($query);
			
			if($pdoStatement->execute(array(':track_id' => $track_id, ':user_id' => $user_id))) {
				return array("status" => "success", "id" => $pdo->lastInsertId('favorite_id'));
			}

			return null;

		}

		return null;

	}

	public function delete($request) {

		$query 			= "DELETE FROM `deezer`.`favorites` WHERE `favorites`.`favorite_id` = :id";
		$favorite_id 	= $request->parameters['favorite_id'];
		$user_id 		= $request->parameters['user_id'];

		if(isset($favorite_id) && is_numeric($favorite_id) && isset($user_id) && is_numeric($user_id)) {

		}

		return null;
	}

}