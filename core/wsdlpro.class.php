<?php
/*

WSDL PRO..... Cliet for SoapClient
It's Free

*/
class wsdlpro{
 public $client;

 public function wsdlpro(){

 }

 public function initClient($url){
 	$this->client = new SoapClient($url,array('cache_wsdl' => WSDL_CACHE_NONE, 'trace' => TRUE));
 }

 public function execMethod($method,$param){
 	try{
		$res = $this->client->$method($param);
		return array('status'=>'true','data'=>$res);
	}catch (Exception $e) {
		trigger_error($e->getMessage(), E_USER_WARNING);
	}
 	
 }

 public function resetWsdl(){
 	unset($this->client);
 }

}

?>