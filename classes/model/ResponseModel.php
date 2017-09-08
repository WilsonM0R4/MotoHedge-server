<?php

	class ResponseModel{

		private $responseInfo;
		private $responseData;

		function __construct(){

		}

		//getters
		function getResponseInfo(){
			return $this->responseInfo;
		}

		function getResponseData(){
			return $this->responseData;
		}

		//setters
		function setResponseInfo($responseInfo){
			$this->responseInfo = $responseInfo;
		}

		function setResponseData($responseData){
			$this->responseData = $responseData;
		}
	}

?>