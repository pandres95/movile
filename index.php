<?php 

/* 

ccToolkit
Grupo de herramientas y entorno para soluciones de CaribeCoders

*/

session_start();

include('core/utils.php');

// Load & Instancies Libraries
$libraries = array(
	'app'		=>'core',
	'orm'		=>'orm',
	'slimlab'	=>'Slimax',
	'wsdlpro'	=>'wsdlpro',
	'controller'=>'Controller',
	'model' 	=>'Model',
	'phpmailer'	=>'PHPMailer'
	);
autoLoad($libraries);

// Config Zone
$config = array('errors' => true, 'uri'=>'http://localhost/movile');
$app['app']::settings($config);

$app['app']::SQLConnect(array('host'=>'localhost','user'=>'shorty_your658','pass'=>'g2sdxPS2i7','db'=>'shorty_movile'));

// Send PHP vID to GLOBALS
PHP_VERSION_ID();

// Routing Files
routing();

?>