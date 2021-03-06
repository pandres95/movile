<?php

class infoModel extends Model{
    
    public function infoModel(){}
    
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
        $sql = "SELECT (SELECT COUNT(id) AS cuenta FROM respuestas_usuarios LIMIT 1) + (SELECT COUNT(id) AS cuenta FROM sms_enviados LIMIT 1) AS cuenta;";
        $validate = Model::query($sql);
        
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
        $sql = "SELECT (SELECT COUNT(id) AS cuenta FROM respuestas_usuarios LIMIT 1) + (SELECT COUNT(id) AS cuenta FROM sms_enviados LIMIT 1) + (SELECT COUNT(id) AS cuenta FROM sms_fallidos LIMIT 1) AS cuenta";
        $validate = Model::query($sql);
        
        if(count($validate) > 0){
            return json_encode($validate);
        } else {
            return json_encode(array('error'=>true));
        }
    }
    
    public function smsEnviadosPorMunicipio($municipio){
        
        $sql = "SELECT count(celular) as cuenta FROM sms_enviados_por_municipio WHERE municipio = '$municipio'";
        $res = Model::query($sql);
        
        if(count($res) > 0){
            return json_encode($res);
        } else {
            return json_encode(array('error' => true));
        }
        
    }
    
    public function respuestasPorDepartamentos(){
        
        $sql = "CALL respuestas_por_departamento();";
        $res = Model::spQuery($sql);
        
        $a = array();
        
        if(count($res[0]) > 0){
            
            $res = $res[0];
            if(count($res) > 10){
                $suma = 0.0;
                for($i = 0; $i < 10; $i++){
                    $lbl = $res[$i][0];
                    $search = "SELECT nombre_departamento FROM movile_departamentos WHERE id = '$lbl';";
                    $tres = Model::query($search);
                    $a[] = array("label" => $tres[0][0],
                                 "value" => $res[$i][1]
                                );
                    $suma = $suma + $res[$i]->respuestas;
                }
                $a[] = array("label" => "Otros",
                             "value" => 100.0 - $suma);
            } else {
                foreach($res as $key => $val){
                    $lbl = $val[0];
                    $search = "SELECT nombre_departamento FROM movile_departamentos WHERE id = '$lbl';";
                    $tres = Model::query($search);
                    $a[] = array("label" => $tres[0][0],
                                 "value" => $val[1]
                                );
                }
            }
        } else {
            if(core::$cnx->error === ''){
                $a[] = array("label" => "No hay datos disponibles", "value" => 100.0);
            } else{
                $a = array('error' => true, 'errdesc' => core::$cnx->error);
            }
            
        }
        
        return json_encode($a);
        
    }
    
}

?>