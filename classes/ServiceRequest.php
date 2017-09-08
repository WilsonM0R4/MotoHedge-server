<?php

include_once 'Constants.php';
include_once './data/Query.php';
include_once 'model/ServiceModel.php';
include_once 'model/ResponseModel.php';
include_once 'model/ResponseInfoModel.php';
include_once 'model/ServiceResponseModel.php';

class ServiceRequest {

	private $query;

	function __construct(){
		$this->query = new Query();
	}

	function executeServiceRequest($params){

		$localParams = Constants::getServiceKeys();
		$stringTable = 'servicio';
		$stringQuery = "";

		$responseModel = new ResponseModel();
		$responseInfo = new ResponseInfoModel();

		$userParams =array(
			Constants::$KEY_SERVICE_TYPE => $params->serviceType,
			Constants::$KEY_VEHICLE_TYPE => $params->vehicleType,
			Constants::$KEY_SERVICE_ADDRESS => $params->serviceAddress,
			Constants::$KEY_SERVICE_LATITUDE => $params->serviceLatitude,
			Constants::$KEY_SERVICE_LONGITUDE => $params->serviceLongitude,								 
			constants::$KEY_USER_COMMENTS => $params->userComments,
			Constants::$KEY_SERVICE_STATE => $params->serviceState,
			Constants::$KEY_USER_EMAIL => $params->userEmail,
			Constants::$KEY_USER_CELLPHONE => $params->userCellphone,
			Constants::$KEY_SERVICE_DATE=> $params->date);


		$stringQuery = $this->query->buildInsertQuery($userParams, $localParams, $stringTable);

			/*if($sender == Constants::$SERVICE_SENDER_USER){
				$stringQuery = $this->query->buildInsertQuery($userParams, $localParams, $stringTable);
			} else if($sender == Constants::$SERVICE_SENDER_OPERATOR){
				$condition = $localParams[Constants::$SERVICE_CONSECUTIVE].' = '.$consecutive;
				$stringQuery = $this->query->buildUpdateQuery($userParams, $localParams, $condition, $stringTable);
			}*/

			
			$result = $this->query->executeQuery($stringQuery);
			if($result == true){
				$tempCondition = Constants::getServiceUserKey()." = '". $params->userEmail ."' ";
				$tempKey = 'max('.Constants::getServiceConsecutiveKey().')';
				$confirmQuery = $this->query->buildReadQuery(array($tempKey), $tempCondition, $stringTable);
				$temp = $this->query->executeQuery($confirmQuery);

				if($temp->num_rows > 0){
					$temporal = $temp->fetch_assoc();				
					$result = $temporal[$tempKey];

					$serviceResponse = new ServiceResponseModel();
					$serviceResponse->setServiceConsecutive($result);

					$responseModel->setResponseData($serviceResponse);
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

			$responseModel->setResponseInfo($responseInfo);
			return $responseModel;
		}

		function updateService($params){
			$stringTable = 'servicio';
			$stringCondition = 'consecutivo_servicio = '.$params->consecutive;
			$arrayParams = $this->checkUpdateServiceParameters($params);			
			$localParams = Constants::getServiceKeys();

			$response = new ResponseModel();
			$responseInfo = new ResponseInfoModel();

			$stringQuery = $this->query->buildUpdateQuery(
				$arrayParams,
				$localParams,
				$stringCondition,
				$stringTable);

			$result = $this->query->executeQuery($stringQuery);

			if($result){
				$responseInfo->setResponseCode(Constants::$LOGIN_SUCCESSFUL);
				$responseInfo->setResponseMessage(Constants::$SUCCESS_MESSAGE);
			}else{
				$responseInfo->setResponseCode(Constants::$LOGIN_FAILURE);
				$responseInfo->setResponseMessage(Constants::$FAILURE_MESSAGE);
			}

			$response->setResponseInfo($responseInfo);

			return $response;
		}

		function checkUpdateServiceParameters($params){
			$parameters = array();
			$stringParameters = "parameters";
			if(isset($params->serviceType)){
				$parameters[Constants::$KEY_SERVICE_TYPE] = $params->serviceType;
			}

			if(isset($params->vehicleType)){
				$parameters[Constants::$KEY_VEHICLE_TYPE] = $params->vehicleType;			
			}

			if(isset($params->serviceAddress)){
				$parameters[Constants::$KEY_SERVICE_ADDRESS] = $params->serviceAddress;
			}

			if(isset($params->serviceLongitude)){
				$parameters[Constants::$KEY_SERVICE_LONGITUDE] = $params->serviceLongitude;
			}

			if(isset($params->serviceLatitude)){
				$parameters[Constants::$KEY_SERVICE_LATITUDE] = $params->serviceLatitude;
			}

			if(isset($params->userComments)){
				$parameters[Constants::$KEY_USER_COMMENTS] = $params->userComments;				
			}

			if(isset($params->serviceState)){
				$parameters[Constants::$KEY_SERVICE_STATE] = $params->serviceState;				
			}

			if(isset($params->userEmail)){
				$parameters[Constants::$KEY_USER_EMAIL] = $params->userEmail;				
			}

			if(isset($params->userCellphone)){
				$parameters[Constants::$KEY_USER_CELLPHONE] = $params->userCellphone;				
			}

			if(isset($params->date)){
				$parameters[Constants::$KEY_SERVICE_DATE] = $params->date;				
			}			

			return $parameters;
		}

		function getServiceRequestList(){

			$query = $this ->query->buildReadQuery(null, null, 'servicio');
			$temp = $this->query->executeQuery($query);
			$result = array();

			if($temp ->num_rows > 0){
				$count = 0;
				while($row = $temp->fetch_assoc()){

					$model = new ServiceModel();
					$model->setServiceConsecutive($row['consecutivo_servicio']);
					$model->setServiceType($row['tipo_servicio']);
					$model->setVehicleType($row['tipo_vehiculo']);
					$model->setServiceAddress($row['direccion_asistencia']);
					$model->setServiceLatitude($row['latitud_asistencia']);
					$model->setServiceLongitude($row['longitud_asistencia']);
					$model->setUserComments($row['comentario_usuario']);
					$model->setServiceState($row['estado_servicio']);
					$model->setUserEmail($row['usuario']);
					$model->setUserCellphone($row['celular_usuario']);
					$model->setDate($row['fecha']);

					$result[$count] = $model;
					$count++;
				}
			}
			
			return $result;
		}
 
		function getServices($params){
			$userEmail = $params->userEmail;
			$fromIndex = $params->fromIndex;
			$limitString = "order by consecutivo_servicio desc limit ".$fromIndex.", 10";
			$condition = "usuario = '".$userEmail."'";

			$result = array();

			$query = $this->query->buildReadQuery(null, $condition, "servicio");
			$query = $query." ".$limitString;
			$temp = $this->query->executeQuery($query);

			if($temp->num_rows > 0){
				$count = 0;
				while($row = $temp->fetch_assoc()){

					$model = new ServiceModel();
					$model->setServiceConsecutive($row['consecutivo_servicio']);
					$model->setServiceType($row['tipo_servicio']);
					$model->setVehicleType($row['tipo_vehiculo']);
					$model->setServiceAddress($row['direccion_asistencia']);
					$model->setServiceLatitude($row['latitud_asistencia']);
					$model->setServiceLongitude($row['longitud_asistencia']);
					$model->setUserComments($row['comentario_usuario']);
					$model->setServiceState($row['estado_servicio']);
					$model->setUserEmail($row['usuario']);
					$model->setUserCellphone($row['celular_usuario']);
					$model->setDate($row['fecha']);

					$result[$count] = $model;
					$count++;
				}
			}

			return $result;
		}
		
	}



	?>