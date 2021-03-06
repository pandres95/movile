<?php

class encuesta extends Controller {
    
    public function encuesta() {
        $this->loadModel('encuesta');
    }
    
    public function index($data = ''){
        
        try{
            
            $Slim = Controller::$slimx;
            
            $aRes = Controller::query("SELECT COUNT(id) AS cuenta FROM movile_encuestas;");
            
            $data = array("num" => $aRes[0]['cuenta']);
            
            $Slim::getView('app/head', $data, function($route,$data){
                $data;
                include $route;
            });
            
            $Slim::getView('encuesta/lista', $data, function($route,$data){
                $data;
                include $route;
            });
            
            $Slim::getView('app/foot', $data, function($route,$data){
                $data;
                include $route;
            });
            
        } catch (Exception $e) {
            throw $e;
        }
        
    }
    
    public function pagLista($pagenum = ''){
        
        header('Content-Type: application/json; charset=UTF-8');
        echo Controller::getModel('encuesta')->listarEncuestas($pagenum);
        
    }
    
    public function detalle($data = null) {
        
        if(!isset($data) or $data == null){
            header('location: ' . core::getURI() . '/encuesta');
        }
        
        $Slim = Controller::$slimx;
        
        $aRes = Controller::spQuery("SELECT nombre FROM movile_encuestas WHERE id=$data; SELECT id, texto FROM movile_preguntas WHERE id_encuesta=$data;");
        
        $respuestas = array();
        foreach($aRes[1] as $key => $val){
            $id = $val['id'];
            $tRes = Controller::query("SELECT texto FROM movile_respuestas WHERE id_pregunta=$id");
            $respuestas[] = $tRes;
        }
        
        $data = array("nombre" => $aRes[0][0]['nombre'],
                      "preguntas" => $aRes[1],
                      "respuestas" => $respuestas);
        
        $Slim::getView('app/head', $data, function($route,$data){
            $data;
            include $route;
        });
        
        $Slim::getView('encuesta/detalle', $data, function($route,$data){
            $data;
            include $route;
        });
        
        $Slim::getView('app/foot', $data, function($route,$data){
            $data;
            include $route;
        });
        
    }
    
    public function nueva($data = ''){
        
        try{
            
            $Slim = Controller::$slimx;
            
            $Slim::getView('app/head', $data, function($route,$data){
                $data;
                include $route;
            });
            
            $Slim::getView('encuesta/nueva', $data, function($route,$data){
                $data;
                include $route;
            });
            
            $Slim::getView('app/foot', $data, function($route,$data){
                $data;
                include $route;
            });
            
        } catch (Exception $e) {
            throw $e;
        }
        
    }
    
}

?>
