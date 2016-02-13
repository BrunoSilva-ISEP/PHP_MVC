<?php

/**
* 
*/
class Map extends Object
{
	public static $path = null;

	public static function get($route, $path) {
		self::$path = $path;
		Sammy::process($route, 'GET');
	}

	public static function post($route, $path) {
		self::$path = $path;
		Sammy::process($route, 'POST');
	}

	public static function put($route, $path) {
		self::$path = $path;
		Sammy::process($route, 'PUT');
	}

	public static function delete($route, $path) {
		self::$path = $path;
		Sammy::process($route, 'DELETE');
	}

	public static function ajax($route, $path) {
		self::$path = $path;
		Sammy::process($route, 'XMLHttpRequest');
	}
	public static function dispatch($format)
	{
		//DD::stop();
		$path = explode('#', self::$path);
		$controller = $path[0];
		$action = $path[1];

		$class_name = ucfirst($controller).'Controller';
		// include  the app controller
		self::load_controller('app');
		
		// include  the matching controller
		self::load_controller($controller);

		if(class_exists($class_name))
		{
			$tmp_class = new $class_name();

			// runs  the matching action
			if(is_callable(array($tmp_class,$action)))
			{
				$tmp_class->$action();
			}else
			die('The action <strong>' . $action . '</strong> could not be called from controller ' ); 
		}else{
			die('The class <strong>' . $class_name . '</strong> could not be found in ' ); 
		}
		// include view
		self::load_view($controller,$action,$format);
	}

	public static function load_controller($name)
	{
		$controller_path = APP_PATH. 'controllers/' .$name . '_controller.php';
		if(file_exists($controller_path))
			include $controller_path;
		else
			die('The controller <strong>' . $name . '</strong> could not be found in ' . $controller_path); 
	}

	public static function load_view($controller, $action, $format)
	{
		$view_path = APP_PATH. 'views/' . $controller .'/'. $action .'.'. $format . '.php';
		unset($controller,$action,$format);

		foreach (self::$user_vars as $var => $value) {
			$$var = $value;
		}
		if(file_exists($view_path))
			include $view_path;
	}
}