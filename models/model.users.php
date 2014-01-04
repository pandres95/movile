<?php

class usersModel extends Model{
 
 public function usersModel(){

 }
 
 public function validaUsario($data){

    $sql = "SELECT * FROM movile_usuarios WHERE user ='".$data['user']."' and pass = md5('".$data['pass']."') LIMIT 1";
    $validate = Model::query($sql);
	
	if(count($validate) > 0){
	  return json_encode($validate);
	}else{
	  return json_encode(array('error' => true));
	}
 }

 public function getName($data){
 	$sql = "SELECT nombre FROM movile_usuarios WHERE id ='".$data['id_usuario']."'";
    $user = parent::select($sql);
	
	if(count($user) > 0){
	  return json_encode($user);
	}else{
	  return json_encode(array('error' => true));
	}
 }
 
}