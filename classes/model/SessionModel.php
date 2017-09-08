<?php
	
	include_once 'UserModel.php';

	class SessionModel{

		private $user;		

		function __construct(){

		}

		//getters
		function getUser(){
			return $this->user;
		}

		//setters
		function setUser($user){
			$this->user = $user;
		}

	}

?>