<?php

class FavoriteController {

	public function post($request) {

		$query 		= "INSERT INTO  `deezer`.`favorites` (`favorite_id`, `track`, `user`) VALUES (NULL, :track_id, :user_id)";
		$track_id 	= $request->parameters['track_id'];
		$user_id 	= $request->parameters['user_id'];

		if(isset($track_id) && is_numeric($track_id) && isset($user_id) && is_numeric($user_id)) {

			$track_id 	= intval($track_id);
			$user_id 	= intval($user_id);

			$pdo = Database::getPDO();
			$pdoStatement = $pdo->prepare($query);
			
			if($pdoStatement->execute(array(':track_id' => $track_id, ':user_id' => $user_id))) {
				return array("status" => "success", "id" => $pdo->lastInsertId('favorite_id'));
			}

		}

		return;

	}

	public function delete($request) {

		$query 		= "DELETE FROM `deezer`.`favorites` WHERE `favorites`.`track` = :track_id AND `favorites`.`user` = :user_id LIMIT 1";
		$track_id 	= $request->parameters['track_id'];
		$user_id 	= $request->parameters['user_id'];

		if(isset($track_id) && is_numeric($track_id) && isset($user_id) && is_numeric($user_id)) {

			$track_id 	= intval($track_id);
			$user_id 	= intval($user_id);

			$pdo = Database::getPDO();
			$pdoStatement = $pdo->prepare($query);
			
			if($pdoStatement->execute(array(':track_id' => $track_id, ':user_id' => $user_id))) {
				if($pdoStatement->rowCount() == 1) {
					return array("status" => "success");
				}
			}

		}

		return;
	}

}