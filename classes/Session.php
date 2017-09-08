<?php

include_once './data/Query.php';
include_once 'Constants.php';
include_once 'Commons.php';
include_once 'model/SessionModel.php';
include_once 'model/ResponseModel.php';
include_once 'model/ResponseInfoModel.php';

class Session {

	private $query;
	private $keyField = "key_field";
	private $keyParam = "key_param";

	function __construct(){
		$this->query = new Query();
	}

	function initQuery(){
		$this->query = new Query();
	}

	function verifySessionStatus($username){
		$check_query = "select estado_sesion from usuario where correo_usuario = '".$username->userEmail."'";

		if($this->query==null){
			initQuery();
		}

		$response = $this->query->executeQuery($check_query);		

		$result = $response->fetch_assoc();

		$responseModel = new ResponseModel();
		$resp = new ResponseInfoModel();

	
		if($result['estado_sesion'] == '1'){
			$resp->setResponseCode(Constants::$LOGIN_SUCCESSFUL);
			$resp->setResponseMessage(Constants::$ACTIVE_SESSION_MESSAGE);	
		}else{
			$resp->setResponseCode(Constants::$LOGIN_FAILURE);
			$resp->setResponseMessage(Constants::$INACTIVE_SESSION_MESSAGE);
		}

		$responseModel->setResponseInfo($resp);

		return $responseModel;

	}

	function getUser($userEmail){

		if($this->query == null){
			$this->initQuery();
		}
		$userModel = new UserModel();
		$userParams = Commons::extractArrayParams(Constants::getUserKeys());			

		$condition = Constants::getEmailField()." = '".$userEmail."'";

		$stringQuery = $this->query->buildReadQuery(null, $condition, 'usuario');

		$temp = $this->query->executeQuery($stringQuery);			
	//$result = new SessionModel();
		if($temp ->num_rows > 0){

			$row = $temp->fetch_assoc();

			$userModel->setDocType($row['tipo_documento']);
			$userModel->setDocNumber($row['documento_usuario']);
			$userModel->setUserName($row['nombre_usuario']);
			$userModel->setUserLastname($row['apellido_usuario']);
			$userModel->setUserEmail($row['correo_usuario']);
			$userModel->setCellphone($row['celular_usuario']);
			$userModel->setTelephone($row['telefono_usuario']);
			$userModel->setSessionState($row['estado_sesion']);
		//$count = 0;
		/*while($row = $temp->fetch_assoc()){
			$result[$count] = $row;					
				//var_dump($result);

		}*/									
	}

	return $userModel;
}


function executeLogin($params){
	$login_query = "select clave_usuario from usuario where correo_usuario = '".$params->userEmail."'";

	if($this->query==null){
		initQuery();
	}

	$temp_result = $this->query->executeQuery($login_query);
	$responseData = new SessionModel();
	$responseInfo = new ResponseInfoModel();
	$responseModel = new ResponseModel();

	//var_dump($temp_result);

	if($temp_result !=null){

		$result = $temp_result->fetch_assoc();
		//var_dump($result);

		if($result['clave_usuario']==$params->userPassword){

			$userFields = Constants::getUserKeys();
			$userParams = array(Constants::$KEY_SESSION_STATE => '1');
			$status_query = $this->query->buildUpdateQuery($userParams, $userFields, Constants::getEmailField()." = '" .$params->userEmail."'", 'usuario');

			//var_dump($status_query);

			if($status_query != null){

				$result = $this->query->executeQuery($status_query);

				//var_dump($result);

				if($result == true){

					//$res = $this->getUser($username);
					//var_dump($res);

					$responseInfo->setResponseCode(Constants::$LOGIN_SUCCESSFUL);
					$responseInfo->setResponseMessage(Constants::$SUCCESS_MESSAGE);
					
					$response = $this->getUser($params->userEmail);

					$responseData->setUser($response);

				}else{						
					$responseInfo->setResponseCode(Constants::$LOGIN_FAILURE);
					$responseInfo->setResponseMessage(Constants::$FAILURE_MESSAGE);
				}				
			}				
		} else {
			
			$responseModel->setResponseCode(Constants::$LOGIN_FAILURE);
			$responseModel->setResponseMessage(Constants::$PASSWORD_FAILURE_MESSAGE);			
		}
	} else{
		$responseModel->setResponseCode(Constants::$LOGIN_FAILURE);
		$responseModel->setResponseMessage(Constants::$WRONG_USER_MESSAGE);
	}

	/*$resp->setResponseInfo($responseModel);
	$res->setResponseInfo($responseModel);*/

	$responseModel->setResponseInfo($responseInfo);
	$responseModel->setResponseData($responseData);

	return $responseModel;
}

function executeUpdate($parameters){

	$userArrayFields = Constants::getUserKeys();
	$userArrayKeys = array();
	$stringParams = "";
	$updateQuery = "";
	$stringCondition = Constants::getEmailField()." = '".$params->userEmail."'";
	$params = array();
	$result;
	$response = new ResponseModel();
	$responseInfo = new ResponseInfoModel();
	$params = array(
		Constants::$KEY_NAME => $parameters->name,
		Constants::$KEY_LAST_NAME => $parameters->lastName,
		Constants::$KEY_DOC_TYPE => $parameters->docType,
		Constants::$KEY_DOC_NUMBER => $parameters->docNumber,
		Constants::$KEY_USER_CELLPHONE => $parameters->cellphone,
		Constants::$KEY_USER_TELEHPONE => $parameters->telephone,
		Constants::$KEY_SESSION_STATE => $parameters->sessionState,
		Constants::$KEY_USER_PASSWORD => $parameters->password,
		Constants::$KEY_USER_EMAIL => $parameters->userEmail);

	if($params!=null){

		$count = 0;								

		if($this->query == null){
			$this->initQuery();
		}

		$updateQuery = $this->query->buildUpdateQuery($params, $userArrayFields, $stringCondition, 'usuario');

		$result = $this->query->executeQuery($updateQuery);

		if($result){
			$responseInfo->setResponseCode(Constants::$LOGIN_SUCCESSFUL);
			$responseInfo->setResponseMessage(Constants::$SUCCESS_MESSAGE);
		}else{
			$responseInfo->setResponseCode(Constants::$LOGIN_FAILURE);
			$responseInfo->setResponseMessage(Constants::$FAILURE_MESSAGE);
		}

	} else {
		$responseInfo->setResponseCode(Constants::$LOGIN_FAILURE);
		$responseInfo->setResponseMessage(Constants::$FAILURE_MESSAGE);
	}

	$response->setResponseInfo($responseInfo);

	return $response;
}

function signOut($params){

	$logutQuery = "";	
	$response = new ResponseModel();
	$responseInfo = new ResponseInfoModel();

	if($this->query == null){
		$this->initQuery();
	}

	if($params != null && $params->email != ""){
		$param = array(Constants::$KEY_SESSION_STATE => '2');
		$userKeys = Constants::getUserKeys();
		$condition = Constants::getEmailField() ." = '".$params->email."'";
				

		$logoutQuery = $this->query->buildUpdateQuery($param, $userKeys, $condition, 'usuario' );

		$result = $this->query->executeQuery($logoutQuery);

		$confirmCondition = Constants::getEmailField()." = '".$params->email."'";

		$confirmQuery = $this->query->buildReadQuery(array('estado_sesion'),  $confirmCondition, 'usuario');

		$confirmResponse = $this->query->executeQuery($confirmQuery);

		$confirm = $confirmResponse->fetch_assoc(); 				

		if($confirm['estado_sesion'] == '2'){			
			$responseInfo->setResponseCode(Constants::$LOGIN_SUCCESSFUL);
			$responseInfo->setResponseMessage(Constants::$SUCCESS_MESSAGE);
		}else{
			$responseInfo->setResponseCode(Constants::$LOGIN_FAILURE);
			$responseInfo->setResponseMessage(Constants::$FAILURE_MESSAGE);
		}

	}else{
		$responseInfo->setResponseCode(Constants::$LOGIN_FAILURE);
		$responseInfo->setResponseMessage(Constants::$FAILURE_MESSAGE);
	}

	$response->setResponseInfo($responseInfo);

	return $response;			
}
}
?>