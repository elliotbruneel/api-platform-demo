<?php 

	ini_set("soap.wsdl_cache_enabled", "0");
	$soap = new \SoapClient('http://localhost:8000/soap?wsdl', array('cache_wsdl' => WSDL_CACHE_NONE));

	echo "<h3>Affichage des fonctions disponibles sur le web service SOAP</h3>";
	$functions = $soap->__getFunctions();
	var_dump($functions);	

	echo "<h3>Affichage de 'Hello'</h3>";
	$res = $soap->__soapcall('hello',['name' => 'Scott']);
	var_dump($res);

	echo "<h3>Meilleurs vendeurs du site</h3>";
	$res = $soap->__soapcall('getBestSellers', []);
	var_dump($res);

	echo "<h3>Affichage d'un article</h3>";
	$res = $soap->__soapcall('getArticle', ['id' => 1]);
	var_dump($res);

 ?>
