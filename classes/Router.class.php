<?php

class Router {

	public static $routes;
	public static $url;
	public static $controller;

	/*
	 * Attribute controller to route
	 *
	 * @param string 	URL request on API
	 * @return boolean 	True if route does exist, False if route does not exist
	 */

	public static function route($request, $url) {

		self::$url = $url;

		foreach (self::$routes as $route => $controller) {
			
			$regExp = $route;

			$regExp = preg_replace('/\//', '\/', $regExp);
			$regExp = preg_replace('/:\w+/', '([0-9]*)', $regExp);
			$regExp = '/^'.$regExp.'$/';

			// Get parameter values
			if(preg_match($regExp, self::$url, $values)) {

				self::$controller = $controller.'Controller';

				// Get parameter names
				if(preg_match('/:(\w+)/', $route, $indexes)) {

					for ($i=1; $i<count($indexes); $i++) {
						// Set $_GET global
						$_GET[$indexes[$i]] = $values[$i];
					}

					$request->getParameters();
				}

				return true;
			}

		}

		return false;
		
	}

}