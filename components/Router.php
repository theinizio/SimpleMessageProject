<?php

class Router
{

	private $routes;

	public function __construct()
	{
		$routesPath = ROOT.'/config/routes.php';
		$this->routes = include($routesPath);
	}

// Return type

	private function getURI()
	{
		if (!empty($_SERVER['REQUEST_URI'])) {
		return trim($_SERVER['REQUEST_URI'], '/');
		}
	}

	public function run()
	{
		
		$uri = $this->getURI();
		$allPath = explode("?",$uri);
		$uri = $allPath[0];
		if(strlen($uri)>4) 
			$uri = str_replace("smp/", "", $uri); //remove subfolder name from path
			//$uri = substr($uri, 4, strlen($uri));
		if($uri=='smp')$uri='';
		
		//var_dump($uri);
		foreach ($this->routes as $uriPattern => $path) {

			if(preg_match("~$uriPattern~", $uri)) {
						
				

				// Получаем внутренний путь из внешнего согласно правилу.

				$internalRoute = preg_replace("~$uriPattern~", $path, $uri, 1);

				

				$segments = explode('/', $internalRoute);
				//array_shift($segments);
				
				$controllerName = array_shift($segments).'Controller';
				$controllerName = ucfirst($controllerName);
				//var_dump($controllerName);

				$actionName = 'action'.ucfirst(array_shift($segments));

				$parameters = $segments;
				//var_dump($parameters);

				$controllerFile = ROOT . '/controllers/' .$controllerName. '.php';
				if (file_exists($controllerFile)) {
					include_once($controllerFile);
				}
				
				$controllerObject = new $controllerName;
				
				$result = call_user_func_array(array($controllerObject, $actionName), $parameters);
				
				if ($result != null) {
					break;
				}
			}

		}
	}
}
