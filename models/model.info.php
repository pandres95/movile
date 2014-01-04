<?php

class infoModel extends Model{
    
    public function infoModel(){
        
    }
    
    public function numeroEncuestas($data){
        
        $sql = "SELECT COUNT(id) AS cuenta FROM movile_encuestas LIMIT 1";
        $validate = Model::query($sql);
        
        if(count($validate) > 0){
            return json_encode($validate);
        }else{
            return json_encode(array('error' => true));
        }
    }
    
    public function smsCorrectos($data){
        $sql = "SELECT COUNT(id) AS cuenta FROM respuestas_usuarios LIMIT 1";
        $validate = Model:: query($sql);
        
        if(count($validate) > 0){
            return json_encode($validate);
        }else{
            return json_encode(array('error' => true));
        }
    }
    
    public function smsFallidos($data){
        $sql = "SELECT COUNT(id) AS cuenta FROM sms_fallidos LIMIT 1";
        $validate = Model::query($sql);
        
        if(count($validate) > 0){
            return json_encode($validate);
        }else{
            return json_encode(array('error' => true));
        }
    }
    
    public function smsTotales($data){
        $sql = "SELECT (SELECT COUNT(id) AS cuenta FROM respuestas_usuarios LIMIT 1) + (SELECT COUNT(id) AS cuenta FROM sms_fallidos LIMIT 1) AS cuenta";
        $validate = Model::query($sql);
        
        if(count($validate) > 0){
            return json_encode($validate);
        } else {
            return json_encode(array('error'=>true));
        }
    }
        
}

?>