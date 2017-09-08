<?php

	class ServiceModel {

		public $consecutive = "";
		public $serviceType = "";
		public $vehicleType = "";
		private $serviceAddress = "";
		private $serviceLatitude = "";
		private $serviceLongitude = "";
		public $userComments = "";
		private $serviceState = "";
		private $userEmail = "";
		private $userCellphone = "";
		private $date = "";

		function __construct(){

		}

		//getters
		function getServiceConsecutive(){
			return $this->consecutive;
		}

		function getServiceType(){
			return $this->serviceType;
		}

		function getVehicleType(){
			return $this->vehicleType;
		}

		function getServiceAddress(){
			return $this->serviceAddress;
		}

		function getServiceLatitude(){
			return $this->serviceLatitude;		
		}

		function getServiceLongitude(){
			return $this->serviceLongitude;
		}

		function getUserComments(){
			return $this->userComments;
		}

		function getServiceState(){
			return $this->serviceState;
		}

		function getUserEmail(){
			return $this->userEmail;
		}

		function getUserCellphone(){
			return $this->userCellphone;
		}

		function getDate(){
			return $this->date;
		}


		//setters
		function setServiceConsecutive($serviceConsecutive){
			$this->consecutive = $serviceConsecutive;
		}

		function setServiceType($serviceType){
			$this->serviceType = $serviceType;
		}

		function setVehicleType($vehicleType){
			$this->vehicleType = $vehicleType;
		}

		function setServiceAddress($serviceAddress){
			$this->serviceAddress = $serviceAddress;
		}

		function setServiceLatitude($serviceLatitude){
			$this->serviceLatitude = $serviceLatitude;		
		}

		function setServiceLongitude($serviceLongitude){
			$this->serviceLongitude = $serviceLongitude;
		}

		function setUserComments($userComments){
			$this->userComments = $userComments;
		}

		function setServiceState($serviceState){
			$this->serviceState = $serviceState;
		}

		function setUserEmail($userEmail){
			$this->userEmail = $userEmail;
		}

		function setUserCellphone($userCellphone){
			$this->userCellphone = $userCellphone;
		}

		function setDate($date){
			$this->date = $date;
		}
	}

?>