<?php

	class RegisterModel {

		private $name = "";
		private $lastName = "";
		private $docType = "";
		private $docNumber = "";
		private $email = "";
		private $cellphone = "";
		private $telephone = "";
		private $sessionState = "";
		private $password = "";

		function __construct(){

		}

		//getters
		function getName(){
			return $this->name;
		}

		function getLastName(){
			return $this->lastName;
		}

		function getDocType(){
			return $this->docType;
		}
		 
		function getDocNumber(){
			return $this->docNumber;
		}

		function getEmail(){
			return $this->email;
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

		function getPassword(){
			return $this->password;
		}

		//setters
		function setName($name){
			$this->name = $name;
		}

		function setLastName($lastName){
			$this->lastName = $lastName;
		}

		function setDocType($docType){
			$this->docType = $docType;
		}
		
		function setDocNumber($docNumber){
			$this->docNumber = $docNumber;
		}

		function setEmail($email){
			$this->email = $email;
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

		function setPassword($password){
			$this->password = $password;
		}

	}

?>