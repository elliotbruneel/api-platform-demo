<?php 

	$soap = new \SoapClient('http://localhost:8000/soap?wsdl', array('cache_wsdl' => WSDL_CACHE_NONE));

	$functions = $soap->__getFunctions ();
	var_dump ($functions);	

	$res = $soap->__soapcall('hello',['name' => 'Scott']);
	var_dump($res);

	$res = $soap->__soapcall('getBestSellers', []);
	var_dump($res);

 ?>
