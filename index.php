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

// XML format specified in the request
/*if(isset($_GET['output']) && $_GET['output'] == 'xml') {
	Response::$type = 'xml';
}*/

/*
 * Controller
 */

// Get GET/POST/DELETE request parameters
$request = new Request($_SERVER['REQUEST_METHOD']);

// If route hasn't been specified above
if(!Router::route($request, $_SERVER['REQUEST_URI'])) {

	// == FAIL == //
	echo Response::format(null);

}
// If route hasn been specified above
else {

	// Create new controller for route
	$controller = new Router::$controller();

	// Controller method does exist for request protocole
	if(method_exists($controller, $_SERVER['REQUEST_METHOD'])) {
		$response = $controller->$_SERVER['REQUEST_METHOD']($request);
	}
	// Controller method does not exist for request protocole
	else {
		$response = null; // 404 ERROR
	}

	// == SUCCESS == //
	echo Response::format($response);

}