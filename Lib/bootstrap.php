<?php
	/*
	* bootstrap.php is to bootstrap the application.
	* It includes a __autoload() function that specify which file should be included in index.php.
	* It calls a Router object for redirecting.
	*/

	/* autoload() function will include the file whenever the object with the same name as the file is created.
	* Then we can use the functions from the file.
	*/
	function __autoload($classname){
		$error = true;
		// Possible paths for redirecting to the destination files.ex. Router.php
		$paths = Array(
			'Lib' => BASE_URL . '\Lib\\',
			'controller' => BASE_URL . '\App\controller\\',
			'model' => BASE_URL . '\App\model\\',
		);
		$filename = $classname. '.php';
		foreach($paths as $path){
			$file = $path.$filename;
			if(file_exists($file)){
				include_once($file);
				$error = false;
			}
		}
		if ($error)
			Helper::displayMessage('Class dose not exist!!!');
	}

	// Obtain the path after '/myTinyMVC/index.php/'. For instance, $url can be 'PhoneBook/search'
	$url = substr($_SERVER['REQUEST_URI'], strlen('/myTinyMVC/index.php/'));
	$myRouter = new Router($url);
	// Show the webpage.
	View::renderWithLayout($myRouter->getController(), $myRouter->getAction());

