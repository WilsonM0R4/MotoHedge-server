<?php

include 'classes/Session.php';
include 'classes/Register.php';
include 'classes/ServiceRequest.php';

#WSDLService class
class WSDLService {

	function register($params){
		$register = new Register();
		$result = $register->executeRegister($params);
		return $result;
	}

	function signIn($params){
		$login = new Session();
		$loginResult = $login->executeLogin($params);
		return $loginResult;
	}

	function verifySession($userEmail){
		$session = new Session();
		$sessionStatus = $session->verifySessionStatus($userEmail);
		return $sessionStatus;
	}

	function signOut($user){
		$logout = new Session();
		$logoutResult = $logout->signOut($user);
		return $logoutResult;
	}

	function infoUpdate($params){
		$login = new Session();			
		$result = $login->executeUpdate($params);
		return $result;
	}

	function serviceRequest($params){
		$service = new ServiceRequest();
		$result = $service -> executeServiceRequest($params);
		return $result;
	}

	function updateService($params){
		$service = new ServiceRequest();
		$result = $service -> updateService($params);
		return $result;
	}

	function getUser($userEmail){
		$session = new Session();
		$result = $session -> getUser($userEmail);
		return $result;
	}

	/*function getServiceRequestList(){
		$service = new ServiceRequest();
		$result = $service -> getServiceRequestList();
		return $result;
	}*/

	function getServices($params){
		$service = new ServiceRequest();
		$result = $service->getServices($params);
		return $result;
	}

}
?>