<?php

class smsModel extends Model{
    
    public function smsModel(){}
    
    public function registraCelular($celular, $ciudad) {
        $sql = "CALL insertar_celular('$celular', '$ciudad')";
        Model::spQuery($sql);        
    }
    
    public function registraSMS($celular, $mensaje){
        $sql = "INSERT INTO sms_enviados (celular, mensaje) VALUES ('$celular', '$mensaje');";
        Model::query($sql);
    }
    
    public function fallaSMS($celular){
        $sql = "INSERT INTO sms_fallidos (celular) VALUES ('$celular');";
        Model::query($sql);
    }
    
    public function iniciaEncuesta($celular, $encuesta){
        $sql = "CALL iniciar_encuesta('$celular', $encuesta, @res);";
        Model::spQuery($sql);
    }
    
}