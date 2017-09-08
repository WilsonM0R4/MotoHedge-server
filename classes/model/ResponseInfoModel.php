<?php

	class ResponseInfoModel {
		
		private $responseCode = "";
		private $responseMessage = "";

		function __construct(){

		}

		//getters
		function getResponseCode(){
			return $this->responseCode;
		}

		function getResponseMessage(){
			return $this->responseMessage;
		}

		//setters
		function setResponseCode($responseCode){
			$this->responseCode = $responseCode;
		}

		function setResponseMessage($responseMessage){
			$this->responseMessage = $responseMessage;
		}

	}

?>