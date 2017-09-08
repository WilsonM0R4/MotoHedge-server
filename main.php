<?php
	include 'WSDLService.php';

	if(!extension_loaded("soap")){
		dl("php_soap.dll");
	}

	ini_set("soap.wsdl_cache_enabled","0");

	$server = new SoapServer("http://localhost:8080/MotoHedge/service/motohedge.xml?wsdl", array('soap_version'=>SOAP_1_1));
	//$server = new SoapServer("http://unreleased-reactors.000webhostapp.com/MotoHedge/motohedge.xml?wsdl", array('soap_version'=>SOAP_1_1));

	$server->setClass('WSDLService');
	$server->handle();
?>