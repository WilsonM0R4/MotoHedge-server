<?php

	class DBConnection {

		private $server;
		private $username;
		private $password;
		private $db;
		private $connection;

		function __construct(){


			//$this->server = "localhost";
			//$this->username = "id1553599_motohedge_admin";
			//$this->password = "motohedge2017";
			//$this->db = "id1553599_motohedgedb";

			$this->server = "localhost";
			$this->username = "root";
			$this->password = "";
			$this->db = "motohedgedb";
		}

		function getConnection(){
			$this->connection = new mysqli($this->server, $this->username, $this->password, $this->db);

			if($this->connection->connect_error){
				die("Connection failed: ".$this->connection->connect_error);
				return null;
			}

			//echo 'success connection';

			return $this->connection;
		}	

	}

?>
