<?php

	class ServiceResponseModel {

		private $consecutive = 0;

		function __construct(){

		}

		//getter
		function getServiceConsecutive(){
			return $this->consecutive;
		}

		//setter
		function setServiceConsecutive($consecutive){
			$this->consecutive = $consecutive;
		}

	}

?>