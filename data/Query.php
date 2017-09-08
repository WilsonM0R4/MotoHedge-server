<?php

include_once 'DBConnection.php';

class Query {

	private $conn;
	private $connection;
	private $keyField = "key_field";
	private	$keyParam = "key_param";

	function __construct(){

		$this->connection = new DBConnection();
		$this->conn = $this->connection->getConnection();

	}

	function executeQuery($query){				

		$result = $this->conn->query($query);

		if($result){
			return $result;
		}else{
			return 'Error: '.$this->conn->error. 'query: '.$query;
		}

		$conn->close();
	}

	private function extractParams($userParams, $localParams){

		$foundCount = 0;
		$queryArray = array();

		$keys = Commons::extractArrayKeys($userParams);
		$localKeys= Commons::extractArrayKeys($localParams);

		for($count = 0; $count < count($userParams); $count++){

			

			if($foundCount < count($userParams)){

				$cnt = 0;

				while($cnt < count($localParams)){

					if($keys[$foundCount] == $localKeys[$cnt]){

						$queryArray[$foundCount] = array(
							$this->keyField => $localParams[$localKeys[$cnt]],
							$this->keyParam => $userParams[$keys[$count]]);

						$foundCount++;						
						$cnt = count($localParams);						
					}else{						
						$cnt++;
					}

				}
			}

		}

		return $queryArray;		

	}

	function buildInsertQuery($userParams, $localParams, $tableName){

		$query = "";
		$queryArray = $this->extractParams($userParams, $localParams);
		$queryFields = array();
		$queryParams = array();

		for($c = 0; $c < count($queryArray); $c++){

			if($c == 0){
				$queryFields = $queryArray[$c][$this->keyField];
				$queryParams = "'".$queryArray[$c][$this->keyParam]."'";
			} else {
				$queryFields = $queryFields.", ".$queryArray[$c][$this->keyField];
				$queryParams = $queryParams.", '".$queryArray[$c][$this->keyParam]."'";
			}

		}

		$query = 'insert into '.$tableName.' ('.$queryFields.') values ('.$queryParams.');';

		return $query;
	}

	//params -- array() --- stringCondition -- string --- tableName -- string	
	function buildReadQuery($params, $stringCondition, $tableName){

		$query = "";		
		$stringParams = "";

		if($params == null || $params == "" ){
			$stringParams = "*";
		}else {

			for($c = 0; $c < count($params); $c++){
				if($c == 0){
					$stringParams = $params[$c];
				}else{
					$stringParams = $stringParams.', '.$params[$c];
				}
			}

		}

		$query = "select ".$stringParams." from ".$tableName;

		if($stringCondition != null ||  $stringCondition != ""){
			$query = $query.' where '.$stringCondition; 
		}

		return $query;

	}

	function buildUpdateQuery($userParams, $localParams, $queryCondition, $tableName){

		$query = "";

		$queryArray = $this->extractParams($userParams, $localParams); //array();
		$queryFields = "";
		$queryParams = "";					

		for($c = 0; $c < count($queryArray); $c++){
			if($c==0){
				if($queryArray[$c][$this->keyParam]!= null && $queryArray[$c][$this->keyParam] != '' && $queryArray[$c][$this->keyParam]!= ' '){
					$queryParams = $queryArray[$c][$this->keyField]." = '".$queryArray[$c][$this->keyParam]."' ";
				}
				
			} else {
				if($queryArray[$c][$this->keyParam]!= null && $queryArray[$c][$this->keyParam] != '' && $queryArray[$c][$this->keyParam]!= ' '){
					$queryParams = $queryParams.", ".$queryArray[$c][$this->keyField]." = '".$queryArray[$c][$this->keyParam]."'";
				}				
			}
		}

		$query = 'update '.$tableName.' set '.$queryParams.' where '.$queryCondition.';';		

		return $query;
	}

}

?>