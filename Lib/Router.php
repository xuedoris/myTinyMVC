<?php
	/*
	* Router class is to specify which controller to use.
	* And indicate that within the controller which function(action) to use.
	*/
	class Router{
		private $controller;
		private $action;

		function __construct($url){

				$temp = explode('/',$url);
				// Default controller and its action. Showing homepage.
				$this->controller = 'PhoneBook';
				$this->action = 'home';
				if(isset($temp[0])&& $temp[0] != '')
					$this->controller = $temp[0];
					if(isset($temp[1])&& $temp[1] != '')
					$this->action = $temp[1];
		}
		// Getters
		function getController(){
			return $this->controller.'Controller';
		}
		function getAction(){
			return $this->action;
		}
	}
