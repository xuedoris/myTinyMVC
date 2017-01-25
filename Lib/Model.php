<?php
	/*
	* This is a Model for mulnipulate database with basic functions which should be generic
	* using sql queries to select or modify data.
	* And since Phonebook is a small application. There is no sub-model for more complex functions.
	*/
	class Model extends PDO{
		private $conn;
		function __construct($DBname){
			// If there is no connection, set up new connection.
			if(!$this->conn){
				try {
					$this->conn = new PDO("mysql:host=localhost; dbname={$DBname}", 'root', '');
					$this->conn->setAttribute(PDO::ATTR_AUTOCOMMIT,FALSE);
				}
				catch (PDOException $e) {
					Helper::displayMessage('Connection failed: ' . $e->getMessage());
				}
			}
		}
		/*
		* This is the SELECT function to select table content by SQL query $sql.
		* The order of showing the content can be specified in second parameter $order.
		*/
		function selectBySql($sql, $order = null){
			try {
				if($order !== null)
					$statement = $this->conn->query($sql. ' order by '.$order);
				else $statement = $this->conn->query($sql);
				return $obj = $statement->fetchAll(PDO::FETCH_OBJ);
			}
			catch (PDOException $e) {
				Helper::displayMessage($e->getMessage());
			}
		}
		/*
		* This is the EXCUTE function to excute SQL query $sql.
		* For performing operations such as INSERT and UPDATE.
		*/
		function excuteBySql($sql){
			$con = mysql_connect("localhost","root","");
			if (!$con) {
				Helper::displayMessage('Could not connect: ' . mysql_error());
				die();
			}

			mysql_select_db("phonebook", $con);
			mysql_query($sql);
		}
	}

