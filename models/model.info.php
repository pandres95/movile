<?php

class infoModel extends Model{
    
    public function infoModel(){
        
    }
    
    public function numeroEncuestas(){
        
        $sql = "SELECT COUNT(id) AS cuenta FROM movile_encuestas LIMIT 1";
        $validate = Model::query($sql);
        
        if(count($validate) > 0){
            return json_encode($validate);
        }else{
            return json_encode(array('error' => true));
        }
    }
    
    public function smsCorrectos(){
        $sql = "SELECT COUNT(id) AS cuenta FROM respuestas_usuarios LIMIT 1";
        $validate = Model:: query($sql);
        
        if(count($validate) > 0){
            return json_encode($validate);
        }else{
            return json_encode(array('error' => true));
        }
    }
    
    public function smsFallidos(){
        $sql = "SELECT COUNT(id) AS cuenta FROM sms_fallidos LIMIT 1";
        $validate = Model::query($sql);
        
        if(count($validate) > 0){
            return json_encode($validate);
        }else{
            return json_encode(array('error' => true));
        }
    }
    
    public function smsTotales(){
        $sql = "SELECT (SELECT COUNT(id) AS cuenta FROM respuestas_usuarios LIMIT 1) + (SELECT COUNT(id) AS cuenta FROM sms_fallidos LIMIT 1) AS cuenta";
        $validate = Model::query($sql);
        
        if(count($validate) > 0){
            return json_encode($validate);
        } else {
            return json_encode(array('error'=>true));
        }
    }
    
    public function smsEnviadosPorMunicipio($municipio){
        
        $sql = "SELECT count(id) as cuenta FROM sms_enviados_por_municipio WHERE municipio = '$municipio'";
        $res = Model::query($sql);
        
        if(count($res) > 0){
            return json_encode($res);
        } else {
            return json_encode(array('error' => true));
        }
        
    }
    
}

?>