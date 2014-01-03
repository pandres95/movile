<?php

class ciudadModel extends Model{
 
 public function ciudadModel(){

 }
 
 public function getName($data){
 	$sql = "SELECT nombre FROM ciudades WHERE id ='".$data."' AND ESTADO = 1";
    $ciudad = parent::query($sql);
	
	if(count($ciudad) > 0){
	  return json_encode($ciudad);
	}else{
	  return json_encode(array('error' => true));
	}
 }
 
}