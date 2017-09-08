<?php
	
	include_once './classes/Constants.php';
	include_once './classes/Commons.php';

	class UserModel{

		private $docType = "";
		private $docNumber = "";
		private $userName = "";
		private $userLastname = "";
		private $userEmail = "";
		private $cellphone = "";
		private $telephone = "";
		private $sessionState = "";
		private $password = "";

		function __construct(){

		}

		function getPassword(){
			return $this->password;
		}
		function setPassword($pass){
			$this->password = $pass;
		}

		//getters                                                                                                                
		function getDocType(){
			return $this->docType;
		}

		function getDocNumber(){
			return $this->docNumber;
		}

		function getUserName(){
			return $this->userName;
		}

		function getUserLastname(){
			return $this->userLastname;
		}

		function getUserEmail(){
			return $this->userEmail;
		}

		function getCellphone(){
			return $this->cellphone;
		}

		function getTelephone(){
			return $this->telephone;
		}

		function getSessionState(){
			return $this->sessionState;
		}


		//setters
		function setDocType($docType){
			$this->docType = $docType;
		}

		function setDocNumber($docNumber){
			$this->docNumber = $docNumber;
		}

		function setUserName($userName){
			$this->userName = $userName;
		}

		function setUserLastname($userLastname){
			$this->userLastname = $userLastname;
		}

		function setUserEmail($userEmail){
			$this->userEmail = $userEmail;
		}

		function setCellphone($cellphone){
			$this->cellphone = $cellphone;
		}

		function setTelephone($telephone){
			$this->telephone = $telephone;
		}

		function setSessionState($sessionState){
			$this->sessionState = $sessionState;
		}

		function map($arrayData){

			$userLocalKeys = Commons::extractArrayParams(Constants::getUserKeys());
			$arrayDataKeys = Commons::extractArrayKeys($arrayData[0]);

			/*echo '<br><br>array 1:<br>';
			var_dump($userLocalKeys);
			echo '<br><br>array 2:<br>';
			var_dump($arrayDataKeys);
			echo '<br><br>';*/
			/*for($c = 0; $c < count($arrayData); $c++){

				for($cc = 0; $cc < count($userLocalKeys); $cc++){
					if(){

					}
				}

			}*/
		}

	}

?>