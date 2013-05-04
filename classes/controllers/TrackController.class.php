<?php

class TrackController {

	public function get($request) {

		$query 		= "SELECT * FROM  `tracks` WHERE  `track_id` = :id LIMIT 1";
		$track_id 	= $request->parameters['track_id'];

		if(isset($track_id) && is_numeric($track_id)) {

			$pdo = Database::getPDO();
			$pdoStatement = $pdo->prepare($query);

			if($pdoStatement->execute(array(':id' => $track_id))) {

				$results = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);

				if(count($results) != 0) {
					return $results[0];
				}

			}
			
		}

		return;

	}

}