<?php

	class Constants {

		//Login constants
		public static $LOGIN_SUCCESSFUL = 100;
		public static $LOGIN_FAILURE = 101;

		//messages
		public static $SUCCESS_MESSAGE = "success";
		public static $FAILURE_MESSAGE = "failure";		
		public static $KEY_RESPONSE_CODE = "responseCode";
		public static $KEY_RESPONSE_NAME = "responseName";
		public static $WRONG_USER_MESSAGE = "invalid user";
		public static $PASSWORD_FAILURE_MESSAGE = "wrong password";
		public static $ACTIVE_SESSION_MESSAGE = "active";
		public static $INACTIVE_SESSION_MESSAGE = "inactive";

		//Update/register constants
		public static $KEY_NAME = 'name';
		public static $KEY_LAST_NAME = 'last_name';
		public static $KEY_DOC_TYPE = 'doc_type';
		public static $KEY_DOC_NUMBER = 'doc_number';
		public static $KEY_USER_EMAIL = 'user_email';  
		public static $KEY_USER_CELLPHONE = 'user_cellphone';
		public static $KEY_USER_TELEHPONE = 'user_telephone';
		public static $KEY_SESSION_STATE = 'session_state';
		public static $KEY_USER_PASSWORD = 'user_password';
		private static $KEY_USER_EMAIL_FIELD = 'correo_usuario';

		//Service request constants
		public static $KEY_SERVICE_TYPE = "service_type";
		public static $KEY_VEHICLE_TYPE = "vehicle_type";
		public static $KEY_SERVICE_ADDRESS = "service_address";
		public static $KEY_SERVICE_LATITUDE = "geopoint_latitude";
		public static $KEY_SERVICE_LONGITUDE = "geopoint_longitude";
		public static $KEY_USER_COMMENTS = "user_comments";
		public static $KEY_SERVICE_STATE = "service_state";	
		public static $SERVICE_CONSECUTIVE = "service_consecutive";
		public static $KEY_SERVICE_DATE = "date";

		private static $KEY_SERVICE_CONSECUTIVE = "consecutivo_servicio";
		private static $KEY_SERVICE_USER = "usuario";

		public static function getUserKeys(){

			$USER_ARRAY_KEYS = array(
				self::$KEY_NAME => 'nombre_usuario', 
				self::$KEY_LAST_NAME => 'apellido_usuario', 
				self::$KEY_DOC_TYPE => 'tipo_documento',
				self::$KEY_DOC_NUMBER => 'documento_usuario',				
				self::$KEY_USER_CELLPHONE => 'celular_usuario', 
				self::$KEY_USER_TELEHPONE => 'telefono_usuario', 
				self::$KEY_SESSION_STATE => 'estado_sesion', 
				self::$KEY_USER_PASSWORD => 'clave_usuario');

			return $USER_ARRAY_KEYS;
		}

		public static function getEmailField(){
			return self::$KEY_USER_EMAIL_FIELD;
		}

		public static function getServiceConsecutiveKey(){
			return self::$KEY_SERVICE_CONSECUTIVE;
		}

		public static function getServiceUserKey(){
			return self::$KEY_SERVICE_USER;
		}

		public static function getServiceKeys(){

			$service_array_keys = array(
				self::$KEY_SERVICE_TYPE => 'tipo_servicio',
				self::$KEY_VEHICLE_TYPE => 'tipo_vehiculo',
				self::$KEY_SERVICE_ADDRESS => 'direccion_asistencia',
				self::$KEY_SERVICE_LATITUDE => 'latitud_asistencia',
				self::$KEY_SERVICE_LONGITUDE => 'longitud_asistencia',
				self::$KEY_USER_CELLPHONE => 'celular_usuario',
				self::$KEY_USER_COMMENTS => 'comentario_usuario',
				self::$KEY_SERVICE_STATE => 'estado_servicio',
				self::$KEY_USER_EMAIL => 'usuario',
				self::$KEY_SERVICE_DATE => 'fecha');
				//self::$SERVICE_CONSECUTIVE => 'consecutivo_servicio');

			return $service_array_keys;
		}

	}

?>