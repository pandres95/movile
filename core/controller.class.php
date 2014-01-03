<?php

/*

Controller
Revision 0

*/

class Controller extends orm{
	public $nombre;
	public static $slimx;
	public static $ws;
	public static $mail;
	public static $uri;
	public static $models = array();
	public function Controller($arg = array()){self::$slimx = self::getObject('Slimax'); self::$ws = self::getObject('wsdlpro');  }
	public function index($arg = array()){}
	public function loadModel($modelName){
		include('models/model.'.$modelName.'.php'); 
		$obj = $modelName.'Model'; /**/
		self::$models[$modelName] = new $obj();
	}
	public static function getModel($modelName){ return self::$models[$modelName]; }
}

