<?php

	class Commons {

		public static function extractArrayKeys($array){

			$arrayKeys = array();
			$count = 0;

			foreach($array as $k => $k_value){
				$arrayKeys[$count] = $k;
					//echo "key: ".$k.'<br>';
				$count++;
			}

			return $arrayKeys;
		}

		public static function extractArrayParams($array){

			$params = array();
			//$keys = self::extractArrayKeys($array);
			$count = 0;

			foreach($array as $v){
				$params[$count] = $v;
				$count++;
			}

			return $params;
		}

	}

?>