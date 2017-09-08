<?php

	include_once './data/Query.php';
	include_once 'Constants.php';
	include_once './classes/model/RegisterModel.php';
	include_once './classes/model/ResponseModel.php';
	include_once './classes/model/ResponseInfoModel.php';

	class Register {

		private $query;

		function __construct(){
			$this->query = new Query();
		}

		/*function executeRegister($name, $lastName, $docType, $docNumber, $email, $cellphone, $telephone, $sessionState, $pwd){

			$userParams = array(
				Constants::$KEY_NAME => $name,
				Constants::$KEY_LAST_NAME => $lastName,
				Constants::$KEY_DOC_TYPE => $docType,
				Constants::$KEY_DOC_NUMBER => $docNumber,
				Constants::$KEY_USER_EMAIL => $email,
				Constants::$KEY_USER_CELLPHONE => $cellphone,
				Constants::$KEY_USER_TELEHPONE => $telephone,
				Constants::$KEY_SESSION_STATE => $sessionState,
				Constants::$KEY_USER_PASSWORD => $pwd);

			$localParams = Constants::getUserKeys();
			$localParams[Constants::$KEY_USER_EMAIL] = Constants::getEmailField();
			$stringQuery = $this->query->buildInsertQuery($userParams, $localParams, 'usuario');

			$result = $this->query->executeQuery($stringQuery);

			return $result;
		}*/

		function executeRegister($params){

			//var_dump($params);

			$userParams = array(
				Constants::$KEY_NAME => $params->name,
				Constants::$KEY_LAST_NAME => $params->lastName,
				Constants::$KEY_DOC_TYPE => $params->docType,
				Constants::$KEY_DOC_NUMBER => $params->docNumber,
				Constants::$KEY_USER_EMAIL => $params->email,
				Constants::$KEY_USER_CELLPHONE => $params->cellphone,
				Constants::$KEY_USER_TELEHPONE => $params->telephone,
				Constants::$KEY_SESSION_STATE => $params->sessionState,
				Constants::$KEY_USER_PASSWORD => $params->password);

			/*$userParams = array(
				Constants::$KEY_NAME => $params->getName(),
				Constants::$KEY_LAST_NAME => $params->getLastName(),
				Constants::$KEY_DOC_TYPE => $params->getDocType(),
				Constants::$KEY_DOC_NUMBER => $params->getDocNumber(),
				Constants::$KEY_USER_EMAIL => $params->getEmail(),
				Constants::$KEY_USER_CELLPHONE => $params->getCellphone(),
				Constants::$KEY_USER_TELEHPONE => $params->getTelephone(),
				Constants::$KEY_SESSION_STATE => $params->getSessionState(),
				Constants::$KEY_USER_PASSWORD => $params->getPassword());*/

			$localParams = Constants::getUserKeys();
			$localParams[Constants::$KEY_USER_EMAIL] = Constants::getEmailField();
			$stringQuery = $this->query->buildInsertQuery($userParams, $localParams, 'usuario');

			$result = $this->query->executeQuery($stringQuery);
			$responseModel = new ResponseModel();
			$responseInfo = new ResponseInfoModel();


			if($result == true){
				$stringCondition = Constants::getEmailField()." = '".$params->email."'";				
				$query = $this->query->buildReadQuery(array(Constants::getEmailField()), $stringCondition, 'usuario');
				$queryResult = $this->query->executeQuery($query);

				$res = $queryResult->fetch_assoc();					

				if($res[Constants::getEmailField()] == $params->email){
					$responseInfo->setResponseCode(Constants::$LOGIN_SUCCESSFUL);
					$responseInfo->setResponseMessage(Constants::$SUCCESS_MESSAGE.": ".$params->email);					
				} else {
					$responseInfo->setResponseCode(Constants::$LOGIN_FAILURE);
					$responseInfo->setResponseMessage(Constants::$FAILURE_MESSAGE);
				}
			}else{
				$responseInfo->setResponseCode(Constants::$LOGIN_FAILURE);
				$responseInfo->setResponseMessage(Constants::$FAILURE_MESSAGE);
			}

			$responseModel->setResponseInfo($responseModel);

			return $responseInfo;	
		}

		/*function executeRegister($registerParams){

			echo '<br> register message';
			echo '<br> params: <br> '.$registerParams['document'];

			$return_param = 0;

			if($registerParams != null){

				$document = $registerParams['document'];
				$name = $registerParams['name'];
				$lastName = $registerParams['last_name'];
				$doctype = $registerParams['doctype'];
				$email = $registerParams['email'];
				$cellNumber = $registerParams['cell_number'];
				$phoneNumber = $registerParams['phone_number'];
				$sessionState = $registerParams['session_state'];  

				$stringQuery = 'insert into usuario values ('.(string)$document.', '.(string)$name.', '.(string)$lastName.', '.$doctype.', '.(string)$email.', '.(string)$cellNumber.', '.(string)$phoneNumber.', '.$sessionState.' )';

				if($stringQuery!=null && $stringQuery != ""){	
					if($this->query->executeQuery($stringQuery)){
						$return_param = Constants::$REGISTER_SUCCESS;
					}else{
						$return_param =  Constants::$REGISTER_FAILURE;	
					}
				}else{
					echo '<br>failure while creating the query';
				}
			}else{
				echo '<br> no data received';
			}

			return $return_param;
		}*/


	}

	//$params = array('document'=>(string)'"1073712110"', 'name'=>(string)'"Wilson Fernando"', 'last_name'=>(string)'"Mora Martinez"', 'doctype'=>'1','email'=>(string)'"wilsonfermora19.97@gmail.com"', 'cell_number'=>(string)'"3213751378"', 'phone_number'=>(string)'"7894516"', 'session_state'=>'1');

	
?>