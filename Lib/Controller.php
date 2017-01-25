<?php
	/*
	* This is the abstract Controller class that contains most basic functions 
	* such as setters and getters. More concrete functions will be implemented
	* in sub-Controllers such as PhoneBookController.
	*/

	abstract class Controller{
		private $view;
		private $data;

		function __construct(){
			$data = array();
		}

		// Getters
		function getView(){
			return $this->view;
		}
		function getData(){
			return $this->data;
		}

		// Setters
		function setView($view){
			$this->view = $view;
		}
		function setData($data){
			$this->data = $data;
		}
	}
?>
