<?php

/*
 * Autoload classes
 */

spl_autoload_register(function ($classname) {

	$directories = array(
		'classes/',
		'classes/controllers/',
		'classes/models/',
	);

	foreach ($directories as $directory) {
		
		$file = $directory.$classname.'.class.php';

		if(file_exists($file)) {

			require_once($file);

			if(!class_exists($classname)) {
				throw new Exception("Unable to find class $classname");
			} else {
				return true;
			}

		}

	}

	return false;
	
});

/*
 * Routes
 */

Router::$routes = array(
	'/track/:track_id' 					=> 'Track', 		// Get track information from ID
	'/user/:user_id' 					=> 'User',			// Get user information from ID
	'/user/:user_id/favorites'			=> 'Favorites', 	// Get favorite tracks from user
	'/user/:user_id/favorites/track' 	=> 'Favorite',		// Post track to favorites
	'/user/:user_id/favorites/track' 	=> 'Favorite',		// Delete track from favorites
);

/*
 * Response format
 */

/*if(isset($_GET['output']) && $_GET['output'] == 'xml') {
	Response::$type = 'xml';
}*/

/*
 * Controller
 */

$request = new Request($_SERVER['REQUEST_METHOD']);

if(!Router::route($request, $_SERVER['REQUEST_URI'])) {

	echo Response::format(null);

} else {

	$controller = new Router::$controller();

	if(method_exists($controller, $_SERVER['REQUEST_METHOD'])) {
		$response = $controller->$_SERVER['REQUEST_METHOD']($request);
	} else {
		$response = null; // 404 ERROR
	}

	echo Response::format($response);

}