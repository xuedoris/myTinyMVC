<?php
	/*
	* This is the index.php that will be called everytime the page refreshes.
	* bootstrap.php will be always required along.
	*/
	session_start();
	define('BASE_URL', dirname(realpath(__FILE__)));
	require('Lib/bootstrap.php');

