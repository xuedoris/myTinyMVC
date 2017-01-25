<?php
	/*
	* The View class is only to load data and all the pages.
	*/
	class View {
		function renderWithLayout($controller, $action){

			// Excute the specific action from the pointed Controller. Here is always PhoneBookController.
			$file = new $controller();
			// Check if the function exists.
			if (method_exists($file, $action)) {
				$file->{$action}();
				// Load data.
				if(is_array($file->getData()))
					extract($file->getData());
				include(BASE_URL.'\App\view\\'.$file->getView().'.php');
			}
			else {
				Helper::displayMessage('Methods not found');
			}
		}
	}
